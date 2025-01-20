<script setup>
const props = defineProps({
    Package: Object,
});
</script>

<template>
    <div
        class="flex flex-col items-center justify-between px-3 py-10 shadow-lg shadow-primary/25 rounded-2xl bg-white mb-10"
    >
        <div class="py-3">
            <img
                class="w-20 h-auto"
                :src="Package?.image"
                :alt="Package?.name"
            />
        </div>
        <h4
            class="w-44 text-center text-lg lg:text-2xl font-medium text-black pb-3"
        >
            {{ Package?.title }}
        </h4>
        <p class="text-sm lg:text-base font-medium text-gray-700 pb-3">
            <span class="text-2xl lg:text-4xl text-secondary px-2"
                >£{{ Package?.price }}</span
            >+VAT
        </p>
        <p
            class="text-sm lg:text-base text-gray-700 lg:py-3 px-3 lg:px-0 text-center w-80"
        >
            {{ Package?.description }}
        </p>
        <div class="text-center pt-8">
            <RouterLink
                :to="`/CheckOut/${Package?.slug}`"
                class="bg-primary text-sm lg:text-lg uppercase text-white py-1 lg:py-3 px-6 lg:px-8 rounded-full hover:bg-secondary transition-all ease-in-out duration-300"
            >
                Buy Now
            </RouterLink>
        </div>
    </div>
</template>

<style scoped></style>
