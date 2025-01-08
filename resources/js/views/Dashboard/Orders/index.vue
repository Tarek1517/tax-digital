<script setup>
import { ref, onMounted } from 'vue';
import useAxios from '@/composables/useAxios.js'
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";

const { loading, error, sendRequest } = useAxios();

const allOrders = ref(null);
const getOrders = async () => {
	const response = await sendRequest({
		method: 'get',
		url: '/v1/orders',
	});
	if (response) {
		allOrders.value = response.data;
	}
}



onMounted(() => {
	getOrders();
})
</script>
<template>
	<GuestLayout>
		<section class="p-4">
			<div class="flex items-center justify-between mb-5">
				<h2 class="text-xl">All Orders</h2>

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
						<tr v-for="orders in allOrders?.data" :key="orders.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

							<th scope="row" class="px-6 py-2 font-medium text-gray-900 dark:text-white">
								{{ orders?.cus_name }}
							</th>
							<td class="px-6 py-2">
								{{ orders?.companey_name }}
							</td>
							<td class="px-6 py-2">
								{{ orders?.package_name }}
							</td>
							<td class="px-6 py-2">
								{{ orders?.order_code }}
							</td>
							<td class="px-6 py-2">
								{{ orders?.order_status }}
							</td>
							<td class="px-6 py-2">
								{{ orders?.total_payment }}
							</td>

							<td class="px-6 py-2">
								<div class="flex items-center gap-2">
									<RouterLink :to="`/admin/order-details/${orders?.id}`" class="flex items-center gap-1 px-2 py-1 rounded border border-green-600 bg-green-500/10 text-green-600 hover:bg-green-600 hover:text-white">
										<Icon name="material-symbols:eye-tracking-sharp" />
										<span class="text-xs font-normal">Details</span>
									</RouterLink>
									<!-- <button @click="onDelete(orders?.id)" class="flex items-center gap-1 px-2 py-1 rounded border border-orange-600 bg-orange-500/10 text-orange-600 hover:bg-orange-600 hover:text-white">
										<Icon name="material-symbols-light:delete-outline-sharp" />
										<span class="text-xs font-normal">Delete</span>
									</button> -->
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
	</GuestLayout>
</template>
