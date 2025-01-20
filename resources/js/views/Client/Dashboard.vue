<script setup>
import { useAuthStore } from "@/stores/useAuthStore.js";
import useAxios from "@/composables/useAxios.js";
import { ref, onMounted } from "vue";
import moment from "moment";
import Modal from "@/components/Modal.vue";
import { toast } from "vue3-toastify";
import { inject } from "vue";
const currencySetting = inject("currencySetting");

const { loading, error, sendRequest } = useAxios();
const authStore = useAuthStore();

const tabs = ["Order", "Profile", "Setting"];
const activeTab = ref(0);

const customer = ref(null);
const customerLoading = ref(false);

const getCustomer = async () => {
    customerLoading.value = true;
    try {
        const response = await sendRequest({
            method: "get",
            url: `/frontend/v1/customer/${authStore?.user?.user?.id}`,
            headers: {
                authorization: `Bearer ${authStore?.user?.token}`,
            },
        });

        console.log(response); // Debug the response
        if (response) {
            customer.value = response.data?.data;
            form.value = {
                name: customer.value.name || null,
                phone: customer.value.phone || null,
                email: customer.value.email || null,
            };
        }
    } catch (error) {
        console.error("Error fetching customer:", error);
    } finally {
        customerLoading.value = false;
    }
};

onMounted(() => {
    getCustomer(); // Fetch customer data when the component is mounted
});

const form = ref({
    id: null,
    name: null,
    phone: null,
    email: null,
    old_password: null,
    new_password: null,
    new_password_confirmation: null,
});

const allOrders = ref([]);

