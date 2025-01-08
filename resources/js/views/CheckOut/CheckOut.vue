<script setup>
import Container from "@/components/Container.vue";
import { useAuthStore } from "@/stores/useAuthStore";
import { ref, onMounted, computed } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";
import { toast } from "vue3-toastify";
const route = useRoute();
const { error, loading, sendRequest } = useAxios();
import useAxios from "@/composables/useAxios.js";
const PackageData = ref([]);
const slug = route.params.slug;

const authStore = useAuthStore();

const fetchPackages = async () => {
    try {
        const response = await sendRequest({
            method: "get",
            url: `frontend/v1/get-package-data/${slug}`,
        });
        PackageData.value = response?.data || [];
    } catch (error) {
        console.error("Error fetching Packages:", error);
    }
};

const form = ref({
    companey_name: null,
    cus_name: null,
    user_id: computed(() => authStore?.user?.user?.id),
    cus_phone: null,
    cus_email: null,
    total_payment: computed(() => PackageData.value?.data?.price || null),
    package_name: computed(() => PackageData.value?.data?.title || null),
    payment_method: "stripe",
    package_id: computed(() => PackageData.value?.data?.id || null),
});

const order = async () => {
  try {
    const response = await sendRequest({
      method: "post",
      url: "/frontend/v1/save-order",
      data: form.value,
      headers: {
        authorization: `Bearer ${authStore?.user?.token}`,
      },
    });

    if (response && response.data) {
      const { url } = response.data;

      if (url) {
        window.location.href = url;
      } else {
        toast.success(`Order Added Successfully`, {
          autoclose: 1000,
        });
      }
    }
  } catch (error) {
    console.error("Error initiating payment:", error);
  }
};


onMounted(() => {
    fetchPackages();
});
</script>

<template>
    <AppLayout>
        <section class="bg-primary/10 h-auto py-16">
            <Container>
                <div class="flex flex-col lg:flex-row gap-y-6 lg:gap-x-6">
                    <!-- Left Section: Form -->
                    <div class="w-full lg:w-2/3">
                        <div class="bg-white p-6 lg:p-12 text-center">
                            <h2
                                class="text-xl lg:text-3xl font-bold text-black"
                            >
                                Information
                            </h2>
                        </div>

                        <div class="bg-white px-6 lg:px-12">
                            <div class="flex flex-wrap items-center -mx-5">
                                <div class="w-full lg:w-1/2 px-5 mb-7">
                                    <div>
                                        <input
                                            v-model="form.companey_name"
                                            type="text"
                                            placeholder="Company Name *"
                                            class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                                        />
                                    </div>
                                </div>

                                <div class="w-full lg:w-1/2 px-5 mb-7">
                                    <div>
                                        <input
                                        v-model="form.cus_name"
                                            type="text"
                                            placeholder="Full Name *"
                                            class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-1/2 px-5 mb-7">
                                    <div>
                                        <input
                                         v-model="form.cus_email"
                                            type="email"
                                            placeholder="Email Address *"
                                            class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-1/2 px-5 mb-7">
                                    <div>
                                        <input
                                         v-model="form.cus_phone"
                                            type="number"
                                            placeholder="Contact Number *"
                                            class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-6 lg:p-12 text-center">
                            <p class="text-sm lg:text-lg text-primary/55 py-3">
                                We like to keep it very simple and charge for
                                only what you actually need for your business.
                            </p>
                        </div>
                    </div>
                    <!-- Right Section: Image -->
                    <div class="w-full lg:w-1/3 bg-white p-6 lg:p-12">
                        <table class="border-collapse w-full mb-5">
                            <thead>
                                <tr>
                                    <th class="text-left pb-5">
                                        <span class="border-b-2 border-primary"
                                            >Package Name</span
                                        >
                                    </th>
                                    <th class="text-end pb-5">
                                        <span class="border-b-2 border-primary"
                                            >Price</span
                                        >
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- Product Title -->
                                    <td class="text-left">
                                        <div
                                            class="flex items-center space-x-3"
                                        >
                                            <img
                                                class="w-7 h-auto rounded mb-1"
                                                :src="PackageData?.data?.image"
                                                alt="Product Image"
                                            />
                                            <h3
                                                class="font-medium text-xs font-serif pr-5"
                                            >
                                                {{
                                                    PackageData?.data?.title ||
                                                    "No Title Available"
                                                }}
                                            </h3>
                                        </div>
                                    </td>

                                    <!-- Product Price -->
                                    <td class="text-end">
                                        <p class="text-base font-serif">
                                            £{{ PackageData?.data?.price }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="space-y-4 text-gray-600">
                            <li class="flex items-center">
                                <!-- Checkbox -->
                                <input
                                    type="checkbox"
                                    checked
                                    disabled
                                    class="w-4 h-4 text-primary border-gray-300 rounded-full focus:ring-primary"
                                />

                                <!-- Image -->
                                <img
                                    class="w-auto h-16"
                                    src="@/assets/images/stripe.png"
                                    alt="SSL Logo"
                                />
                            </li>

                            <li class="flex justify-between items-center">
                                <strong
                                    class="text-base font-bold text-gray-500"
                                >
                                    Total Payment:
                                </strong>
                                <span class="text-xl font-bold text-primary"
                                    >£{{ PackageData?.data?.price }}</span
                                >
                            </li>

                            <div>
                                <button
                                    v-if="authStore?.user"
                                    @click="order"
                                    type="submit"
                                    class="flex items-center justify-center text-white gap-2 bg-primary hover:bg-secondary w-full text-center text-base py-3 my-5 font-semibold rounded-lg transition-all ease-in-out duration-500"
                                >
                                    Pay Now
                                </button>

                                <RouterLink
                                    v-else
                                    to="/login"
                                    type="submit"
                                    class="flex items-center justify-center text-white gap-2 bg-primary hover:bg-secondary w-full text-center text-base py-3 my-5 font-semibold rounded-lg transition-all ease-in-out duration-500"
                                >
                                    Pay Now
                                </RouterLink>

                                <div
                                    class="flex items-center justify-center space-x-2"
                                >
                                    <!-- Icon -->
                                    <Icon
                                        name="ep:lock"
                                        class="text-base text-primary"
                                    />
                                    <!-- Text -->
                                    <span class="text-sm">Secured Payment</span>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </Container>
        </section>
    </AppLayout>
</template>

<style scoped></style>
