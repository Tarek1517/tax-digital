<script setup>
import SideBar from '@/components/Dashboard/SideBar.vue';
import Header from '@/components/Dashboard/AdminHeader.vue';
</script>
<template>
    <div class="bg-gray-50 w-full flex">
        <aside class="w-44 fixed top-0 left-0 bottom-0 h-screen bg-white shadow">
            <SideBar/>
        </aside>
		<main class="ml-44 w-full min-h-screen p-4 pt-14">
			<Header/>
			<div class="pb-1 mt-[2px]">
				<slot/>
			</div>
		</main>
    </div>
</template>
