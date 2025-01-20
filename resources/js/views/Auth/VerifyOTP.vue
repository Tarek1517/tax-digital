<template>
    <AppLayout>
        <div class="w-full flex justify-center items-center py-10 lg:py-20">
            <div
                class="w-full max-w-4xl bg-white flex flex-wrap rounded-xl shadow-xl p-4 justify-center items-center"
            >
                <div class="w-full lg:w-1/2 lg:pr-5">
                    <h3 class="text-2xl font-semibold mb-3 text-center">
                       OTP Verification
                    </h3>

                    <div class="">
                        <label for="otp" class="block pb-1 text-xs">Write Given OTP</label>
                        <input
                            type="text"
                            name="otp"
                            id="otp"
                            v-model="form.otp"
                            class="bg-transparent block w-full rounded-md p-2 shadow-sm border border-primary focus:outline-none placeholder:text-gray-400 px-3 mb-2"
                        />
                    </div>

                    <div class="text-center py-2">
                        <button
                            @click="checkOtp"
                            class="w-full py-2 bg-primary text-white font-bold text-center rounded-lg my-2"
                        >
                            Verify OTP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from "vue";
import  useAxios  from '@/composables/useAxios';
import { useRouter, useRoute } from 'vue-router';
import { toast } from "vue3-toastify";
const router = useRouter();
const route = useRoute();
const { loading, error, sendRequest } = useAxios();

const form = ref({
    email: route.query.email,
    otp: null,
});

const checkOtp = async() => {
    const response = await sendRequest({
        method: 'post',
        url: '/customer/check-otp',
        data: form.value,
    });
    if(response?.data){
        router.push({ name: 'updatePassword', query: { email: form.value.email } });
    }
}
</script>


