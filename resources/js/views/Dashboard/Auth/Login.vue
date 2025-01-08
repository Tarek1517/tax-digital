<template>
    <section class="bg-cover bg-no-repeat h-screen bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/home/trust-pilot-bg.webp')]">
        <div class="w-full flex justify-center items-center  py-10 lg:py-32">
            <div class="w-full max-w-lg flex flex-wrap rounded-xl shadow-xl shadow-primary/25 p-4">
                <div class="w-full lg:pr-5 lg:pt-10 ">
                    <h3 class="text-2xl font-semibold mb-3">Login</h3>
                    <div class="">
                        <label for="email" class="block pb-1 text-xs" >Email</label>
                        <input type="email" name="email" id="email" v-model="loginCredential.email" class="input w-full placeholder:text-gray-400 px-3 mb-2">
                    </div>
                    <div class="">
                        <label for="password" class="block pb-1 text-xs">Password</label>
                        <input type="password" name="password" v-model="loginCredential.password"  id="password" class="input w-full placeholder:text-gray-400 px-3 mb-2">
                    </div>
                    <div class="text-center py-5">
                        <button @click="handleLogin" class="w-full py-2 bg-primary text-white font-bold text-center rounded-lg my-2">Log In</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/useAuthStore.js';
import { useRouter, useRoute } from 'vue-router';
import { toast } from 'vue3-toastify';

const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();

const loginCredential = ref({
    email: 'admin@taxdigital.com',
    password: '12345678',
});

const isLoading = ref(false);

const handleLogin = async () => {
    if (!loginCredential.value.email || !loginCredential.value.password) {
        toast.error('Please fill in both email and password fields.');
        return;
    }

    try {
        isLoading.value = true;
        const loginResponse = await authStore.adminLogin(loginCredential.value);
        if (loginResponse) {
            toast.success('Login successful!', { autoClose: 1000 });
            const redirectPath = route.query.redirect || '/admin/dashboard';
            router.push(redirectPath);
        }
    } catch (error) {
        toast.error('Login failed. Please check your credentials.');
    } finally {
        isLoading.value = false;
    }
};
</script>
