<script setup>
import { useAuthStore } from "@/stores/useAuthStore";
import useAxios from "@/composables/useAxios.js";
const { loading, error, sendRequest } = useAxios();

const authStore = useAuthStore();
</script>


<template>
    <header class="bg-white shadow-md">
        <Container>
            <div class="lg:flex items-center hidden justify-between py-4">
                <RouterLink to="/">
                    <img
                        class="h-10 w-auto"
                        src="@/assets/images/tax-logo.png"
                        alt=""
                    />
                </RouterLink>

                <!-- Navigation Links -->
                <nav class="flex space-x-8">
                    <RouterLink
                        to="/"
                        class="text-gray-900 text-xl font-medium hover:text-primary"
                        >Home</RouterLink
                    >
                    <RouterLink
                        to="/about"
                        class="text-gray-900 font-medium text-xl hover:text-primary"
                        >About</RouterLink
                    >
                    <RouterLink
                        to="/price"
                        class="text-gray-900 font-medium text-xl hover:text-primary"
                        >Pricing</RouterLink
                    >
                    <RouterLink
                        to="/service"
                        class="text-gray-900 font-medium text-xl hover:text-primary"
                        >Services</RouterLink
                    >
                    <RouterLink
                        to="/contact"
                        class="text-gray-900 font-medium text-xl hover:text-primary"
                        >Contact</RouterLink
                    >
                </nav>

                <!-- Right Side (Contact Info & Buttons) -->
                <div class="flex items-center space-x-4">
                    <!-- Buy Now Dropdown -->
                    <div class="relative">
                        <RouterLink
                            to="/dashboard"
                            v-if="authStore?.user"
                            class="flex items-center gap-1 group"
                        >
                            <!-- Icon with hover effect -->
                            <Icon
                                name="lucide:user-round"
                                class="text-3xl text-white bg-primary p-1 rounded-md group-hover:bg-secondary group-hover:text-black transition-all duration-300"
                                :style="{ color: 'white' }"
                            />
                            <!-- Text with hover effect -->
                            <span
                                class="hidden lg:block font-bold text-black group-hover:text-secondary transition-all duration-300"
                            >
                                {{ authStore?.user?.user?.name }}
                            </span>
                        </RouterLink>

                        <!-- If user is not authenticated -->
                        <RouterLink
                            v-else
                            to="/login"
                            class="px-4 py-2 font-medium bg-primary rounded-lg hover:bg-secondary flex items-center"
                            :style="{ color: 'white' }"
                        >
                            <span>Login</span>
                        </RouterLink>

                        <!-- Dropdown Menu (Hidden by default, shown on click) -->
                        <!-- Add dropdown functionality here -->
                    </div>
                </div>
            </div>
        </Container>
    </header>
</template>

<style></style>
