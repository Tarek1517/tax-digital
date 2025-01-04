<script setup lang="ts">
import { RouterLink } from 'vue-router';
import {ref} from 'vue';
import Icon from '@/components/Icon.vue'

const isNav = ref(false);
</script>


<template>
  <section class="lg:hidden bg-primary/15 shadow-xl">
    <Container class="flex items-center justify-between ">
      <RouterLink to="/">
          <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center my-2">
            <div class="w-6 h-6 bg-white rounded-full"></div>
          </div>
      </RouterLink>

      <button v-if="isNav" @click="isNav = !isNav" class="w-8 h-8 border border-primary rounded-full flex items-center justify-center">
        <Icon name="material-symbols:close-rounded" class="text-2xl text-secondary" />
      </button>
      <button v-else @click="isNav = !isNav" class="w-8 h-8 border border-primary flex items-center justify-center">
        <Icon name="ic:baseline-menu" class="text-2xl text-secondary" />
      </button>

    </Container>


    <div class="fixed top-0 left-0 bottom-0 h-screen w-64 bg-white z-50 shadow transition-all duration-700"
         :class="{'-translate-x-0' : isNav, '-translate-x-64' : !isNav}"
    >
      <ul class="flex flex-col gap-5 pl-5 pt-10 font-medium text-secondary">
        <li class="pt-1 flex items-center gap-2">
          <RouterLink to="/">HOME</RouterLink>
          <Icon name="material-symbols:line-end-arrow-notch-rounded" />
        </li>
        <li class="pt-1 flex items-center gap-2">
          <RouterLink to="/about">ABOUT</RouterLink>
          <Icon name="material-symbols:line-end-arrow-notch-rounded" />
        </li>
        <li class="pt-1 flex items-center gap-2">
          <RouterLink to="/price">PRICING</RouterLink>
          <Icon name="material-symbols:line-end-arrow-notch-rounded" />
        </li>
        <li class="pt-1 flex items-center gap-2">
          <RouterLink to="/service">SERVICES</RouterLink>
          <Icon name="material-symbols:line-end-arrow-notch-rounded" />
        </li>
        <li class="pt-1 flex items-center gap-2">
          <RouterLink to="/contact">CONTACT</RouterLink>
          <Icon name="material-symbols:line-end-arrow-notch-rounded" />
        </li>
      </ul>
    </div>
  </section>
</template>
