<script setup>
import { ref, onMounted } from 'vue';
import useAxios from '@/composables/useAxios.js'
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";

const { loading, error, sendRequest } = useAxios();

const categories = ref(null);
const getCategory = async () => {
	const response = await sendRequest({
		method: 'get',
		url: '/v1/service-category',
	});
	if (response) {
		categories.value = response.data;
	}
}

const onDelete = async (id) => {
	const response = await sendRequest({
		method: 'delete',
		url: `/v1/service-category/${id}`,
	});
	if (response) {
		await getCategory();
		toast.success('Service Category Deleted Successfully', { autoClose: 500, 'theme': 'dark' })
	}
}

onMounted(() => {
	getCategory();
})
</script>
<template>
	<GuestLayout>
		<section class="p-4">
			<div class="flex items-center justify-between mb-5">
				<h2 class="text-xl">Services Category</h2>
					<RouterLink to="/admin/create-category">
						<button
							class="flex items-center justify-center gap-2 bg-primary px-3 py-2 text-white text-sm font-medium">
							<Icon name="streamline:interface-add-circle-button-remove-cross-add-buttons-plus-circle"
								class="text-sm shadow-lg border-primary"/>
							Add New Category
						</button>
					</RouterLink>
			</div>
			<div class="relative overflow-x-auto shadow-md sm:rounded-lg border-t-2 border-primary">
				<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
					<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
						<tr>
							<th scope="col" class="px-6 py-3">
								Category Image
							</th>
                            <th scope="col" class="px-6 py-3">
								Category Name
							</th>
							<th scope="col" class="px-6 py-3">
								Category Title
							</th>
							<th scope="col" class="px-6 py-3">
								Icon
							</th>
							<th scope="col" class="px-6 py-3">
								Order Level
							</th>
							<th scope="col" class="px-6 py-3">
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="category in categories?.data" :key="category.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<img class="w-10 h-auto" :src="category?.image" :alt="service?.name">
							</th>
							<th scope="row" class="px-6 py-2 font-medium text-gray-900 dark:text-white">
								{{ category?.name }}
							</th>
							<td class="px-6 py-2">
								{{ category?.title }}
							</td>
							<td class="px-6 py-2">
								<Icon :name="category?.icon" class="text-3xl" />
							</td>
							<td class="px-6 py-2">
								{{ category?.order_level }}
							</td>
							<td class="px-6 py-2">
								<div class="flex items-center gap-2">
									<RouterLink :to="`/admin/edit-category/${category?.id}`" class="flex items-center gap-1 px-2 py-1 rounded border border-green-600 bg-green-500/10 text-green-600 hover:bg-green-600 hover:text-white">
										<Icon name="material-symbols:edit-square-outline-rounded" />
										<span class="text-xs font-normal">Edit</span>
									</RouterLink>
									<button @click="onDelete(category?.id)" class="flex items-center gap-1 px-2 py-1 rounded border border-orange-600 bg-orange-500/10 text-orange-600 hover:bg-orange-600 hover:text-white">
										<Icon name="material-symbols-light:delete-outline-sharp" />
										<span class="text-xs font-normal">Delete</span>
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
