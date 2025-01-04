<script setup>
import { ref, onMounted } from 'vue';
import useAxios from '@/composables/useAxios.js'
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import Icon from "@/components/Icon.vue";

const { loading, error, sendRequest } = useAxios();

const services = ref(null);
const getServices = async () => {
	const response = await sendRequest({
		method: 'get',
		url: '/v1/service',
	});

	if (response) {
		services.value = response.data;
	}
}

const handelDelete = async (id) => {
	const response = await sendRequest({
		method: 'delete',
		url: `/v1/service/${id}`,
	});
	if (response) {
		await getServices();
		toast.success('Service Deleted Successfully', { autoClose: 500, 'theme': 'dark' })
	}
}

onMounted(() => {
	getServices();
})
</script>
<template>
	<GuestLayout>
		<section class="p-4">
			<div class="flex items-center justify-between mb-5">
				<h2 class="text-xl">Services</h2>
				<RouterLink to="/admin/create-service">
					<button
						class="flex items-center justify-center gap-2 bg-primary px-3 py-2 text-white text-sm font-medium">
						<Icon name="streamline:interface-add-circle-button-remove-cross-add-buttons-plus-circle"
							class="text-sm shadow-lg border-primary"/>
						Add New Service
					</button>
				</RouterLink>
			</div>
			<div class="relative overflow-x-auto shadow-md sm:rounded-lg border-t-2 border-primary">
				<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
					<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
						<tr>
							<th scope="col" class="px-6 py-3">
								Product name
							</th>
							<th scope="col" class="px-6 py-3">
								Color
							</th>
							<th scope="col" class="px-6 py-3">
								Category
							</th>
							<th scope="col" class="px-6 py-3">
								Price
							</th>
							<th scope="col" class="px-6 py-3">
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
							<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
								Apple MacBook Pro 17"
							</th>
							<td class="px-6 py-4">
								Silver
							</td>
							<td class="px-6 py-4">
								Laptop
							</td>
							<td class="px-6 py-4">
								$2999
							</td>
							<td class="px-6 py-4">
								<a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
							</td>
						</tr>
						<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
							<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
								Microsoft Surface Pro
							</th>
							<td class="px-6 py-4">
								White
							</td>
							<td class="px-6 py-4">
								Laptop PC
							</td>
							<td class="px-6 py-4">
								$1999
							</td>
							<td class="px-6 py-4">
								<a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
							</td>
						</tr>
						<tr class="bg-white dark:bg-gray-800">
							<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
								Magic Mouse 2
							</th>
							<td class="px-6 py-4">
								Black
							</td>
							<td class="px-6 py-4">
								Accessories
							</td>
							<td class="px-6 py-4">
								$99
							</td>
							<td class="px-6 py-4">
								<a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
	</GuestLayout>
</template>
