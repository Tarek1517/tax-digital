<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import useAxios from "@/composables/useAxios.js";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";

const route = useRoute();
const { sendRequest } = useAxios();

const mailDetails = ref(null);

// Fetch order details
const getMail = async (id) => {
    try {
        const response = await sendRequest({
            method: "get",
            url: `/v1/custimer-mail/${id}`,
        });
        if (response) {
            mailDetails.value = response?.data?.data;
        }
    } catch (error) {
        console.error("Failed to fetch order details:", error);
    }
};

onMounted(() => {
    const id = route.params.id;
    getMail(id);
});
</script>
<template>
    <GuestLayout>
        <div class="card bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4 text-primary pb-2 border-b border-primary">Mail Details</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <tbody>
                        <tr>
                            <th
                                class="text-gray-600 font-medium py-2 px-4 border-b w-1/3"
                            >
                                Name
                            </th>
                            <td class="py-2 px-4 border-b">
                                {{ mailDetails?.name }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                class="text-gray-600 font-medium py-2 px-4 border-b"
                            >
                                Email
                            </th>
                            <td class="py-2 px-4 border-b">
                                {{ mailDetails?.email }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                class="text-gray-600 font-medium py-2 px-4 border-b"
                            >
                                Phone
                            </th>
                            <td class="py-2 px-4 border-b">
                                {{ mailDetails?.phone }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                class="text-gray-600 font-medium py-2 px-4 border-b"
                            >
                                Company
                            </th>
                            <td class="py-2 px-4 border-b">
                                {{ mailDetails?.companey_name }}
                            </td>
                        </tr>
                        <tr>
                            <th
                                class="text-gray-600 font-medium py-2 px-4 border-b"
                            >
                                Message
                            </th>
                            <td class="py-2 px-4 border-b">
                                {{ mailDetails?.massage }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-gray-600 font-medium py-2 px-4">
                                Created At
                            </th>
                            <td class="py-2 px-4">
                                {{ mailDetails?.created_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </GuestLayout>
</template>
