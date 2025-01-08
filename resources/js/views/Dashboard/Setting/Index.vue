<script setup>
import { onMounted, ref } from "vue";
import SummernoteEditor from "vue3-summernote-editor";
import useAxios from "@/composables/useAxios";
import { toast } from "vue3-toastify";
import GuestLayout from "@/components/Dashboard/GuestLayout.vue";
import Modal from "@/components/Modal.vue";

const { loading, error, sendRequest } = useAxios();

const getAllSetting = async () => {
    const response = await sendRequest({
        method: "get",
        url: "/v1/setting",
    });
    setting.value.currency_symbol = response.data.currency_symbol;
    setting.value.email = response.data.email;
    setting.value.address = response.data.address;
    setting.value.phone_number = response.data.phone_number;
    setting.value.facebook_link = response.data.facebook_link;
    setting.value.instagram_link = response.data.instagram_link;
    setting.value.youtube_link = response.data.youtube_link;
    setting.value.linkedin_link = response.data.linkedin_link;
    setting.value.twitter_link = response.data.twitter_link;
};

// get Page
const pages = ref(null);
const getPage = async () => {
    const response = await sendRequest({
        method: "get",
        url: "/v1/all-page-list",
    });

    if (response) {
        pages.value = response.data?.data;
    }
};

const tabs = ["App", "Footer"];
const activeTab = ref(0);

const setting = ref({
    currency_symbol: null,
    email: null,
    address: null,
    phone_number: null,
    twitter_link: null,
    facebook_link: null,
    youtube_link: null,
    instagram_link: null,
    linkedin_link: null,
});

const onSubmit = async () => {
    const response = await sendRequest({
        method: "post",
        url: "/v1/setting",
        data: setting.value,
    });

    if (response) {
        toast.success("Setting saved Successfully", {
            autoClose: 500,
            theme: "dark",
        });
        getAllSetting();
    }
};

const footer_columns = ref(null);
const getFooter = async () => {
    const response = await sendRequest({
        method: "get",
        url: "/v1/footer",
    });

    if (response) {
        footer_columns.value = response.data;
    }
};

const form = ref({
    title: null,
    pages: null,
    content: null,
    width: null,
    order_number: null,
});

const resetForm = () => {
    title.value = null;
    pages.value = null;
    content.value = null;
    order_number.value = null;
};

const onFooterSubmit = async () => {
    const response = await sendRequest({
        method: "post",
        url: "/v1/footer",
        data: form.value,
    });
    if (response) {
        toast.success("Footer save successfully");
        getFooter();
        isModalOpened.value = false;
        resetForm();
    }
};

const onFooterDelete = async (id) => {
    const response = await sendRequest({
        method: "delete",
        url: `/v1/footer/${id}`,
    });
    if (response) {
        toast.success("Footer Column Deleted Successfully");
        getFooter();
    }
};

// model
const isModalOpened = ref(false);

const openModal = () => {
    isModalOpened.value = true;
};
const closeModal = () => {
    isModalOpened.value = false;
};