const fetchOrders = async (id) => {
    try {
        const response = await sendRequest({
            method: "get",
            url: `/frontend/v1/get-customer-order/${id}`,
        });
        allOrders.value = response?.data || [];
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

const onSubmit = async (id) => {
    const response = await sendRequest({
        method: "post",
        url: `/frontend/v1/customer/${id}`,
        data: form.value,
        params: {
            _method: "PUT",
        },
        headers: {
            "Content-Type": "multipart/form-data",
            authorization: `Bearer ${authStore?.user?.token}`,
        },
    });
    if (response?.data) {
        toast.success(`Customer Update Succesfully`, {
            autoclose: 1000,
        });
        await router.push("/products");
    }
};

onMounted(async () => {
    window.scrollTo(0, 0);
    await getCustomer();
    await fetchOrders(customer.value.id);
});
</script>
<template>
    <AppLayout>
        <section
            class="w-full h-40 lg:h-60 bg-[url('@/assets/images/Tax-Digital.png')] bg-no-repeat bg-cover object-cover"
        ></section>
        <section class="px-6 lg:px-0 max-w-3xl mx-auto -mt-16 lg:-mt-28 pb-10">
            <div class="p-5 bg-white shadow">
                <div class="flex items-start lg:items-center">
                    <div
                        class="w-12 h-12 lg:w-20 lg:h-20 rounded-full overflow-hidden border-4 border-border"
                    >
                        <img
                            class="w-full h-full object-cover"
                            src="https://cdn-icons-png.freepik.com/256/15232/15232242.png?uid=R102446229&ga=GA1.1.1386564851.1716744340&semt=ais_hybrid"
                        />
                        digital-tax.png
                    </div>
                    <div class="pl-5">
                        <h3
                            class="text-xl lg:text-3xl font-semibold font-serif"
                        >
                            {{ authStore?.user?.user?.name }}
                        </h3>
                        <p class="mb-2 text-sm font-momo">
                            {{
                                moment(customer?.created_at).format(
                                    "MMMM Do YYYY"
                                )
                            }}
                        </p>

                        <span
                            class="inline-flex items-center gap-2 border rounded-md px-2 py-1 text-xs"
                        >
                            <Icon
                                name="mdi:check-decagram"
                                class="text-blue-600 text-lg font-serif"
                            />
                            verified account
                        </span>
                    </div>
                </div>
            </div>
            <Container class="pb-10 max-w-xl mt-10">
                <ul
                    class="flex items-center border-b border-border mb-4 bg-white"
                >
                    <li v-for="(tab, index) in tabs" :key="index">
                        <button
                            @click="activeTab = index"
                            :class="[
                                'px-4 py-2 w-full border-b',
                                activeTab === index
                                    ? 'border-primary font-semibold text-primary'
                                    : 'text-black font-semibold',
                            ]"
                        >
                            {{ tab }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="authStore?.logout"
                            class="flex items-center gap-2 text-black font-semibold"
                        >
                            Logout
                            <Icon name="ci:log-out" class="text-primary"/>
                        </button>
                    </li>
                </ul>

                <div v-if="activeTab === 0">
                    <div class="flex flex-col gap-4 bg-white">
                        <div
                            v-if="allOrders"
                            class="w-full grid grid-cols-1 sm:grid-cols-3 gap-4"
                        >
                            <div
                                class="w-full relative font-serif bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow border border-secondary/40"
                                v-for="order in allOrders?.data"
                                :key="order.id"
                            >
                                <div class="p-4">
                                    <!-- Product Image -->
                                    <img
                                        class="w-full h-40 object-cover rounded mb-3"
                                        :src="order?.packages?.image"
                                        alt="Product Image"
                                    />
                                    <!-- Order Info -->
                                    <h3 class="text-lg font-semibold mb-2">
                                        {{ order?.companey_name }}
                                    </h3>
                                    <h4 class="text-base text-black font-medium mb-2">
                                        {{ order?.package_name }}
                                    </h4>
                                    <p class="text-sm text-gray-800">
                                        <span class="font-bold text-black">Order Date:</span> {{ order?.created_at }}
                                    </p>
                                    <p class="text-sm text-gray-800">
                                        <span class="font-bold text-black">Price:</span> {{ order?.total_payment }}
                                    </p>
                                    <span class="text-sm text-gray-800"
                                        ><span class="font-bold text-black">Payment Method:</span> {{ order?.payment_method }}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="activeTab === 1">
                    <div
                        v-if="customerLoading"
                        class="w-full border bg-white border-border rounded-md p-4 mb-5"
                    >
                        <h3
                            class="mb-4 h-6 w-80 bg-slate-300 rounded animate-pulse"
                        ></h3>
                        <p
                            class="h-5 mb-2 w-40 bg-slate-300 rounded animate-pulse"
                        ></p>
                        <p
                            class="h-5 w-56 bg-slate-300 rounded animate-pulse"
                        ></p>
                    </div>

                    <div
                        v-else
                        class="border border-border rounded-lg p-4 mb-5 bg-white font-serif"
                    >
                        <h3 class="text-xl font-semibold mb-2">
                            {{ customer?.name }}
                        </h3>
                        <div class="flex items-center gap-1 mb-1">
                            <Icon name="hugeicons:call" />
                            {{ customer?.phone }}
                        </div>
                        <div class="flex items-center gap-1">
                            <Icon name="hugeicons:mail-01" />
                            {{ customer?.email }}
                        </div>
                    </div>
                </div>
                <div v-if="activeTab === 2">
                    <div
                        v-if="customerLoading"
                        class="w-full border bg-white border-border rounded-md p-4 mb-5"
                    >
                        <h3
                            class="mb-4 h-6 w-80 bg-slate-300 rounded animate-pulse"
                        ></h3>
                        <p
                            class="h-5 mb-2 w-40 bg-slate-300 rounded animate-pulse"
                        ></p>
                        <p
                            class="h-5 w-56 bg-slate-300 rounded animate-pulse"
                        ></p>
                    </div>
                    <div
                        v-else
                        class="border border-border rounded-lg p-4 mb-5 bg-white font-serif"
                    >
                        <div class="">
                            <label for="email" class="block pb-1 text-xs"
                                >Name</label
                            >
                            <input
                                type="text"
                                name="name"
                                id="email"
                                v-model="form.name"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>
                        <div class="">
                            <label for="phone" class="block pb-1 text-xs"
                                >Phone</label
                            >
                            <input
                                pattern="[0-9]*"
                                inputmode="numeric"
                                name="phone"
                                id="number"
                                v-model="form.phone"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>
                        <div class="">
                            <label for="email" class="block pb-1 text-xs"
                                >Email</label
                            >
                            <input
                                type="email"
                                name="email"
                                id="email"
                                v-model="form.email"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>
                        <div class="">
                            <label for="password" class="block pb-1 text-xs"
                                >Old Password</label
                            >
                            <input
                                type="password"
                                name="old_password"
                                v-model="form.old_password"
                                id="password"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>

                        <div class="">
                            <label for="password" class="block pb-1 text-xs"
                                >New Password</label
                            >
                            <input
                                type="password"
                                name="new_password"
                                v-model="form.new_password"
                                id="password"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>

                        <div class="">
                            <label for="password" class="block pb-1 text-xs"
                                >Confirm New Password</label
                            >
                            <input
                                type="password"
                                name="new_password_confirmation"
                                v-model="form.new_password_confirmation"
                                id="password"
                                class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                            />
                        </div>

                        <div class="text-center py-5">
                            <button
                                @click="onSubmit(customer.id)"
                                class="w-full py-2 bg-primary text-white font-bold text-center rounded-lg my-2"
                            >
                                Update Account
                            </button>
                        </div>
                    </div>
                </div>
            </Container>
        </section>
    </AppLayout>
</template>
