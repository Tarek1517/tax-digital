<script setup>

// import {useAuthStore} from "@/stores/useAuthStore.js";
import {ref, onMounted} from 'vue';
// import useAxios from '@/composables/useAxios.js';
import {toast} from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
// const {loadng, error, sendRequest} = useAxios();


const request = ref(null);
// const getRequest = async () => {
//     const response = await sendRequest({
//        method:'get',
//        url:'/v1/get-all-inquires'
//     });
//     if(response){
//         request.value = response?.data
//     }
// }

const deleteRequest = async (id) => {
    const response = sendRequest({
       method:'get',
       url:`/v1/delete-inquiry/${id}`
    });
    if(response){
        // getRequest();
        toast.success('Request Deleted Successfully', {autoClose:500, 'theme':'dark'});
    }
}

onMounted(() => {
    // getRequest();
})

</script>
<template>
    <GuestLayout>
        <div class="flex flex-wrap -mx-1 mb-4">
            <div class="w-1/4 px-1">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">20</p>
                    Total Services
                </div>
            </div>
            <div class="w-1/4 px-1">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">20</p>
                    Total Packages
                </div>
            </div>
            <div class="w-1/4 px-1">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">20</p>
                    Total Projects
                </div>
            </div>
            <div class="w-1/4 px-1">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">20</p>
                    Total Team Member
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
