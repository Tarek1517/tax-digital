<script setup>
import {ref, onMounted} from 'vue';
import useAxios from '@/composables/useAxios.js'
import {toast} from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import Icon from "@/components/Icon.vue";

const {loading, error, sendRequest} = useAxios();

const packages = ref(null);
const getPackage = async () => {
    const response = await sendRequest({
        method:'get',
        url:'/v1/package',
    });

    if(response){
        packages.value = response.data;
    }
}

const handelDelete = async (id) => {
    const response = await sendRequest({
        method:'delete',
        url:`/v1/package/${id}`,
    });
    if(response){
        await getPackage();
        toast.success('Package Deleted Successfully', {autoClose:500, 'theme':'dark'})
    }
}

onMounted(() => {
    getPackage();
})
</script>
<template>
    <GuestLayout>
        <div class="flex items-center justify-between p-5 bg-white border-y border-primary">
            <div>
                <div class="flex items-center">
                    <h2 class="text-xl py-3 px-3 font-semibold text-primary">Packages</h2>
                </div>
                <div>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search" v-model="search" class="w-80 rounded block pt-2 ps-10 text-sm  border border-gray-500 bg-transparent
                          focus:ring-primary focus:border-primary text-gray-300 shadow" placeholder="Search for items">
                    </div>
                </div>
            </div>
            <RouterLink to="/admin/create-package">
                <button
                    class="flex items-center justify-center gap-2 bg-primary px-3 py-2 text-white text-sm font-medium">
                    <Icon name="streamline:interface-add-circle-button-remove-cross-add-buttons-plus-circle"
                          class="text-sm shadow-lg border-primary"/>
                    Add Record
                </button>
            </RouterLink>
        </div>

        <div class="flex flex-wrap p-5 -mx-3">
            <div class="w-1/3 px-3  mb-6" v-for="item in packages?.data" :key="item.id">
                <div class="border border-primary/55 bg-primary/5 shadow-lg shadow-primary/25 rounded-lg p-5 h-full w-full">
                    <div>
                        <img src="" alt="">
                    </div>
                    <h2 class="text-2xl font-medium text-gray-500 ">Title : {{item?.title}}</h2>
                    <p class="text-2xl text-primary">Price: {{item?.price}}</p>
                    <img :src="item?.image" class="w-44 h-auto py-5" />
                    <p class="text-sm text-gray-700 py-3 w-80">{{item?.description}}</p>

                    <div class="flex gap-3 mt-5">
                        <RouterLink :to="`/admin/edit-package/${item.id}`" class="border rounded border-green-600 bg-green-500/10  hover:bg-white ">
                            <Icon name="material-symbols:edit-document-outline-sharp" class="text-xl text-green-600 m-2" />
                        </RouterLink>
                        <button class="border border-primary rounded bg-primary/10" @click="handelDelete(item.id)">
                            <Icon name="material-symbols:delete-outline" class="text-xl text-gray-500 m-2 hover:text-primary" />
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </GuestLayout>
</template>
