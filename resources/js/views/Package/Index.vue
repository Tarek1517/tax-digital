<script setup>

import AppLayout from '@/components/AppLayout.vue'
import PricingCard from '@/components/PricingCard.vue'
import Container from "@/components/Container.vue";
</script>

<template>
    <AppLayout>
        <section class="h-auto bg-top bg-no-repeat bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/pricing/header-bg.svg')]">
            <Container>
                <div class="text-center py-10">
                    <h2 class="text-3xl lg:text-5xl font-semi bold text-secondary">Tailored pricing for your specific needs</h2>
                    <p class="text-sm lg:text-lg text-gray-700 py-3">We like to keep it very simple and charge for only what you actually need for your business.</p>
                </div>

                <div class="flex flex-wrap justify-center -mx-5">
                    <div class="w-full lg:w-1/3 px-5" v-for="item in 5">
                      <PricingCard />
                    </div>
                </div>
            </Container>
            <div class="flex justify-center">
              <img class="object-cover" src="https://www.debitam.com/wp-content/themes/debitam-uk/image/pricing/pp-img.svg" alt="">
            </div>
            <div class="flex items-center justify-center bg-secondary/5">
                <h3 class="text-xl lg:text-2xl text-center font-semibold text-secondary py-10 w-2/3">
                  25,000+ Companies trust us for their year-end accounts and tax return.
                  Find out more about our customers' experiences below.
                </h3>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>

</style>
