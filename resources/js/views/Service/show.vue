<script setup>
import Container from "@/components/Container.vue";
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
    </AppLayout>
</template>

<style scoped></style>
