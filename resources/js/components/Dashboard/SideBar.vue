<script setup>
import { useAuthStore } from "@/stores/useAuthStore.js";
import useAxios from "@/composables/useAxios.js";
const { loading, error, sendRequest } = useAxios();
const authStore = useAuthStore();
</script>

<template>
    <div>
        <div>
            <ul class="flex flex-col">
                <li>
                    <RouterLink
                        to="/admin/dashboard"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="ic:twotone-dashboard-customize"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Dashboard</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink
                        to="/admin/service-category"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Service Category</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink
                        to="/admin/service"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Services</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink
                        to="/admin/package"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Package</p>
                    </RouterLink>
                </li>

                <li>
                    <RouterLink
                        to="/admin/orders"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Orders</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink
                        to="/admin/clients"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Clients</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink
                        to="/admin/Customer-mail"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Clients Mail</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink
                        to="/admin/pages"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Custom Pages</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink
                        to="/admin/setting"
                        class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10"
                    >
                        <Icon
                            name="material-symbols:settings-outline-rounded"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Setting</p>
                    </RouterLink>
                </li>
                <li>
                    <button
                        @click="authStore?.adminLogout"
                        class="group flex items-center gap-2 px-3 py-2 hover:bg-primary/10 w-auto hover:w-full transition-all duration-300"
                    >
                        <Icon
                            name="codicon:sign-out"
                            size="20"
                            class="text-primary"
                        />
                        <p class="font-normal text-sm">Log Out</p>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>
