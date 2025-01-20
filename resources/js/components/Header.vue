<script setup>
import { useAuthStore } from "@/stores/useAuthStore";
import { ref, onMounted } from "vue";
import useAxios from "@/composables/useAxios.js";
const { loading, error, sendRequest } = useAxios();

const authStore = useAuthStore();

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

                <div class="flex items-center space-x-4">
                    <!-- Phone Number (Clickable) -->
                    <div class="flex items-center">
                        <Icon
                            name="line-md:phone-call-loop"
                            class="text-primary mr-2 text-2xl"
                        />
                        <a
                            :href="`tel:${allSettings.phone_number}`"
                            class="text-black font-medium hover:text-primary transition-all duration-300"
                        >
                            {{ allSettings.phone_number }}
                        </a>
                    </div>

                    <!-- Authenticated User Section -->
                    <RouterLink
                        v-if="authStore?.user"
                        to="/dashboard"
                        class="flex items-center gap-2 group"
                    >
                        <!-- User Icon with hover effect -->
                        <Icon
                            name="lucide:user-round"
                            class="text-3xl text-white bg-primary p-1 rounded-md group-hover:bg-secondary group-hover:text-black transition-all duration-300"
                        />
                        <!-- User Name -->
                        <span
                            class="hidden lg:block font-bold text-black group-hover:text-secondary transition-all duration-300"
                        >
                            {{ authStore?.user?.user?.name }}
                        </span>
                    </RouterLink>

                    <!-- Login Button (if not authenticated) -->
                    <RouterLink
                        v-else
                        to="/login"
                        class="bg-primary text-sm lg:text-base uppercase text-white py-1 lg:py-2 px-5 lg:px-8 rounded-full hover:bg-secondary transition-all ease-in-out duration-300"
                    >
                        <span>Login</span>
                    </RouterLink>
                </div>
            </div>
        </Container>
    </header>
</template>

<style></style>
