<script setup>
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/useAuthStore.js";
import useAxios from "@/composables/useAxios.js";
const { loading, error, sendRequest } = useAxios();
const authStore = useAuthStore();
const isCmsLinks = ref(false);

const toggleCmsLinks = () => {
    isCmsLinks.value = !isCmsLinks.value;
};
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
                    <!-- CMS Dropdown Toggle -->
                    <div
                        class="px-3 py-2 hover:bg-primary/10 group flex items-center gap-3 rounded-lg transition-all ease-in-out duration-300 cursor-pointer relative"
                        @click="toggleCmsLinks"
                    >
                        <Icon
                            name="carbon:ibm-data-product-exchange"
                            size="20"
                            class="text-primary"
                        />
                        <span
                            class="text-sm font-normal transition-all ease-in-out duration-300"
                        >
                            CMS
                        </span>
                        <div
                            class="absolute top-1/2 -translate-y-1/2 right-2 transition-all ease-in-out duration-300"
                            :class="{ 'rotate-90': isCmsLinks }"
                        >
                            <Icon
                                name="ic:twotone-keyboard-arrow-right"
                                size="20"
                                class="transition-all ease-in-out duration-300"
                            />
                        </div>
                    </div>

                    <!-- Dropdown Menu -->
                    <div
                        class="overflow-hidden transition-all duration-300"
                        :style="{ height: isCmsLinks ? 'auto' : '0px' }"
                    >
                        <ul
                            class="shop-links flex flex-col gap-4 pl-8 py-2"
                            :class="{ 'shop-links--active': isCmsLinks }"
                        >
                            <li>
                                <RouterLink
                                    to="/admin/home-slider"
                                    class="flex items-center"
                                >
                                    <Icon
                                        name="ph:dot-outline-bold"
                                        class="text-xl text-common"
                                    />
                                    <span class="text-sm">Home Hero Section</span>
                                </RouterLink>
                            </li>
                            <li>
                                <RouterLink
                                    to="/admin/about-hero-section"
                                    class="flex items-center"
                                >
                                    <Icon
                                        name="ph:dot-outline-bold"
                                        class="text-xl text-common"
                                    />
                                    <span class="text-sm">About Hero Section</span>
                                </RouterLink>
                            </li>
                        </ul>
                    </div>
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
