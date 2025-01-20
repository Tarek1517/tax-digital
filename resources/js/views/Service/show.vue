<script setup>
import Container from "@/components/Container.vue";
import Modal from "@/components/Modal.vue";
import { useAuthStore } from "@/stores/useAuthStore";
import { ref, onMounted, watch } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";
import { toast } from "vue3-toastify";
import useAxios from "@/composables/useAxios.js";

const route = useRoute();
const { error, loading, sendRequest } = useAxios();
const serviceData = ref([]);
const slug = route.params.slug;

const authStore = useAuthStore();

const fetchService = async () => {
    try {
        const response = await sendRequest({
            method: "get",
            url: `frontend/v1/get-service-data/${slug}`,
        });
        serviceData.value = response?.data?.data || [];
    } catch (error) {
        console.error("Error fetching Packages:", error);
    }
};

const services = ref(null);
const getServices = async () => {
    const response = await sendRequest({
        method: "get",
        url: "/v1/service",
    });

    if (response) {
        services.value = response.data;
    }
};

const allSettings = ref([]);

const fetchSettings = async () => {
    try {
        const response = await sendRequest({
            method: "get",
            url: "frontend/v1/get-all-settings",
        });
        allSettings.value = response?.data || [];
    } catch (error) {
        console.error("Error fetching Packages:", error);
    }
};

const form = ref({
    name: null,
    email: "",
    phone: null,
    companey_name: null,
    massage: null,
});

const onSubmit = async () => {
    try {
        const response = await sendRequest({
            method: "post",
            url: "/frontend/v1/store-mail",
            data: form.value,
        });

        if (response) {
            toast.success("Message Sent Successfully", { autoClose: 1000 });

            form.value = {
                name: "",
                email: "",
                phone: "",
                companey_name: "",
                massage: "",
            };

            setTimeout(() => {
                router.push("/contact");
            }, 2000);
        }
    } catch (error) {
        toast.error("Message failed to send. Please try again.");
    }
};

const onSubmitCustomQuote = async () => {
    try {
        const response = await sendRequest({
            method: "post",
            url: "/frontend/v1/store-custom-quote",
            data: form.value,
        });

        if (response) {
            toast.success("Message Sent Successfully", { autoClose: 1000 });

            form.value = {
                name: "",
                email: "",
                phone: "",
                companey_name: "",
                massage: "",
            };

            closeModal();
            
        }
    } catch (error) {
        toast.error("Message failed to send. Please try again.");
    }
};

// model
const isModalOpened = ref(false);

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

watch(
    () => route.params.slug,
    (newSlug) => {
        slug.value = newSlug;
        fetchService();
    }
);

onMounted(() => {
    fetchService();
    getServices();
    fetchSettings();
});
</script>

