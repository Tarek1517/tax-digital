<script setup>
import { onMounted, ref } from 'vue';
import useAxios from '@/composables/useAxios';
import { useAuthStore } from '@/stores/useAuthStore';
import { toast } from 'vue3-toastify';


const authStore = useAuthStore();
const {loading, error, sendRequest} = useAxios();

const getAllSetting = async() => {
    const response = await sendRequest({
        method:'get',
        url:'/v1/setting',
        headers: {
            authorization: `Bearer ${authStore.user.token}`,
        }
    });
    form.value.phone_number = response.data.phone_number;
    form.value.email_address = response.data.email_address;
    form.value.socials = response.data.socials;
}

const addSocials = () => {
    form.value.socials.push({
        key:null,
        value:null,
    })
}
const remove = (index) => form.value.socials.splice(index, 1);


const form = ref({
    phone_number: [],
    email_address: [],
    socials: [{
        icon:null,
        link:null,
    }]
});

const onSubmit = async () => {
    const response = await sendRequest({
        method:'post',
        url:'/v1/setting',
        data:form.value
    });
    if(response){
        toast.success('Setting Upadated Successfully', {autoClose:500, 'theme':'dark'});
        getAllSetting();
    }
}


onMounted(() => {
    getAllSetting();
})
</script>
<template>
    <AppLayout>
        <div class="flex flex-wrap p-4 bg-white">
            <div class="w-1/2 px-2">
                <div class="mb-2">
                    <label for="phone_number">Phone Number</label>
                    <input v-model="form.phone_number" type="text" class="w-full p-2 rounded bg-transparent border focus:outline-none focus:ring-primary">
                </div>
            </div>
            <div class="w-1/2 px-2">
                <div class="mb-2">
                    <label for="phone_number">Email Addreess</label>
                    <input v-model="form.email_address" type="text" class="w-full p-2 rounded bg-transparent border focus:outline-none focus:ring-primary">
                </div>
            </div>
            <div class="w-1/2 px-2">
                <div class="flex items-center gap-1">
                    <label for="socials">Social Icon</label>
                    <button @click="addSocials" class="text-sm bg-primary text-white rounded px-2">Add More</button>
                </div>
                <div class="mb-3 p-4 border border-gray-500 rounded relative" v-for="(item, index) in form.socials">
                    <button class="absolute top-1 right-1 bg-primary rounded text-white" v-if="form.socials?.length > 1" @click="remove">
                        <Icon name="material-symbols:close" />
                    </button>
                    <div class="mb-3">
                    <div class="flex items-center gap-2">
                        <label for="icon">Icon</label>
                        <a href="https://icones.js.org/collection/all" target="_blank" class="text-primary flex items-center gap-1">Get icon code form here
                                    <Icon name="mdi:share-outline" />
                                </a>
                    </div>
                    <input  v-model="item.icon" type="text" class="w-full p-2 rounded bg-transparent border focus:outline-none focus:ring-primary">
                    </div>
                    <div>
                        <label for="icon">Link</label>
                    <input  v-model="item.link" type="text" class="w-full p-2 rounded bg-transparent border focus:outline-none focus:ring-primary">
                    </div>
                </div>
            </div>
            <div class="w-full px-2 text-center py-2">
                <button @click="onSubmit" class="bg-primary text-white py-2 w-1/2">Save Setting</button>
            </div>
        </div>
    </AppLayout>
</template>
