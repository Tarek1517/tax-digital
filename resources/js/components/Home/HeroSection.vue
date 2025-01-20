<template>
    <section class="py-6 lg:py-12">
        <Container>
            <!-- Left Side -->
            <div class="flex flex-wrap items-center justify-between">
                <div class="w-full lg:w-1/2">
                    <h1 class="text-4xl lg:text-7xl font-bold mb-6">
                        {{ allData?.title }}
                    </h1>

                    <p class="text-xl lg:text-2xl font-medium mb-10 mt-5">
                        {{ allData?.sub_title }}
                    </p>
                    <a
                        :href="allData?.button_link"


                        class="bg-secondary text-base lg:text-xl uppercase text-white py-1 lg:py-3 px-8 lg:px-20 rounded-full hover:bg-primary transition-all ease-in-out duration-300"

                    >
                        Buy Now
                    </a>
                    <p class="mt-6 text-sm lg:text-lg text-gray-600">
                        {{ allData?.short_description }}
                    </p>
                </div>

                <!-- Right Side (Styled Image) -->
                <div class="w-full lg:w-1/2">
                    <div class="h-full w-full rounded-lg">
                        <img
                            class="h-full w-full object-cover"
                            :src="allData?.image"
                            alt="Styled Image"
                        />
                    </div>
                </div>
            </div>
        </Container>
    </section>
</template>

<script setup>
import Container from "@/components/Container.vue";

const props = defineProps({
    allData: Object,
});
</script>

<style></style>
