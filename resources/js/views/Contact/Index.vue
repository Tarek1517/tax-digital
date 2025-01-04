<script setup>


import Container from '@/components/Container.vue'
</script>

<template>
    <AppLayout>
        <section class="bg-primary/10 h-auto py-16">
            <Container>
                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/3">
                        <div class="h-full">
                            <img class="w-full h-full object-cover" src="https://images.pexels.com/photos/7567523/pexels-photo-7567523.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
                        </div>
                    </div>
                    <div class="w-full lg:w-2/3 order-first lg:order-last">
                        <div class=" bg-white p-6 lg:p-12 text-center">
                            <h2 class="text-3xl lg:text-5xl font-semibold text-secondary">Post your query here</h2>
                            <p class="text-sm  lg:text-lg text-gray-600 py-3">Feel free to get in touch for more help</p>
                        </div>
                        <div class=" bg-white px-6 lg:px-12 ">
                            <div class="flex flex-wrap items-center -mx-5">
                                <div class="w-full lg:w-1/2 px-5 mb-7">
                                    <div>
                                      <input type="text" placeholder="Full Name *" class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary "  />
                                    </div>
                                </div>
                                <div class="w-full lg:w-1/2 px-5 mb-7">
                                  <div>
                                    <input type="email" placeholder="Email Address *" class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary "  />
                                  </div>
                                </div>
                                <div class="w-full lg:w-1/2 px-5 mb-7">
                                    <div>
                                      <input type="number" placeholder="Contact Number *" class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary" />
                                    </div>
                                </div>

                                <div class="w-full lg:w-1/2 px-5 mb-7">
                                    <div>
                                      <input type="text" placeholder="Company *" class="w-full border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary "  />
                                    </div>
                                </div>
                                <div class="w-full px-5">
                                    <div>
                                      <textarea type="text" placeholder="Message" class="w-full h-28 border-0 border-b border-gray-400 ring-0 focus:ring-0 outline-0 focus:outline-0 focus:border-primary "></textarea>
                                    </div>
                                    <p class="text-sm font-normal mt-5 text-gray-500">We take data very seriously, hence we treat your company details in accordance with EU (2016/679) GDPR Article 6 (Lawfulness of Processing). In order to protect the vital interest of the data and with your specific consent we`d like to send you the most appropriate information and exclusive offers from Tax Digital. You will not be receiving any marketing e-mails or cold calls from our end.</p>
                                </div>
                              <RouterLink to="/" class="w-full inline-block bg-primary mx-5 mt-8 text-white text-center py-1 font-bold mb-10">SUBMIT MESSAGE</RouterLink>
                            </div>
                        </div>
                    </div>
                </div>
            </Container>
        </section>
        <section class="bg-white py-8 lg:py-20">
            <Container>
                <div class="flex flex-wrap -mx-5">
                    <div class="w-full lg:w-1/2 px-5 mb-5 lg:mb-0">
                        <div class="flex justify-between px-6 lg:px-12 py-3 lg:py-7 border-2 rounded-2xl border-primary/20 hover:border-primary/50 bg-secondary/10">
                            <div>
                                <h2 class="text-xl lg:text-3xl font-semibold text-secondary">Get a Custom Quote</h2>
                                <p class="text-gray-600 text-sm lg:text-lg ">For your specific business needs</p>
                            </div>
                          <div>
                            <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/quote-icon1.svg" alt="">
                          </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 px-5">
                        <div class="flex justify-between px-6 lg:px-12 py-3 lg:py-7 border-2 rounded-2xl border-primary/20 hover:border-primary/50 bg-secondary/10">
                            <div>
                              <h2 class="text-xl lg:text-3xl font-semibold text-secondary">Request a callback</h2>
                              <p class="text-gray-600 text-sm lg:text-lg ">At a time that suits you</p>
                            </div>
                            <div>
                              <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/quote-icon2.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </Container>
        </section>

    </AppLayout>
</template>

<style scoped>

</style>