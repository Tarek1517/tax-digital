<template>
    <section class="py-6 lg:py-12">
        <Container>
            <!-- Left Side -->
            <div class="flex flex-wrap items-center justify-between">
                <div class="w-full lg:w-1/2">
                    <h1 class="text-4xl lg:text-7xl font-bold mb-6">
                        Company Accounts and Tax Filing
                    </h1>
                    <p class="text-xl lg:text-2xl font-medium mb-6">
                        One-off charge
                        <span class="text-xl lg:text-2xl font-bold">£399</span>
                        + vat
                    </p>
                    <button
                        class="bg-secondary text-base lg:text-xl uppercase text-white py-1 lg:py-3 px-8 lg:px-20 rounded-full hover:bg-primary transition-all ease-in-out duration-300"
                    >
                        Buy Now
                    </button>
                    <p class="mt-6 text-sm lg:text-lg text-gray-600">
                        We are a team of experts passionate about helping small
                        businesses comply with their company accounts and tax
                        filing duties online, by following a few quick and
                        paperless steps.
                    </p>
                </div>

                <!-- Right Side (Styled Image) -->
                <div class="w-full lg:w-1/2">
                    <div
                        class="h-full w-full rounded-lg"
                    >
                        <img
                            class="h-full w-full object-cover"
                            src="@/assets/images/bg-hero.png"
                            alt="Styled Image"
                        />
                    </div>
                </div>
            </div>
        </Container>
    </section>
</template>

<script>
import Container from "@/components/Container.vue";

export default {
    components: { Container },
};
</script>

<style></style>
