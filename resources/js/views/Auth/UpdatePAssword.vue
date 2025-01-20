<template>
    <AppLayout>
        <div class="w-full flex justify-center items-center py-10 lg:py-20">
            <div
                class="w-full max-w-4xl bg-white flex flex-wrap rounded-xl shadow-xl p-4 justify-center items-center"
            >
                <div class="w-full lg:w-1/2 lg:pr-5">
                    <h3 class="text-2xl font-semibold mb-3 text-center">
                       Update Password
                    </h3>
                   
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

                    <div class="text-center py-2">
                        <button
                            @click="UpdatePassword"
                            class="w-full py-2 bg-primary text-white font-bold text-center rounded-lg my-2"
                        >
                            Update Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from "vue";
import useAxios from "@/composables/useAxios";
import { useRouter, useRoute } from "vue-router";
import { toast } from "vue3-toastify";
const router = useRouter();
const route = useRoute();
const { loading, error, sendRequest } = useAxios();

const form = ref({
    email: route.query.email,
    new_password: null,
    new_password_confirmation: null,
});

const UpdatePassword = async () => {
    const response = await sendRequest({
        method: "post",
        url: "/customer/reset-password",
        data: form.value,
    });
    if (response?.data) {
        toast.success(`Password Update Successfully`, {
            autoclose: 1000,
        });
        await router.push("/login");
    }
};
</script>
