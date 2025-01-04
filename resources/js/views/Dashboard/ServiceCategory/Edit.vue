<script setup>
import { ref, onMounted } from 'vue'
import  useAxios  from '@/composables/useAxios';
import { useRouter, useRoute } from 'vue-router';
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import  SummernoteEditor  from 'vue3-summernote-editor';

const { loading, error, sendRequest } = useAxios();
// const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();

const getCategory = async() => {
	const response = await sendRequest({
		url:`/v1/service-category/${route?.params?.id}`,
		method:'get',
	});
	if(response){
		form.value = response.data?.data;
	}
}

const form = ref({
	name: null,
    title: null,
    icon:null,
    short_description:null,
    description:null,
    order_level: null,
	status:1,
});


// Save Product
const onSubmit = async(id) => {
    const response = await sendRequest({
        method: 'post',
        url: `/v1/service-category/${id}`,
        data: form.value,
		params: {
			_method:'PUT'
		}
    });
    if(response?.data){
        toast.success( 'Category Updated Successfully', {autoclose:1000, 'theme' : 'dark'});
        await router.push('/admin/service-category');
    }
}

onMounted(() => {
	getCategory();
})
</script>
<template>
    <GuestLayout>
        <div class="p-4 bg-white shadow-md max-w-3xl mx-auto">
            <div class="flex flex-wrap -mx-2">
                <div class="w-1/2 mb-5 px-2">
                    <div class="flex flex-col gap-1">
                        <label for="title" class="text-sm mb-2">Category Name</label>
                        <input type="text" class="input" v-model="form.name" />
                    </div>
                </div>
				<div class="w-1/2  mb-5 px-2">
                    <div class="flex flex-col gap-1">
                        <label for="title" class="text-sm mb-2">Category Title</label>
                        <input type="text" class="input" v-model="form.title" />
                    </div>
                </div>
                <div class="w-1/2 mb-5 px-2">
                    <div class="flex flex-col gap-1 ">
                        <label for="number" class="text-sm mb-2">Order Level</label>
                        <input type="number" class="input" v-model="form.order_level" />
                    </div>
                </div>
				<div class="w-1/2 mb-5 px-2">
                    <div class="flex flex-col gap-1 ">
                        <label for="number" class="text-sm mb-2">Category Icon</label>
							<textarea v-model="form.icon" class=" w-full h-20 border border-primary focus:border-primary focus:ring-0 focus:shadow focus:shadow-primary"></textarea>
                    </div>
                </div>
				<div class="w-full px-2 mb-5">
					<label for="short_description" class="text-sm mb-2 block">Short Description</label>
					<textarea v-model="form.short_description" class=" w-full h-20 border border-primary focus:border-primary focus:ring-0 focus:shadow focus:shadow-primary"></textarea>
				</div>
				<div class="w-full px-2">
					<label for="description" class="text-sm mb-2 block">Description</label>
					<div class="editor_data">
                        <SummernoteEditor v-model="form.description" />
                    </div>
				</div>
                <div class="w-full mt-5 px-2">
                    <button class="w-full mx-auto bg-primary text-sm font-normal py-3 text-white" @click="onSubmit(route?.params?.id)">Update Category</button>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
