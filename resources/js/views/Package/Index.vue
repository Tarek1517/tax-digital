<script setup>
import AppLayout from "@/components/AppLayout.vue";
import PricingCard from "@/components/PricingCard.vue";
import Container from "@/components/Container.vue";

import { ref, onMounted } from "vue";
import useAxios from "@/composables/useAxios.js";

const { loading, error, sendRequest } = useAxios();

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
    fetchPackages();
});
</script>

<template>
    <AppLayout>
        <section
            class="h-auto bg-top bg-no-repeat bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/pricing/header-bg.svg')]"
        >
            <Container>
                <div class="text-center py-10">
                    <h2 class="text-3xl lg:text-5xl font-bold text-black">
                        Tailored pricing for your specific needs
                    </h2>
                    <p class="text-sm lg:text-lg text-gray-700 py-3">
                        We like to keep it very simple and charge for only what
                        you actually need for your business.
                    </p>
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
            <div class="flex justify-center">
                <img
                    class="object-cover"
                    src="https://www.debitam.com/wp-content/themes/debitam-uk/image/pricing/pp-img.svg"
                    alt=""
                />
            </div>
            <div class="flex items-center justify-center bg-secondary/5">
                <h3
                    class="text-xl lg:text-2xl text-center font-bold text-black py-10 w-2/3"
                >
                    25,000+ Companies trust us for their year-end accounts and
                    tax return. Find out more about our customers' experiences
                    below.
                </h3>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped></style>
