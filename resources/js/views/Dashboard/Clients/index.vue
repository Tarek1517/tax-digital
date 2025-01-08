<script setup>
import { ref, onMounted } from 'vue';
import useAxios from '@/composables/useAxios.js'
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import Icon from "@/components/Icon.vue";

const { loading, error, sendRequest } = useAxios();

const clientsList = ref(null);
const getClients = async () => {
	const response = await sendRequest({
		method: 'get',
		url: '/v1/clients',
	});

	if (response) {
		clientsList.value = response.data;
	}
}

const handelDelete = async (id) => {
	const response = await sendRequest({
		method: 'delete',
		url: `/v1/clients/${id}`,
	});
	if (response) {
		await getClients();
		toast.success('Client Deleted Successfully', { autoClose: 500, 'theme': 'dark' })
	}
}

onMounted(() => {
	getClients();
})
</script>
<template>
	<GuestLayout>
		<section class="p-4">
			<div class="flex items-center justify-between mb-5">
				<h2 class="text-xl">CLients List</h2>

			</div>
			<div class="relative overflow-x-auto shadow-md sm:rounded-lg border-t-2 border-primary">
				<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
					<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
						<tr>
							<th scope="col" class="px-6 py-3">
								Name
							</th>
							<th scope="col" class="px-6 py-3">
								Email
							</th>
                            <th scope="col" class="px-6 py-3">
								phone
							</th>
							<th scope="col" class="px-6 py-3">
								role
							</th>

							<!-- <th scope="col" class="px-6 py-3">
								Action
							</th> -->

						</tr>
					</thead>
					<tbody>

						<tr v-for="clients in clientsList?.data" :key="clients.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">


							<td class="px-6 py-4">
								{{ clients?.name }}
							</td>

							<td class="px-6 py-4">
								{{ clients?.email }}
							</td>
							<td class="px-6 py-4">
								{{ clients?.phone }}
							</td>
                            <td class="px-6 py-4">
								{{ clients?.role }}
							</td>

							<!-- <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                    <button @click="handelDelete(clients?.id)" class="flex items-center gap-1 px-2 py-1 rounded border border-orange-600 bg-orange-500/10 text-orange-600 hover:bg-orange-600 hover:text-white">
										<Icon name="material-symbols-light:delete-outline-sharp" />
										<span class="text-xs font-normal">Delete</span>
									</button>
                                </div>
							</td> -->
						</tr>

					</tbody>
				</table>
			</div>
		</section>
	</GuestLayout>
</template>
