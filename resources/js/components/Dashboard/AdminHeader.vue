<script setup>
import { useAuthStore } from "@/stores/useAuthStore.js";
import useAxios from "@/composables/useAxios.js";
const { loading, error, sendRequest } = useAxios();
const authStore = useAuthStore();
</script>

<template>
    <div
        class="fixed top-0 right-0 left-44 p-2 shadow z-10 flex justify-between items-center bg-white pr-5"
    >
        <RouterLink to="/admin/dashboard">
            <img class="h-8 w-auto ml-3" src="@/assets/images/tax-logo.png" alt="" />
        </RouterLink>
        <div class="flex flex-col items-start space-x-5">
            <span class="flex items-center gap-1 font-medium text-gray-800">
                <Icon name="ri:admin-fill" class="text-primary" />
                {{ authStore.admin?.user?.name }}
            </span>
            <span class="text-sm text-primary"> admin </span>
        </div>
    </div>
</template>
