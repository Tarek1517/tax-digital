<script setup>
import { ref, onMounted } from "vue";
import useAxios from "@/composables/useAxios";

import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";

const { loading, error, sendRequest } = useAxios();
import { useRouter } from "vue-router";
const router = useRouter();


const aboutImg = ref(null);
const form = ref({
    title: null,
    sub_title: null,
    image: null,
    button_link: null,
    short_description: null,
    order_number: null,
    status: 0,
});

const image = (image) => {
    const file = image.target.files[0];
    form.value.image = file;
    aboutImg.value = URL.createObjectURL(file);
};

// Save Product
const onSubmit = async () => {
    const response = await sendRequest({
        method: "post",
        url: "v1/about-hero-sections",
        data: form.value,
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
    if (response?.data) {
        toast.success("Hero Section Added Successfully", {
            autoclose: 1000,
            theme: "dark",
        });
        await router.push("/admin/about-hero-section");
    }
};
</script>
<template>
    <GuestLayout>
        <div class="p-4 bg-white shadow-md max-w-3xl mx-auto">
            <h2 class="text-xl font-semibold text-primary text-center mb-5">Add Hero Section</h2>
            <div class="flex flex-wrap -mx-2">

                <div class="w-1/2 mb-5 px-2">
                    <div class="flex flex-col gap-1">
                        <label for="title" class="text-sm mb-2"
                            >Title</label
                        >
                        <input type="text" class="input" v-model="form.title" />
                    </div>
                </div>
                <div class="w-1/2 mb-5 px-2">
                    <div class="flex flex-col gap-1">
                        <label for="title" class="text-sm mb-2"
                            >Sub Title</label
                        >
                        <input type="text" class="input" v-model="form.sub_title" />
                    </div>
                </div>

                <div class="w-1/2 mb-5 px-2">
                    <div class="flex flex-col gap-1">
                        <label for="number" class="text-sm mb-2"
                            >Order Level</label
                        >
                        <input
                            type="number"
                            class="input"
                            v-model="form.order_level"
                        />
                    </div>
                </div>

                <div class="w-1/2 mb-5 px-2">
                    <div class="flex flex-col gap-1">
                        <label for="number" class="text-sm mb-2"
                            >About Image</label
                        >
                        <label
                            class="border border-primary border-dashed p-2 rounded-2xl flex items-center justify-center size-44 cursor-pointer"
                        >
                            <img
                                v-if="aboutImg"
                                :src="aboutImg"
                                class="w-full h-full rounded-md"
                            />
                            <div
                                v-if="!aboutImg"
                                class="flex flex-col items-center justify-center gap-2"
                            >
                                <Icon
                                    name="tabler:cloud-upload"
                                    class="text-primary text-2xl opacity-85"
                                />
                                <span
                                    class="text-primary text-sm font-normal opacity-85"
                                    >Upload About Image</span
                                >
                            </div>
                            <input
                                id="category-icon"
                                @change="image"
                                type="file"
                                hidden
                            />
                        </label>
                    </div>
                </div>
                <div class="w-full px-2 mb-5">
                    <label for="short_description" class="text-sm mb-2 block"
                        >Short Description</label
                    >
                    <textarea
                        v-model="form.short_description"
                        class="w-full h-20 border border-primary focus:border-primary focus:ring-0 focus:shadow focus:shadow-primary"
                    ></textarea>
                </div>

                <div class="w-full mt-5 px-2">
                    <button
                        class="w-full mx-auto bg-primary text-sm font-normal py-3 text-white"
                        @click="onSubmit"
                    >
                        Save About Section
                    </button>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
