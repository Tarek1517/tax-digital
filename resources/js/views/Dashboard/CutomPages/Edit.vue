<script setup>
import SummernoteEditor from "vue3-summernote-editor";
import { ref, onMounted } from "vue";
import useAxios from "@/composables/useAxios.js";
import { useRouter } from "vue-router";
import { useRoute } from "vue-router";
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";

const { error, loading, sendRequest } = useAxios();
const router = useRouter();
const route = useRoute();

const getPage = async () => {
    const response = await sendRequest({
        method: "get",
        url: `/v1/pages/${route?.params?.id}`,
    });

    if (response) {
        form.value = response.data?.data;
        form.value.id = response.data?.data?.id;
        form.value.title = response.data?.data?.title;
        form.value.content = response.data?.data?.content;
    }
};

const form = ref({
    id: null,
    title: null,
    content: "",
});

const onUpdate = async (id) => {
    const response = await sendRequest({
        method: "post",
        url: `/v1/pages/${id}`,
        params: {
            _method: "PUT",
        },
        data: form.value,
    });

    if (response) {
        toast.success("Page Update Successfully", { autoClose: 1000 });
        router.push("/admin/pages");
    }
};

onMounted(() => {
    getPage();
});
</script>
<template>
    <GuestLayout>
        <div class="flex justify-center">
            <div class="w-full pr-1">
                <div class="p-4 shadow-lg rounded-lg">
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
                        <Button
                            @click="onUpdate(form.id)"
                            class="w-full mx-auto bg-primary text-xl font-semibold py-3 text-white mt-8"
                            >Update Page</Button
                        >
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
