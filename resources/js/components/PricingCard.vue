<script setup>
const props = defineProps({
    Package: Object,
});
</script>

<template>
    <div
        class="flex flex-col items-center justify-center p-5 shadow-lg shadow-primary/25 rounded-2xl bg-white mb-10"
    >
        <div class="py-3">
            <img
                class="w-20 h-auto"
                :src="Package?.image"
                :alt="Package?.name"
            />
        </div>
        <h4
            class="w-44 text-center text-lg lg:text-xl font-medium text-secondary pb-3"
        >
            {{ Package?.title }}
        </h4>
        <p class="text-sm lg:text-base font-medium text-gray-700 pb-3">
            <span class="text-2xl lg:text-4xl text-primary px-2"
                >£{{ Package?.price }}</span
            >+VAT
        </p>
        <p
            class="text-sm lg:text-lg text-gray-700 lg:py-3 px-3 lg:px-0 text-center w-80"
        >
            {{ Package?.description }}
        </p>
        <div class="text-center pt-8">
            <RouterLink
                :to="`/CheckOut/${Package?.slug}`"
                class="bg-white text-lg lg:text-xl text-primary border-2 py-1 lg:py-2 px-10 lg:px-20 lg:mb-8 rounded-full hover:border-primary transition-all ease-in-out duration-500"
            >
                Buy Now
            </RouterLink>
        </div>
    </div>
</template>

<style scoped></style>
