<script setup>
    import Header from '@/components/Header.vue'
    import Footer from '@/components/Footer.vue'
    import MobileNav from '@/components/MobileNav.vue'
</script>
<template>
    <MobileNav />
    <Header />
      <slot />
    <Footer />
</template>

