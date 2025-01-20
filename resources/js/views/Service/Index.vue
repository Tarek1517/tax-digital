<script setup>
import Container from "@/components/Container.vue";
import PricingCard from "@/components/PricingCard.vue";
import { onMounted, ref, computed } from "vue";
const { error, loading, sendRequest } = useAxios();
import useAxios from "@/composables/useAxios.js";

const allcategories = ref([]);

const fetchCategories = async () => {
    try {
        const response = await sendRequest({
            method: "get",
            url: "frontend/v1/get-categories",
        });
        allcategories.value = response?.data || [];
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

const allPackages = ref([]);

const fetchPackages = async () => {
    try {
        const response = await sendRequest({
            method: "get",
            url: "frontend/v1/get-packages",
        });
        allPackages.value = response?.data || [];
    } catch (error) {
        console.error("Error fetching Packages:", error);
    }
};

onMounted(() => {
    fetchCategories();
    fetchPackages();
});
</script>

<template>
    <AppLayout>
        <section
            class="h-auto bg-top bg-no-repeat pt-16 lg:pt-0 lg:py-10 bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/service/header-bg.svg')]"
        >
            <Container>
                <div class="text-center lg:py-10">
                    <h2 class="text-2xl lg:text-5xl font-bold text-black">
                        Best suited for small businesses
                    </h2>
                </div>

                <div class="flex flex-wrap -mx-3 my-6">
                    <div
                        v-for="category in allcategories?.data"
                        :key="category.id"
                        class="w-full lg:w-1/2 px-3 mb-5 lg:mb-6"
                    >
                        <div
                            class="rounded-2xl bg-white p-5 lg:p-10 border-2 h-full border-primary/15 hover:border-primary/30 transition-all ease-in-out duration-300"
                        >
                            <div class="flex justify-between pb-8">
                                <h2
                                    class="text-xl lg:text-3xl font-semibold text-black w-20"
                                >
                                    {{ category.name }}
                                </h2>
                                <img
                                    :src="category.image"
                                    :alt="category.name"
                                    class="w-20 h-20 object-cover rounded-md"
                                />
                            </div>
                            <ul
                                v-for="service in category?.services"
                                :key="service.id"
                                class="flex flex-col gap-2 lg:gap-4"
                            >
                                <RouterLink :to="`/service-details/${service?.slug}`">
                                    <li class="flex gap-3 items-center mb-3">
                                        <Icon
                                            :name="service?.icon"
                                            class="text-2xl text-primary"
                                        />
                                        <p
                                            class="text-sm lg:text-lg text-gray-700 hover:text-secondary"
                                        >
                                            {{ service.name }}
                                        </p>
                                    </li>
                                </RouterLink>
                            </ul>
                        </div>
                    </div>
                </div>
            </Container>
        </section>
        <section class="">
            <Container>
                <div class="flex flex-wrap lg:py-5">
                    <div class="w-full lg:w-1/2">
                        <div class="">
                            <p
                                class="text-sm lg:text-lg text-gray-700 pb-4 lg:pb-7"
                            >
                                Success is yours when you do what you are best
                                at
                            </p>
                            <h2
                                class="text-2xl lg:text-4xl font-bold text-black"
                            >
                                Online Accounting and Tax Services
                            </h2>
                            <p
                                class="text-sm lg:text-lg text-gray-700 py-4 lg:py-7 leading-loose max-w-xl"
                            >
                                Tax and account filing are going online, how
                                about yourself? Online alternatives are huge and
                                the moment you google something, assuming it's
                                suitable for your needs, you find yourself in a
                                rabbit hole of promises, promotions, and
                                services. On top of that, you are already
                                insanely busy with the daily grind as a business
                                owner ...learn more
                            </p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="">
                            <img
                                src="https://www.debitam.com/wp-content/themes/debitam-uk/image/service/online-accounting-and-tax-service.webp"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </Container>
        </section>
        <section>
            <Container>
                <div>
                    <div class="flex flex-col items-center">
                        <h2
                            class="text-2xl lg:text-4xl font-bold text-black pt-4 lg:pt-10"
                        >
                            Why would you choose us?
                        </h2>
                        <p
                            class="text-sm lg:text-lg text-gray-700 py-5 max-w-2xl text-center"
                        >
                            Because we are affordable, quick and have a proven
                            reputation of being responsive to our over 25,000+
                            clients, please check us on Trustpilot.
                        </p>
                    </div>
                    <div class="flex justify-center py-6 lg:py-12">
                        <img
                            src="https://www.debitam.com/wp-content/themes/debitam-uk/image/service/happy-client.webp"
                            alt=""
                        />
                    </div>
                </div>
            </Container>
        </section>
        <section class="bg-primary/10">
            <Container>
                <div class="flex flex-wrap justify-between items-center py-8">
                    <div class="w-full lg:w-2/3">
                        <div class="">
                            <p
                                class="text-xl lg:text-2xl font-semibold text-black pb-3"
                            >
                                We offer exclusive
                            </p>
                            <h2
                                class="text-3xl lg:text-5xl font-bold text-black"
                            >
                                Online Accounting Service
                            </h2>
                            <p
                                class="text-xl lg:text-2xl font-semibold text-black pt-3"
                            >
                                tailored to your industry.
                            </p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="">
                            <img
                                src="https://www.debitam.com/wp-content/themes/debitam-uk/image/service/exclusive-offer.webp"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </Container>
        </section>
        <section
            class="h-auto bg-top bg-no-repeat bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/pricing/header-bg.svg')]"
        >
            <Container>
                <div class="flex flex-col items-center text-center lg:py-10">
                    <p class="text-sm lg:text-lg text-gray-700 py-8 max-w-2xl">
                        Still not too sure? Find out more on the live chat, we
                        are available from Monday to Friday between 9AM to 5PM.
                    </p>
                    <h2 class="text-3xl lg:text-5xl font-bold text-black pb-8">
                        Tailored pricing for your specific needs
                    </h2>
                </div>

                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5"
                >
                    <div
                        v-for="(Package, index) in allPackages?.data"
                        :key="Package.id"
                        class="px-5 flex justify-center"
                    >
                        <PricingCard :Package="Package" />
                    </div>
                </div>
            </Container>
        </section>
    </AppLayout>
</template>

<style scoped></style>
