<script setup>
import useAxios from "@/composables/useAxios.js";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const { loading, error, sendRequest } = useAxios();
const route = useRoute();

const page = ref(null);
const getPage = async () => {
    const response = await sendRequest({
        method: "get",
        url: `frontend/v1/get-custom-page/${route.params.slug}`,
    });
    if (response) {
        page.value = response.data;
    }
};

onMounted(() => {
    window.scrollTo(0, 0);
    getPage();
});
</script>
<template>
    <AppLayout>
        <section class="bg-primary/10 h-auto py-16">
            <Container>
                <div
                    class="w-full editor_data"
                    v-html="page?.data?.content"
                ></div>
            </Container>
        </section>
    </AppLayout>
</template>
