
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

const img = ref(null);
const image = (image) => {
    const file = image.target.files[0];
    form.value.image = file;
    img.value = URL.createObjectURL(file);
}



const removeMedia = (index) => {
    let removedImage = form.value.image[index];
    if (removedImage.url.startsWith('blob:')) {
        URL.revokeObjectURL(removedImage.url);
    }
    form.value.image.splice(index, 1);
};


const remove = (index) => form.value.package.splice(index, 1);

const form = ref({
    title: null,
    price: null,
    image: null,
    short_description: null,
});

// Save Product
const onSubmit = async() => {
    const response = await sendRequest({
        method: 'post',
        url: '/v1/package',
        data: form.value,
        headers: {
            // authorization: `Bearer ${authStore.user.token}`,
            'Content-Type': 'multipart/form-data'
        }
    });
    if(response?.data){
        toast.success( ' Package Added Successfully', {autoclose:1000, 'theme' : 'dark'});
        await router.push('/admin/package');
    }
}

</script>
<template>
    <GuestLayout>
        <div class="p-4 bg-white shadow-md me-4">
            <div class="flex flex-col items-center gap-5 my-12">
                <h2 class="text-xl font-semibold text-primary">Add New Packages</h2>
                <div class="w-1/2 ">
                    <div class="flex flex-col gap-1">
                        <label for="title" class="text-sm mb-2">Package Title </label>
                        <input type="text" class="input" v-model="form.title" />
                    </div>
                </div>
                <div class="w-1/2 ">
                    <div class="flex flex-col gap-1">
                        <label for="number" class="text-sm mb-2">Package Price</label>
                        <input type="number" class="input" v-model="form.price" />
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="flex flex-col gap-1 ">
                        <label for="text" class="text-sm mb-2">Description</label>
                        <textarea class="input h-40"  v-model="form.short_description"></textarea>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="flex flex-col gap-1 ">
                        <div class="pr-2">
                            <label for="image" class="text-xs block mb-1">Image</label>
                            <label for="image" class="w-52 h-36 flex items-center
                                        justify-center gap-3 p-2 border border-dashed border-primary rounded-md text-primary cursor-pointer">
                                <input type="file" id="image" hidden @change="image">
                                <img v-if="img" :src="img" class="w-full h-full object-cover" />
                                <div v-else>
                                    <p class="text-xs">Upload Team Member Image</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 ">
                    <button class=" w-full mx-auto bg-primary text-xl font-semibold py-3 text-white mt-8" @click="onSubmit">Save Packages</button>
                </div>
            </div>
        </div>

    </GuestLayout>
</template>
