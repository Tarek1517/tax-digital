<script setup>
import Container from '@/components/Container.vue'
import AppLayout from "@/components/AppLayout.vue";
import { ref, onMounted } from "vue";
import useAxios from "@/composables/useAxios.js";

const { loading, error, sendRequest } = useAxios();
const allData = ref([]);

const fetchAboutHeroData = async () => {
    try {
        const response = await sendRequest({
            method: "get",
            url: "frontend/v1/about-hero-section",
        });
        allData.value = response?.data?.data || [];
    } catch (error) {
        console.error("Error fetching Packages:", error);
    }
};

onMounted(() => {
  fetchAboutHeroData();
});
</script>

<template>
    <AppLayout>
        <section>
            <Container>
                <div class="flex flex-wrap py-10">
                    <div class="w-full lg:w-1/2">
                        <div class="">
                            <p class="text-sm lg:text-lg text-primary py-3">{{ allData.sub_title }}</p>
                            <h2 class="text-3xl lg:text-5xl font-bold text-black">{{ allData.title }}</h2>
                        </div>
                    </div>
                    
                    <div class="w-full lg:w-1/2">
                        <div class=" pt-10 px-8 ">
                            <p class="border-l-2 border-primary/25 pl-5 text-sm lg:text-lg text-gray-700 py-3">{{ allData.short_description }}</p>
                        </div>
                    </div>
                </div>
              <div class="rounded-2xl">
                <img class="rounded-2xl" :src="allData?.image" alt="">
              </div>
            </Container>
        </section>
      <section class="h-auto my-5 lg:my-20 bg-top bg-no-repeat bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/why-oaf-header-bg.webp')]">
        <Container>
          <div class="w-full lg:w-1/2 lg:py-20">
            <p class="text-sm lg:text-lg text-primary py-5">Why Tax Digital</p>
            <h2 class="text-3xl lg:text-5xl font-bold text-black">High street accountants versus Tax Digital</h2>
            <p class="text-sm lg:text-lg text-gray-600 py-4 lg:py-8">In the highly digital age, the wonders of technology have taken a principal role in our lives. Right from buying groceries to booking movie tickets, everything can be done with a click. The trend of getting things done online has invaded traditional ways of buying, booking, reservations etc. and there's no looking back.</p>
          </div>
        </Container>
      </section>
        <section class="">
        <Container>
          <div class="flex flex-wrap lg:py-10">
            <div class="w-full lg:w-1/2">
              <div class="">
                <h2 class="text-3xl lg:text-5xl font-bold text-black pr-12">The Great British Business Show 2021</h2>
                <p class="text-sm lg:text-lg text-gray-700 py-7  max-w-lg">The event regularly attracts a diverse range of attendees from around the world, across different professions, and with different levels of experience.</p>
                <p class="text-sm lg:text-lg text-gray-700 pb-7 max-w-60">24th & 25th November 2021
                  ExCel, London</p>
              </div>
            </div>
            <div class="w-full lg:w-1/2">
              <div class="flex items-center">
                <img class="h-96 w-96" src="https://img.freepik.com/premium-photo/small-team-collaborating-working-together_1240525-101212.jpg?w=740" alt="">
              </div>
            </div>

          </div>
        </Container>
      </section>
    </AppLayout>
</template>

<style scoped>

</style>@
