<template>
    <section class="bg-white py-12">
        <Container>
          <div class="flex flex-wrap">
            <!-- Left Side: YouTube Video -->
            <div class="w-full lg:w-1/2 mb-5 lg:mb-0">
              <iframe
                src="https://www.youtube.com/embed/wOq2XaxY214?si=ChPNfpVAluOvIkXk"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
                class="rounded-2xl w-full h-full"
              ></iframe>
            </div>

            <!-- Right Side: Features -->
            <div class="w-full lg:w-1/2">
<!--                <div>-->
<!--                    <ul>-->
<!--                        <li class="flex items-center border shadow-lg p-4 rounded-lg">-->
<!--                            <span class="flex items-center justify-center bg-secondary/35 w-10 h-10 rounded-full">-->
<!--                              <Icon name="solar:share-linear" class="text-xl" />-->
<!--                            </span>-->
<!--                            <p class="text-gray-900 text-[17px] font-medium">Digital Information Sharing</p>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->



              <div class="rounded-lg p-6 space-y-4">
                <!-- Feature 1 -->
                <div class="flex items-center space-x-3 shadow-lg border p-4 py-3 rounded-lg">
                  <div class="w-10 min-w-10 h-10 grid place-content-center bg-secondary border rounded-full">
                    <i class="fa fa-share-alt text-primary text-lg" aria-hidden="true"></i>
                  </div>
                  <p class="text-gray-900 text-[17px] font-medium">Digital Information Sharing</p>
                </div>

                <!-- Feature 2 -->
                <div
                  class="flex items-center space-x-3 shadow-lg bg-opacity-50 bg-green-100 p-4 py-3 rounded-lg"
                >
                  <div class="w-10 h-10 grid place-content-center bg-white border rounded-full">
                    <i class="fa fa-calendar text-primary text-lg" aria-hidden="true"></i>
                  </div>
                  <p class="text-gray-900 text-[17px] font-medium">3 to 5 Days Turnaround</p>
                </div>

                <!-- Feature 3 -->
                <div class="flex items-center space-x-3 border shadow-lg bg-white p-4 py-3 rounded-lg">
                  <div class="w-10 min-w-10 h-10 grid place-content-center bg-secondary border rounded-full">
                    <i class="fa fa-user text-primary text-lg" aria-hidden="true"></i>
                  </div>
                  <p class="text-gray-900 text-[17px] font-medium">Dedicated Account Manager</p>
                </div>

                <!-- Feature 4 -->
                <div
                  class="flex items-center space-x-3 shadow-lg bg-opacity-50 bg-green-100 p-4 py-3 rounded-lg"
                >
                  <div class="w-10 h-10 grid place-content-center bg-white border rounded-full">
                    <i class="fa fa-file-text text-primary text-lg" aria-hidden="true"></i>
                  </div>
                  <p class="text-gray-900 text-[17px] font-medium">No Monthly Contracts</p>
                </div>
              </div>
            </div>
          </div>
        </Container>
    </section>
</template>

<script>
import Container from '@/components/Container.vue'
import Icon from '@/components/Icon.vue'

export default {
  components: { Icon, Container }
}
</script>

<style></style>
