<script setup>
import { onMounted, ref } from "vue";
import useAxios from "@/composables/useAxios";
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import { useRouter } from "vue-router";
import { useRoute } from "vue-router";
const router = useRouter();
const route = useRoute();

const { loading, error, sendRequest } = useAxios();

const pages = ref(null);

const getPages = async () => {
    const response = await sendRequest({
        method: "get",
        url: "/v1/pages",
    });
    pages.value = response.data;
};

const onDelete = async (id) => {
    const response = await sendRequest({
        method: "delete",
        url: `/v1/pages/${id}`,
    });

    if (response) {
        getPages();
        toast.success("Page Deleted Succesfully");
        router.push("/admin/pages");
    }
};

onMounted(() => {
    getPages();
});
</script>
<template>
    <Loading :value="loading" />
    <GuestLayout>
        <section class="shadow-lg rounded-lg">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <Icon name="gis:globe-users" class="text-lg" />
                        <h3 class="text-base font-medium">Pages</h3>
                    </div>
                    <div>
                        <RouterLink
                            :to="{ path: '/admin/create-page' }"
                            class="flex items-center justify-center gap-2 bg-primary px-4 py-2 text-white text-sm font-medium rounded hover:bg-primary-dark transition-all duration-300"
                        >
                            <Icon
                                name="material-symbols:add-box-outline"
                                class="text-lg"
                            />
                            <span>Add Record</span>
                        </RouterLink>
                    </div>
                </div>
            </div>
            <div
                class="relative overflow-x-auto shadow-md sm:rounded-lg border-t-2 border-primary"
            >
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase bg-common">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Slug</th>
                            <th scope="col" class="px-6 py-3">Created At</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="page in pages?.data"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        >
                            <td class="px-6 py-4">
                                {{ page?.title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ page?.slug }}
                            </td>
                            <td class="px-6 py-4">
                                {{ page?.created_at }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <RouterLink
                                        :to="`/admin/edit-page/${page?.id}`"
                                        class="flex items-center gap-1 px-2 py-1 rounded border border-green-600 bg-green-500/10 text-green-600 hover:bg-green-600 hover:text-white"
                                    >
                                        <Icon
                                            name="material-symbols:edit-square-outline"
                                        />
                                        <span class="text-xs font-normal"
                                            >Edit</span
                                        >
                                    </RouterLink>
                                    <button
                                        @click="onDelete(page?.id)"
                                        class="flex items-center gap-1 px-2 py-1 rounded border border-orange-600 bg-orange-500/10 text-orange-600 hover:bg-orange-600 hover:text-white"
                                    >
                                        <Icon
                                            name="material-symbols:delete-outline"
                                        />
                                        <span class="text-xs font-normal"
                                            >Delete</span
                                        >
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </GuestLayout>
</template>
