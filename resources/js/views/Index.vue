<script setup>
import HeroSection from '@/components/Home/HeroSection.vue'
import Features from '@/components/Home/Features.vue'
import Container from '@/components/Container.vue'
import AppLayout from "@/components/AppLayout.vue";

</script>

<template>
  <AppLayout>
    <HeroSection />
    <Features />
<!--    What to do...section -->
    <section class="lg:pt-20">
        <Container>
            <div class="flex flex-wrap">
                <div class="w-full lg:w-1/2">
                    <div>
                      <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/what-we-do.svg" alt="">
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="py-8 lg:py-28">
                      <h2 class="text-2xl lg:text-4xl font-bold text-black">What do we do</h2>
                      <p class="text-sm lg:text-lg text-gray-700 py-5 lg:py-7 leading-loose max-w-xl">You are already too busy with the daily grind as a business owner, what you need is an accountant who's prompt and reliable and can set you ready for the next step by making use of clear and business-focused language without paperwork faff, in other words, we do online accounting</p>
                      <p class="text-sm lg:text-lg text-gray-700 lg:pb-7">It includes the preparation of iXBRL accounts and tax returns.</p>
                    </div>
                </div>
            </div>
        </Container>
    </section>

<!--    How it works -->
    <section class="h-auto bg-center bg-no-repeat bg-cover bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/home/how-it-work-bg.svg')]">
        <Container>
            <div >
                <div class="lg:text-center">
                  <h2 class="text-2xl lg:text-4xl font-bold text-black lg:pt-10">How it Works</h2>
                  <p class="text-sm lg:text-lg text-gray-700 py-3">In 4 easy and paperless steps;</p>
                </div>
                <div class="flex flex-wrap py-10">
                    <div class="w-full lg:w-1/4 px-4">
                        <div>
                          <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/how-it-works1.svg" alt="">
                          <h4 class="text-xl font-medium text-black max-w-20 py-4 lg:py-8" >Information sharing</h4>
                          <span class="w-12 h-[1px] bg-gray-500 block "> </span>
                          <p class="text-sm lg:text-lg text-gray-700 py-4 lg:py-7 leading-loose w-50">Your financial information is to be processed online in compliance with GDPR/EU. For example, you can share your bank statements via email with your accountant to walk through them.</p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/4 px-4">
                        <div>
                          <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/how-it-works2.svg" alt="">
                          <h4 class="text-xl font-medium text-black  py-4 lg:py-8" >Company Accounts & tax returns preparation</h4>
                          <span class="w-32 h-[1px] bg-gray-500 block "> </span>
                          <p class="text-sm lg:text-lg text-gray-700 py-4 lg:py-7 leading-loose w-50">iXBRL accounts and tax returns are prepared as per Companies House and HMRC's requirements.</p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/4 px-4">
                        <div>
                          <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/how-it-works3.svg" alt="">
                          <h4 class="text-xl font-medium text-black max-w-44 py-4 lg:py-8" >Review & approval of drafts</h4>
                          <span class="w-32 h-[1px] bg-gray-500 block "> </span>
                          <p class="text-sm lg:text-lg text-gray-700 py-4 lg:py-7 leading-loose max-w-50">You get to review and sign off on every step. We don't submit your accounts before having your approval.</p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/4 px-4">
                        <div class="">
                          <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/how-it-works4.svg" alt="">
                          <h4 class="text-xl font-medium text-black py-4 lg:py-8" >Submission to HMRC & Companies House</h4>
                          <span class="w-32 h-[1px] bg-gray-500 block "> </span>
                          <p class="text-sm lg:text-lg text-gray-700 py-4 lg:py-7 leading-loose max-w-50">Once you approve the accounts, we submit your company accounts & tax return to the authorities and share the proof of submission for your record.</p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button
                      class="bg-secondary text-lg lg:text-2xl text-white py-1 lg:py-3 px-10 lg:mb-8 rounded-full hover:bg-primary transition-all ease-in-out duration-500">
                      Watch Video
                    </button>
                </div>
            </div>
        </Container>
    </section>

