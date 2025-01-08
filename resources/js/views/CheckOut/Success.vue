<script setup>
import Container from "@/components/Container.vue";
</script>

<template>
    <AppLayout>
        <div
            class="flex flex-col items-center justify-center text-center py-12 gap-5"
        >
            <img
                class="w-1/6 h-auto object-cover rounded-xl"
                src="@/assets/images/tax-logo.png"
                alt="Education Logo"
            />
            <p
                class="text-4xl text-white bg-primary font-bold mt-6 px-10 py-2 rounded-md"
            >
                Thank You,
            </p>
            <p class="text-6xl font-bold mt-2">For Purchase !!</p>

        </div>
    </AppLayout>
</template>

<style scoped></style>
