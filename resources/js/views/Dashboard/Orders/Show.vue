<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import useAxios from "@/composables/useAxios.js";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import { toast } from "vue3-toastify";

const router = useRouter();
const route = useRoute();
const { sendRequest } = useAxios();

const orderDetails = ref(null);

const form = ref({
    order_status: "pending",
});

const getOrders = async (id) => {
    try {
        const response = await sendRequest({
            method: "get",
            url: `/v1/orders/${id}`,
        });
        if (response) {
            orderDetails.value = response.data?.data;

            form.value.order_status =
                orderDetails.value.order_status || "pending";
        }
    } catch (error) {
        console.error("Failed to fetch order details:", error);
        toast.error("Failed to load order details", {
            autoclose: 2000,
            theme: "dark",
        });
    }
};

const onSubmit = async (id) => {
    try {
        const response = await sendRequest({
            method: "post",
            url: `/v1/orders/${id}`,
            data: form.value,
            params: {
                _method: "PUT",
            },
        });

        if (response?.data) {
            toast.success("Status Updated Successfully", {
                autoclose: 1000,
                theme: "dark",
            });

            await router.push(`/admin/order-details/${route.params.id}`);
        }
    } catch (error) {
        console.error("Failed to update order status:", error);
        toast.error("Failed to update status", {
            autoclose: 2000,
            theme: "dark",
        });
    }
};

onMounted(() => {
    const id = route.params.id;
    getOrders(id);
});
</script>

<template>
    <GuestLayout>
        <div class="container mx-auto p-6">
            <!-- Card -->
            <div class="bg-white shadow-md rounded-lg p-6 mx-auto">
                <!-- Card Header -->
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    Order No: {{ orderDetails?.id }}
                </h2>

                <!-- Order Content -->
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Image Section -->
                    <div class="w-full md:w-1/3 mt-3">
                        <img
                            class="w-full h-auto rounded-lg shadow-md"
                            :src="orderDetails?.packages?.image"
                            :alt="orderDetails?.package_name"
                        />
                    </div>

                    <!-- Details Section -->
                    <div class="w-full md:w-2/3">
                        <div class="grid grid-cols-1 gap-2">
                            <h2
                                class="text-xl font-bold text-primary border-b border-primary/55 mb-4 pb-2"
                            >
                                Order Details
                            </h2>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Package Name:</span
                                >
                                <span class="text-gray-800">{{
                                    orderDetails?.package_name
                                }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Order Code:</span
                                >
                                <span class="text-gray-800">{{
                                    orderDetails?.order_code
                                }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Company Name:</span
                                >
                                <span class="text-gray-800">{{
                                    orderDetails?.companey_name
                                }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Customer Name:</span
                                >
                                <span class="text-gray-800">{{
                                    orderDetails?.cus_name
                                }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Customer Phone:</span
                                >
                                <span class="text-gray-800">{{
                                    orderDetails?.cus_phone
                                }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Customer Email:</span
                                >
                                <span class="text-gray-800">{{
                                    orderDetails?.cus_email
                                }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Order Status:</span
                                >
                                <span
                                    class="px-2 py-1 text-sm rounded-lg font-semibold"
                                    :class="
                                        orderDetails?.order_status === 'accept'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-yellow-100 text-yellow-700'
                                    "
                                >
                                    {{ orderDetails?.order_status }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Total Payment:</span
                                >
                                <span class="text-gray-800"
                                    >£{{ orderDetails?.total_payment }}</span
                                >
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600"
                                    >Payment Method:</span
                                >
                                <span class="text-gray-800">{{
                                    orderDetails?.payment_method
                                }}</span>
                            </div>

                            <div class="flex items-center space-x-4 mt-3">
                                <div class="flex-1">
                                    <label
                                        for="order_status"
                                        class="block text-sm font-medium text-primary mb-1"
                                    >
                                        Update Status
                                    </label>
                                    <select
                                        id="order_status"
                                        v-model="form.order_status"
                                        class="block w-full rounded-md border-secondary/55 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    >
                                        <option value="pending">Pending</option>
                                        <option value="accept">Accept</option>
                                    </select>
                                </div>
                                <button
                                    @click="onSubmit(route.params.id)"
                                    class="rounded-md bg-secondary px-4 py-2 text-sm font-medium text-white hover:bg-primary mt-6"
                                >
                                    Update Status
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end gap-4">
                    <RouterLink
                        to="/admin/orders"
                        class="px-4 py-1 bg-secondary text-white rounded-lg hover:bg-primary"
                    >
                        Back
                    </RouterLink>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