<!--    Who do we help to section -->
    <section class="h-auto bg-center bg-no-repeat bg-cover lg:py-20 bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/home/do-help-bg.svg')]">
      <Container>
        <div>
            <h2 class="text-2xl lg:text-4xl font-bold text-black text-center py-12">Who do we help to</h2>
            <ul class="flex flex-wrap justify-center gap-5 lg:gap-14 mb-10 lg:mb-20 mx-auto">
                <li class="flex justify-center gap-3 bg-white rounded-xl px-8 lg:px-16 py-3 lg:py-6 shadow-lg">
                  <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/do-help-lidt-icon.svg" alt="">
                  <p class="text-sm lg:text-lg text-gray-700 font-normal">Limited companies</p>
                </li>
                <li class="flex justify-center gap-3 bg-white rounded-xl px-8 lg:px-16 py-3 lg:py-6 shadow-lg">
                  <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/do-help-lidt-icon.svg" alt="">
                  <p class="text-sm lg:text-lg text-gray-700 font-normal">CICs</p>
                </li>
                <li class="flex justify-center gap-3 bg-white rounded-xl px-8 lg:px-16 py-3 lg:py-6 shadow-lg">
                  <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/do-help-lidt-icon.svg" alt="">
                  <p class="text-sm lg:text-lg text-gray-700 font-normal">LLPs</p>
                </li>
                <li class="flex justify-center gap-3 bg-white rounded-xl px-8 lg:px-16 py-3 lg:py-6 shadow-lg">
                  <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/do-help-lidt-icon.svg" alt="">
                  <p class="text-sm lg:text-lg text-gray-700 font-normal">Partnerships</p>
                </li>
                <li class="flex justify-center gap-3 bg-white rounded-xl px-8 lg:px-16 py-3 lg:py-6 shadow-lg">
                  <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/do-help-lidt-icon.svg" alt="">
                  <p class="text-sm lg:text-lg text-gray-700 font-normal">Freelancers</p>
                </li>
                <li class="flex justify-center gap-3 bg-white rounded-xl px-8 lg:px-16 py-3 lg:py-6 shadow-lg">
                  <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/do-help-lidt-icon.svg" alt="">
                  <p class="text-sm lg:text-lg text-gray-700 font-normal">Self-employed professionals</p>
                </li>
            </ul>
        </div>
      </Container>
    </section>

    <!-- How long it takes section  -->
    <section class="lg:pt-10">
      <Container>
        <div class="flex flex-wrap items-center -mx-12">
          <div class="w-full lg:w-1/2 px-12">
            <div>
              <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/how-long-it-takes.svg" alt="">
            </div>
          </div>
          <div class="w-full lg:w-1/2 px-12">
            <div class="py-12 lg:py-28">
              <h2 class="text-2xl lg:text-4xl font-bold text-black">How long it takes</h2>
              <p class="text-sm lg:text-lg text-gray-700 py-4 lg:py-7 leading-loose max-w-lg">A company account and tax return filing for a limited company take us 3 to 5 working days in most circumstances.</p>
              <p class="text-sm lg:text-lg text-gray-700 lg:pb-7 leading-loose max-w-lg">If the deadline is fast approaching, we have an express company filing service that's guaranteed to submit your accounts to Companies House and HMRC within 24 hours for an extra £99.</p>
            </div>
          </div>
        </div>
      </Container>
    </section>

<!--    Other Services we offer section-->
      <section class="h-auto relative bg-center bg-no-repeat bg-cover py-8 lg:py-20 bg-[url('https://www.debitam.com/wp-content/themes/debitam-uk/image/home/other-services-bg.svg')]">
            <span class="absolute top-0 left-0 bottom-0 right-0 w-full h-full bg-purple-600/5 "></span>
          <Container class="relative z-10">
              <div class="flex flex-wrap">
                  <div class="w-full lg:w-1/3 px-5 mb-5 lg:mb-10">
                      <div class="flex flex-col justify-center w-full h-full px-5">
                          <h2 class="text-3xl  lg:text-5xl font-semibold ">Other services we offer</h2>
                          <div class="flex items-center gap-4 pt-3 lg:pt-8">
                            <p class="text-lg lg:text-xl font-semibold text-gray-600">More Services</p>
                            <img class="w-5 h-5 pt-1" src="https://www.debitam.com/wp-content/themes/debitam-uk/image/blue-right-arrow.svg" alt="">
                          </div>
                      </div>
                  </div>
                  <div class="w-full lg:w-1/3 px-5 mb-5 lg:mb-10">
                      <div class="w-full h-full p-5 lg:p-10 rounded-md bg-white">
                        <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/other-service1.svg" alt="">
                        <h3 class="text-lg lg:text-xl font-medium py-2 lg:py-4">VAT Return</h3>
                        <p class="text-sm lg:text-base text-gray-700 leading-loose ">Automate your reports and accounts with our bookkeeping services.</p>
                      </div>
                  </div>
                  <div class="w-full lg:w-1/3 px-5 mb-5 lg:mb-10">
                      <div class="w-full h-full p-5 lg:p-10 rounded-md bg-white">
                        <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/other-service2.svg" alt="">
                        <h3 class="text-lg lg:text-xl font-medium py-2 lg:py-4">VAT Return</h3>
                        <p class="text-sm lg:text-base text-gray-700 leading-loose ">Automate your reports and accounts with our bookkeeping services.</p>
                      </div>
                  </div>
                  <div class="w-full lg:w-1/3 px-5 mb-5 lg:mb-10">
                      <div class="w-full h-full p-5 lg:p-10 rounded-md bg-white">
                        <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/other-service3.svg" alt="">
                        <h3 class="text-lg lg:text-xl font-medium py-2 lg:py-4">VAT Return</h3>
                        <p class="text-sm lg:text-base text-gray-700 leading-loose ">Automate your reports and accounts with our bookkeeping services.</p>
                      </div>
                  </div>
                  <div class="w-full lg:w-1/3 px-5 mb-5 lg:mb-10">
                      <div class="w-full h-full p-5 lg:p-10 rounded-md bg-white">
                        <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/other-service4.svg" alt="">
                        <h3 class="text-lg lg:text-xl font-medium py-2 lg:py-4">VAT Return</h3>
                        <p class="text-sm lg:text-base text-gray-700  leading-loose ">Automate your reports and accounts with our bookkeeping services.</p>
                      </div>
                  </div>
                  <div class="w-full lg:w-1/3 px-5 mb-5 lg:mb-10">
                      <div class="w-full h-full p-5 lg:p-10 rounded-md bg-white">
                        <img src="https://www.debitam.com/wp-content/themes/debitam-uk/image/home/other-service5.svg" alt="">
                        <h3 class="text-lg lg:text-xl font-medium py-2 lg:py-4">VAT Return</h3>
                        <p class="text-sm lg:text-base text-gray-700  leading-loose ">Automate your reports and accounts with our bookkeeping services.</p>
                      </div>
                  </div>
              </div>
              <div class="text-center mt-9">
                  <button
                    class="bg-secondary text-lg lg:text-2xl text-white py-1 lg:py-3 px-10 lg:mb-8 rounded-full hover:bg-primary transition-all ease-in-out duration-500">
                    Buy Now
                  </button>
              </div>
          </Container>
      </section>
  </AppLayout>
</template>
