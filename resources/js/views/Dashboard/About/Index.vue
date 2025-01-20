<script setup>
import { ref, onMounted } from "vue";
import useAxios from "@/composables/useAxios.js";
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import Icon from "@/components/Icon.vue";

const { loading, error, sendRequest } = useAxios();

const aboutheroContent = ref(null);
const getaboutHeroContent = async () => {
    const response = await sendRequest({
        method: "get",
        url: "/v1/about-hero-sections",
    });

    if (response) {
        aboutheroContent.value = response.data;
    }
};

const handelDelete = async (id) => {
    const response = await sendRequest({
        method: "delete",
        url: `/v1/about-hero-sections/${id}`,
    });
    if (response) {
        await getaboutHeroContent();
        toast.success("Hero Section Deleted Successfully", {
            autoClose: 500,
            theme: "dark",
        });
    }
};

const handeleinActive = async (id) => {
    const response = await sendRequest({
        method: "get",
        url: `/v1/aboutInactive-status/${id}`,

    });
    if (response) {
        await getaboutHeroContent();
        toast.success("Status Update Successfully", {
            autoClose: 500,
            theme: "dark",
        });
    }
};

const handeleActive = async (id) => {
    const response = await sendRequest({
        method: "get",
        url: `/v1/aboutActive-status/${id}`,
    });
    if (response) {
        await getaboutHeroContent();
        toast.success("Status Update Successfully", {
            autoClose: 500,
            theme: "dark",
        });
    }
};

onMounted(() => {
    getaboutHeroContent();
});
</script>
<template>
    <GuestLayout>
        <section class="p-4">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl">Services</h2>
                <RouterLink to="/admin/create-about-hero">
                    <button
                        class="flex items-center justify-center gap-2 bg-primary px-3 py-2 text-white text-sm font-medium"
                    >
                        <Icon
                            name="streamline:interface-add-circle-button-remove-cross-add-buttons-plus-circle"
                            class="text-sm shadow-lg border-primary"
                        />
                        Add New Service
                    </button>
                </RouterLink>
            </div>
            <div
                class="relative overflow-x-auto shadow-md sm:rounded-lg border-t-2 border-primary"
            >
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Subtitle</th>
                            <th scope="col" class="px-6 py-3">
                                Short Description
                            </th>
                            <th scope="col" class="px-6 py-3">Order Level</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="heroSection in aboutheroContent?.data"
                            :key="heroSection.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        >
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            >
                                <img
                                    class="w-10 h-auto"
                                    :src="heroSection?.image"
                                    :alt="heroSection?.name"
                                />
                            </th>

                            <td class="px-6 py-4">
                                {{ heroSection?.title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ heroSection?.sub_title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ heroSection?.short_description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ heroSection?.order_level }}
                            </td>

                            <td class="px-6 py-4">
                                <div v-if="heroSection?.status === 1">
                                    <span
                                        class="bg-green-500/50 text-black px-3 py-1 rounded-md"
                                        >Active</span
                                    >
                                </div>
                                <div v-else>
                                    <span
                                        class="bg-orange-500/50 text-black px-3 py-1 rounded-md"
                                        >inActive</span
                                    >
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div v-if="heroSection?.status === 1">
                                        <button
                                            @click="
                                                handeleinActive(heroSection?.id)
                                            "
                                            class="flex items-center gap-1 px-2 py-1 rounded border border-orange-600 bg-orange-500/10 text-orange-600 hover:bg-orange-600 hover:text-white"
                                        >
                                            <Icon
                                                name="flowbite:thumbs-down-solid"
                                            />
                                        </button>
                                    </div>
                                    <div v-else>
                                        <button
                                            @click="
                                                handeleActive(heroSection?.id)
                                            "
                                            class="flex items-center gap-1 px-2 py-1 rounded border border-green-600 bg-green-500/10 text-green-600 hover:bg-green-600 hover:text-white"
                                        >
                                            <Icon
                                                name="flowbite:thumbs-up-solid"
                                            />
                                        </button>
                                    </div>
                                    <RouterLink
                                        :to="`/admin/edit-aboutHeroSection/${heroSection?.id}`"
                                        class="flex items-center gap-1 px-2 py-1 rounded border border-green-600 bg-green-500/10 text-green-600 hover:bg-green-600 hover:text-white"
                                    >
                                        <Icon
                                            name="material-symbols:edit-square-outline-rounded"
                                        />
                                        <span class="text-xs font-normal"
                                            >Edit</span
                                        >
                                    </RouterLink>
                                    <button
                                        @click="handelDelete(heroSection?.id)"
                                        class="flex items-center gap-1 px-2 py-1 rounded border border-orange-600 bg-orange-500/10 text-orange-600 hover:bg-orange-600 hover:text-white"
                                    >
                                        <Icon
                                            name="material-symbols-light:delete-outline-sharp"
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
