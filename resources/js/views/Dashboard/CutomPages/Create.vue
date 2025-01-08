<script setup>
import SummernoteEditor from "vue3-summernote-editor";
import { ref } from "vue";
import useAxios from "@/composables/useAxios.js";
import { useRouter } from "vue-router";
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";

const { error, loading, sendRequest } = useAxios();
const router = useRouter();

const form = ref({
    title: null,
    content: "",
    seo_title: null,
    seo_description: null,
    seo_image: null,
});

const onSubmit = async () => {
    const response = await sendRequest({
        method: "post",
        url: "/v1/pages",
        data: form.value,
    });

    if (response) {
        toast.success("New Page Added Successfully", { autoClose: 1000 });
        setTimeout(() => {
            router.push("/admin/pages");
        }, 2000);
    }
};
</script>
<template>
    <GuestLayout>
    <div class="flex justify-center">
        <div class="w-full pr-1">
            <div class="p-4 shadow-lg">
                <h3>Create New Page</h3>
                <div class="mb-5">
                    <label for="title" class="mb-1 block text-sm"
                        >Page Title</label
                    >
                    <input
                        id="title"
                        type="text"
                        class="p-2 rounded-md border w-full"
                        v-model="form.title"
                    />
                </div>
                <div>
                    <label for="summery" class="mb-1 block text-sm"
                        >Page Content</label
                    >
                    <div class="editor_data">
                        <SummernoteEditor v-model="form.content" />
                    </div>
                </div>
                <div class="mt-5">
                    <Button @click="onSubmit" class=" w-full mx-auto bg-primary text-xl font-semibold py-3 text-white mt-8">Save Page</Button>
                </div>
            </div>
        </div>

    </div>
</GuestLayout>
</template>