onMounted(() => {
    getAllSetting();
    getFooter();
    getPage();
});
</script>
<template>
    <GuestLayout>
        <section>
            <div class="p-4">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-2">
                        <Icon
                            name="material-symbols:settings-outline-rounded"
                            class="text-lg"
                        />
                        <h3 class="text-base font-medium">Setting</h3>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <div class="w-1/5">
                        <ul
                            class="border border-common rounded overflow-hidden"
                        >
                            <li v-for="(tab, index) in tabs" :key="index">
                                <button
                                    @click="activeTab = index"
                                    :class="[
                                        'px-4 py-2 w-full border-b border-primary/30 hover:bg-primary hover:text-white',
                                        activeTab === index
                                            ? 'bg-primary text-white'
                                            : 'text-black',
                                    ]"
                                >
                                    {{ tab }}
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="w-4/5">
                        <div class="w-full border border-common rounded p-2">
                            <div
                                class="w-full flex flex-wrap"
                                v-if="activeTab === 0"
                            >
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Phone Number</label
                                    >
                                    <input
                                        v-model="setting.phone_number"
                                        type="text"
                                        class="p-2 rounded-md w-full"
                                    />
                                </div>

                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Email</label
                                    >
                                    <input
                                        v-model="setting.email"
                                        type="text"
                                        class="p-2 rounded-md w-full"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Facebook</label
                                    >
                                    <input
                                        v-model="setting.facebook_link"
                                        type="text"
                                        class="p-2 rounded-md w-full"
                                    />
                                </div>

                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Instagram</label
                                    >
                                    <input
                                        v-model="setting.instagram_link"
                                        type="text"
                                        class="p-2 rounded-md w-full"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Linked In</label
                                    >
                                    <input
                                        v-model="setting.linkedin_link"
                                        type="text"
                                        class="p-2 rounded-md w-full"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Youtube</label
                                    >
                                    <input
                                        v-model="setting.youtube_link"
                                        type="text"
                                        class="p-2 rounded-md w-full"
                                    />
                                </div>
                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Twitter</label
                                    >
                                    <input
                                        v-model="setting.twitter_link"
                                        type="text"
                                        class="p-2 rounded-md w-full"
                                    />
                                </div>

                                <div class="w-1/2 px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Currency Symbol</label
                                    >
                                    <input
                                        type="text"
                                        class="p-2 rounded-md w-full"
                                        v-model="setting.currency_symbol"
                                    />
                                </div>

                                <div class="w-full px-2 mb-2">
                                    <label
                                        for="app-url"
                                        class="text-xs mb-1 block"
                                        >Address</label
                                    >
                                    <textarea
                                        v-model="setting.address"
                                        class="p-2 w-full focus:outline-none focus:ring-0 focus:border-common rounded ring-0 border border-common shadow-md shadow-common/50 transition-all ease-in-out duration-100"
                                    ></textarea>
                                </div>

                                <div class="w-full mt-5">
                                    <Button
                                        @click="onSubmit"
                                        class="w-full mx-auto bg-primary text-sm font-normal py-3 text-white"
                                        >Save Setting</Button
                                    >
                                </div>
                            </div>
                            <div class="w-full" v-if="activeTab === 1">
                                <div
                                    class="flex items-center justify-between mb-2"
                                >
                                    <h3>Footer</h3>
                                    <button
                                        class="text-xs bg-primary px-3 py-1.5 rounded text-white"
                                        @click="openModal"
                                    >
                                        Add New
                                    </button>
                                </div>
                                <div
                                    class="relative overflow-x-auto shadow-md sm:rounded-lg border-t-2 border-primary"
                                >
                                    <table
                                        class="w-full text-sm text-left rtl:text-right"
                                    >
                                        <thead
                                            class="text-xs uppercase bg-common"
                                        >
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3"
                                                >
                                                    Column Title
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3"
                                                >
                                                    Order Number
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-3"
                                                >
                                                    Action
                                                </th>
                                                {{}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="footer in footer_columns?.data"
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                            >
                                                <td class="px-6 py-4">
                                                    {{ footer.title }}
                                                </td>
                                                <th class="px-6 py-4">
                                                    {{ footer.order_number }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    <div
                                                        class="flex items-center gap-2"
                                                    >
                                                        <button
                                                            @click="
                                                                onFooterDelete(
                                                                    footer?.id
                                                                )
                                                            "
                                                            class="flex items-center gap-1 px-2 py-1 rounded border border-orange-600 bg-orange-500/10 text-orange-600 hover:bg-orange-600 hover:text-white"
                                                        >
                                                            <Icon
                                                                name="material-symbols:delete-outline"
                                                                class="text-lg"
                                                            />
                                                            <span
                                                                class="text-xs font-normal"
                                                                >Delete</span
                                                            >
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>

    <Modal
        title="Add New Footer Column"
        :isOpen="isModalOpened"
        @modal-close="closeModal"
    >
        <div class="flex flex-col gap-2">
            <div class="w-full">
                <label for="title" class="text-xs block mb-1"
                    >Column Title</label
                >
                <input
                    type="text"
                    class="p-2 rounded border w-full"
                    v-model="form.title"
                />
            </div>
            <div class="w-full">
                <label for="title" class="text-xs block mb-1"
                    >Column Pages</label
                >
                <Select
                    v-if="pages"
                    label="title"
                    :options="pages"
                    :reduce="(item) => item.id"
                    multiple
                    v-model="form.pages"
                >
                </Select>
            </div>
            <div class="full flex space-x-2">
                <div class="w-1/2">
                    <label for="title" class="text-xs block mb-1"
                        >Order Number</label
                    >
                    <input
                        type="text"
                        class="p-2 rounded border w-full"
                        v-model="form.order_number"
                    />
                </div>
            </div>
            <div class="w-full">
                <label for="title" class="text-xs block mb-1"
                    >Column Content</label
                >
                <div class="editor_data footer-content">
                    <SummernoteEditor v-model="form.content" />
                </div>
            </div>
            <div class="w-full mt-5">
                <Button
                    @click="onFooterSubmit"
                    class="w-full mx-auto bg-primary text-sm font-normal py-3 text-white"
                    >Save Footer Column</Button
                >
            </div>
        </div>
    </Modal>
</template>
