<script setup>
import Container from "@/components/Container.vue";
import { ref, onMounted } from "vue";
import useAxios from "@/composables/useAxios.js";

const { loading, error, sendRequest } = useAxios();

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

onMounted(() => {
    fetchSettings();
});
</script>

<template>
    <footer>
        <section class="h-auto">
            <Container>
                <div class="flex flex-wrap py-8 justify-between">
                    <div class="w-full lg:w-1/5">
                        <div
                            class="flex lg:flex-col items-center lg:items-start justify-center border-b-2 border-primary/35 lg:border-none"
                        >
                            <div
                                class="w-20 h-20"
                            >
                                <RouterLink to="/">
                                    <img
                                        class="h-10 w-auto"
                                        src="@/assets/images/tax-logo.png"
                                        alt=""
                                    />
                                </RouterLink>
                            </div>
                            <p
                                class="text-sm lg:text-sm text-gray-700"
                            >
                                Once you approve the accounts, we submit your
                                company accounts & tax return to the authorities
                                and share the proof of submission for your
                                record.
                            </p>
                            <h4
                                class="text-2xl lg:text-4xl font-bold text-black lg:pt-5"
                            >
                                Tax Digital
                            </h4>
                        </div>
                    </div>
                    <div
                        class="w-1/2 lg:w-1/5"
                        v-for="column in allSettings?.footer_columns"
                        :key="column.id"
                    >
                        <div class="flex flex-col py-4 pl-4">
                            <h4 class="text-black text-xl font-bold">
                                {{ column?.title }}
                            </h4>
                            <ul
                                v-for="page in column?.pages || []"
                                :key="page?.slug"
                                class="leading-loose pt-4 text-sm lg:text-base font-normal"
                            >
                                <li>
                                    <a
                                        v-if="page?.slug && page?.title"
                                        :href="`/${page.slug}`"
                                        class="hover:text-primary cursor-pointer"
                                    >
                                        {{ page.title }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="w-1/2 lg:w-1/5">
                        <div class="flex flex-col py-4 pl-4">
                            <h4 class="text-black text-xl font-bold">
                                Get Connected
                            </h4>
                            <ul
                                class="leading-loose pt-4 text-sm lg:text-base font-normal"
                            >
                                <li class="lg:w-52">
                                    {{ allSettings.address }}
                                </li>
                                <li
                                    class="text-xl font-semibold text-black py-3"
                                >
                                    Contact Us
                                    <span class="w-20 h-[6px] bg-primary">
                                    </span>
                                </li>
                                <li>{{ allSettings.phone_number }}</li>
                                <li>{{ allSettings.email }}</li>
                            </ul>
                            <ul class="flex gap-4 my-5">
                                <li
                                    class="rounded-md shadow-lg bg-primary/10 hover:bg-secondary/35 p-1"
                                >
                                    <a :href="allSettings?.facebook_link">
                                        <img
                                            class="w-5 h-4"
                                            src="https://www.debitam.com/wp-content/themes/debitam-uk/image/social/facebook.svg"
                                            alt=""
                                        />
                                    </a>
                                </li>
                                <li
                                    class="rounded-md shadow-lg bg-primary/10 hover:bg-secondary/35 p-1"
                                >
                                    <a :href="allSettings?.linkedin_link">
                                        <img
                                            class="w-5 h-4"
                                            src="https://www.debitam.com/wp-content/themes/debitam-uk/image/social/linkedin.svg"
                                            alt=""
                                        />
                                    </a>
                                </li>
                                <li
                                    class="rounded-md shadow-lg bg-primary/10 hover:bg-secondary/35 p-1"
                                >
                                    <a :href="allSettings?.youtube_link">
                                        <img
                                            class="w-5 h-4"
                                            src="https://www.debitam.com/wp-content/themes/debitam-uk/image/social/youtube.svg"
                                            alt=""
                                        />
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-wrap lg:justify-between py-7 border-t border-gray-300 text-sm"
                >
                    <div class="text-gray-500">
                        <p>
                            © Copyright 2024
                            <span class="hover:text-blue-700">
                                TaxDigital
                            </span>
                            - All Rights Reserved
                        </p>
                    </div>
                    <div>
                        <ul
                            class="flex gap-2 lg:gap-3 text-gray-500 text-xs lg:text-sm"
                        >
                            <li class="hover:text-blue-700">Terms</li>
                            <li>|</li>
                            <li class="hover:text-blue-700">Privacy</li>
                            <li>|</li>
                            <li class="hover:text-blue-700">Cookie Policy</li>
                            <li>|</li>
                            <li class="hover:text-blue-700">
                                Terms of Services
                            </li>
                        </ul>
                    </div>
                </div>
            </Container>
        </section>
    </footer>
</template>

<style scoped></style>