<template>
    <AppLayout>
        <section class="bg-[#fef5ff] mb-20">
            <Container>
                <div class="flex flex-wrap justify-between items-center py-8">
                    <div class="w-full lg:w-2/3">
                        <div class="py-20">
                            <p
                                class="text-lg lg:text-xl font-semibold text-primary pb-3 bg-secondary/10 pt-2 pl-2 w-2/4 rounded-lg"
                            >
                                {{ serviceData?.name }}
                            </p>
                            <h2
                                class="text-3xl lg:text-5xl font-bold text-black mt-4 max-w-xl"
                            >
                                {{ serviceData?.title }}
                            </h2>
                            <p
                                class="text-sm lg:text-lg text-gray-700 py-4 lg:py-7 leading-loose max-w-xl"
                            >
                                {{ serviceData?.short_description }}
                            </p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="">
                            <img
                                class="rounded-2xl"
                                :src="serviceData?.image"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </Container>
        </section>
        <section class="mb-20">
            <Container>
                <div class="flex flex-wrap lg:py-5">
                    <div
                        class="w-full lg:w-1/3 border-2 border-secondary/55 rounded-lg p-10"
                    >
                        <h2 class="text-3xl text-primary font-bold mb-3">
                            Limited Company
                        </h2>
                        <ul
                            v-for="service in services?.data"
                            :key="service.id"
                            class="flex flex-col gap-2 lg:gap-4"
                        >
                            <li class="flex gap-3 items-center mb-3">
                                <p
                                    class="text-sm lg:text-lg"
                                    :class="{
                                        'text-secondary':
                                            service?.slug === slug,
                                        'text-gray-700 ':
                                            service?.slug !== slug,
                                    }"
                                >
                                    {{ service.name }}
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div
                        class="w-full lg:w-2/3 pl-10 pb-10"
                        v-html="serviceData?.description"
                    ></div>
                </div>
            </Container>
        </section>
        <section class="bg-white pb-8 lg:pb-20">
            <Container>
                <div class="flex flex-wrap -mx-5">
                    <div class="w-full lg:w-1/2 px-5 mb-5 lg:mb-0">
                        <a href="#" class="block" @click="openModal">
                            <div
                                class="flex justify-between px-6 lg:px-12 py-3 lg:py-7 border-2 rounded-2xl border-primary/20 hover:border-primary/50 bg-secondary/10 hover:bg-primary/10"
                            >
                                <div>
                                    <h2
                                        class="text-xl lg:text-3xl font-semibold text-black"
                                    >
                                        Get a Custom Quote
                                    </h2>
                                    <p class="text-gray-600 text-sm lg:text-lg">
                                        For your specific business needs
                                    </p>
                                </div>
                                <div>
                                    <img
                                        src="https://www.debitam.com/wp-content/themes/debitam-uk/image/quote-icon1.svg"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="w-full lg:w-1/2 px-5">
                        <a
                            :href="`tel:${allSettings.phone_number}`"
                            class="block"
                        >
                            <div
                                class="flex justify-between px-6 lg:px-12 py-3 lg:py-7 border-2 rounded-2xl border-primary/20 hover:border-primary/50 bg-secondary/10 cursor-pointer hover:bg-primary/10"
                            >
                                <div>
                                    <h2
                                        class="text-xl lg:text-3xl font-semibold text-black"
                                    >
                                        Request a callback
                                    </h2>
                                    <p class="text-gray-600 text-sm lg:text-lg">
                                        At a time that suits you
                                    </p>
                                </div>
                                <div>
                                    <img
                                        src="https://www.debitam.com/wp-content/themes/debitam-uk/image/quote-icon2.svg"
                                        alt="Request Callback Icon"
                                    />
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </Container>
        </section>
    </AppLayout>

    <Modal :isOpen="isModalOpened" @modal-close="closeModal">
        <div class="bg-white mt-5 m-5 rounded-md">
            <div class="flex flex-wrap items-center-mx-5">
                <div class="w-full mb-7">
                    <div>
                        <input
                            v-model="form.name"
                            type="text"
                            placeholder="Full Name *"
                            class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                        />
                    </div>
                </div>
                <div class="w-full mb-7">
                    <div>
                        <input
                            v-model="form.email"
                            type="email"
                            placeholder="Email Address *"
                            class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                        />
                    </div>
                </div>
                <div class="w-full mb-7">
                    <div>
                        <input
                            v-model="form.phone"
                            type="text"
                            placeholder="Contact Number *"
                            class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                        />
                    </div>
                </div>

                <div class="w-full mb-7">
                    <div>
                        <input
                            v-model="form.companey_name"
                            type="text"
                            placeholder="Company *"
                            class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                        />
                    </div>
                </div>
                <div class="w-full">
                    <div>
                        <textarea
                            v-model="form.massage"
                            type="text"
                            placeholder="Message"
                            class="w-full h-28 border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                        ></textarea>
                    </div>
                </div>
                <Button
                    @click="onSubmitCustomQuote"
                    class="w-full lg:py-3 rounded-full inline-block bg-primary mt-8 text-white text-center py-1 font-bold hover:bg-secondary transition-all ease-in-out duration-300"
                    >SENT CUSTOM QUOTE</Button
                >
            </div>
        </div>
    </Modal>
</template>

<style scoped></style>
