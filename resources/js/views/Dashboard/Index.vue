<script setup>
// import {useAuthStore} from "@/stores/useAuthStore.js";
import { ref, onMounted } from "vue";
import useAxios from "@/composables/useAxios.js";
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
const { loadng, error, sendRequest } = useAxios();
import { useAuthStore } from "@/stores/useAuthStore";
const auth = useAuthStore();
const data = ref(null);

const getData = async () => {
    const response = await sendRequest({
        method: "get",
        url: "/v1/dashboard",
    });

    if (response) {
        data.value = response?.data?.data;
    }
};

const request = ref(null);
// const getRequest = async () => {
//     const response = await sendRequest({
//        method:'get',
//        url:'/v1/get-all-inquires'
//     });
//     if(response){
//         request.value = response?.data
//     }
// }

const deleteRequest = async (id) => {
    const response = sendRequest({
        method: "get",
        url: `/v1/delete-inquiry/${id}`,
    });
    if (response) {
        // getRequest();
        toast.success("Request Deleted Successfully", {
            autoClose: 500,
            theme: "dark",
        });
    }
};

onMounted(() => {
    getData();
});
</script>
<template>
    <GuestLayout>
        <div class="flex flex-wrap mb-4 mt-4">
            <!-- First Row -->
            <div class="w-1/4 p-2">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">£{{ data?.totalSale }}</p>
                    Total Sales
                </div>
            </div>
            <div class="w-1/4 p-2">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">{{ data?.totalServices }}</p>
                    Total Services
                </div>
            </div>
            <div class="w-1/4 p-2">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">{{ data?.totalPackages }}</p>
                    Total Packages
                </div>
            </div>
            <div class="w-1/4 p-2">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">£{{ data?.totalSaleToday }}</p>
                    Today's Orders
                </div>
            </div>

            <!-- Second Row -->
            <div class="w-1/4 p-2">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">{{ data?.totalCustomer }}</p>
                    Total Customers
                </div>
            </div>
            <div class="w-1/4 p-2">
                <div class="w-full bg-primary/15 text-secondary p-3">
                    <p class="text-4xl font-bold">{{ data?.totalOrders }}</p>
                    Total Orders
                </div>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-t-2 border-primary">
				<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
					<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
						<tr>
							<th scope="col" class="px-6 py-3">
								Customer Name
							</th>
                            <th scope="col" class="px-6 py-3">
								Companey Name
							</th>
							<th scope="col" class="px-6 py-3">
								Package Name
							</th>

                            <th scope="col" class="px-6 py-3">
								Order Code
							</th>
                            <th scope="col" class="px-6 py-3">
								Order Status
							</th>
                            <th scope="col" class="px-6 py-3">
								Total Payment
							</th>

							<th scope="col" class="px-6 py-3">
								Action
							</th>

						</tr>
					</thead>
					<tbody>

						<tr v-for="latest_orders in data?.recentOrder" :key="latest_orders.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">


							<td class="px-6 py-4">
								{{ latest_orders?.cus_name }}
							</td>

							<td class="px-6 py-4">
								{{ latest_orders?.companey_name }}
							</td>
							<td class="px-6 py-4">
								{{ latest_orders?.package_name }}
							</td>
                            <td class="px-6 py-4">
								{{ latest_orders?.order_code }}
							</td>
                            <td class="px-6 py-4">
								{{ latest_orders?.order_status }}
							</td>
                            <td class="px-6 py-4">
								{{ latest_orders?.total_payment }}
							</td>

							<td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <RouterLink :to="`/admin/order-details/${latest_orders?.id}`" class="flex items-center gap-1 px-2 py-1 rounded border border-green-600 bg-green-500/10 text-green-600 hover:bg-green-600 hover:text-white">
										<Icon name="material-symbols:eye-tracking-sharp" />
										<span class="text-xs font-normal">Details</span>
									</RouterLink>
                                </div>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
    </GuestLayout>
</template>
