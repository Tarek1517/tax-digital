
<script setup>

import { ref, onMounted } from 'vue'
import  useAxios  from '@/composables/useAxios';
// import { useAuthStore } from "@/stores/useAuthStore";
import { useRouter } from 'vue-router';
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";

const { loading, error, sendRequest } = useAxios();
// const authStore = useAuthStore();
const router = useRouter();



const form = ref({
    title: null,
    icon:null,
    item:null,
    order_number: null,
});

// Save Product
const onSubmit = async() => {
    const response = await sendRequest({
        method: 'post',
        url: '/v1/service',
        data: form.value,
        headers: {
            // authorization: `Bearer ${authStore.user.token}`,
            'Content-Type': 'multipart/form-data'
        }
    });
    if(response?.data){
        toast.success( ' Service Added Successfully', {autoclose:1000, 'theme' : 'dark'});
        await router.push('/admin/service');
    }
}

</script>
<template>
    <GuestLayout>
        <div class="p-4 bg-white shadow-md me-4">
            <div class="flex flex-col items-center gap-5 my-12">
                <h2 class="text-xl font-semibold text-primary">Add New Services</h2>
                <div class="w-1/2 ">
                    <div class="flex flex-col gap-1">
                        <label for="title" class="text-sm mb-2">Service Name</label>
                        <input type="text" class="input" v-model="form.title" />
                    </div>
                </div>
                <div class="w-1/2 ">
                    <div class="flex flex-col gap-1">
                        <label for="title" class="text-sm mb-2">Service Icon</label>
                        <input type="text" class="input" v-model="form.icon" />
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="flex flex-col gap-1 ">
                        <label for="number" class="text-sm mb-2">Order Number</label>
                        <input type="number" class="input" v-model="form.order_number" />
                    </div>
                </div>
                <div class="w-1/2 ">
                    <button class=" w-full mx-auto bg-primary text-xl font-semibold py-3 text-white mt-8" @click="onSubmit">Save Services</button>
                </div>
            </div>

        </div>

    </GuestLayout>
</template>
