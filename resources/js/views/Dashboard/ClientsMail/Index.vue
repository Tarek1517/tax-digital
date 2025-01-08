<script setup>
import { ref, onMounted } from 'vue';
import useAxios from '@/composables/useAxios.js'
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import Icon from "@/components/Icon.vue";

const { loading, error, sendRequest } = useAxios();

const CutomerMsg = ref(null);
const getMasages = async () => {
	const response = await sendRequest({
		method: 'get',
		url: '/v1/custimer-mail',
	});

	if (response) {
		CutomerMsg.value = response.data;
	}
}

const handelDelete = async (id) => {
	const response = await sendRequest({
		method: 'delete',
		url: `/v1/custimer-mail/${id}`,
	});
	if (response) {
		await getMasages();
		toast.success('Service Deleted Successfully', { autoClose: 500, 'theme': 'dark' })
	}
}

onMounted(() => {
	getMasages();
})
</script>
<template>
	<GuestLayout>
		<section class="p-4">
			<div class="flex items-center justify-between mb-5">
				<h2 class="text-xl">Customer Mail</h2>
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
								Companey Name
							</th>
							<th scope="col" class="px-6 py-3">
								Massage
							</th>

							<th scope="col" class="px-6 py-3">
								Action
							</th>

						</tr>
					</thead>
					<tbody>

						<tr v-for="massage in CutomerMsg?.data" :key="massage.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">


							<td class="px-6 py-4">
								{{ massage?.name }}
							</td>

							<td class="px-6 py-4">
								{{ massage?.email }}
							</td>
							<td class="px-6 py-4">
								{{ massage?.companey_name }}
							</td>
                            <td class="px-6 py-4">
								{{ massage?.massage }}
							</td>

							<td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <RouterLink :to="`/admin/mail-details/${massage?.id}`" class="flex items-center gap-1 px-2 py-1 rounded border border-green-600 bg-green-500/10 text-green-600 hover:bg-green-600 hover:text-white">
										<Icon name="material-symbols:eye-tracking-sharp" />
										<span class="text-xs font-normal">Details</span>
									</RouterLink>
                                    <button @click="handelDelete(massage?.id)" class="flex items-center gap-1 px-2 py-1 rounded border border-orange-600 bg-orange-500/10 text-orange-600 hover:bg-orange-600 hover:text-white">
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
