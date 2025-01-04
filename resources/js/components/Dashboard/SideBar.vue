<script setup>

</script>

<template>
    <div>
        <div>
            <ul class="flex flex-col">
                <li>
                    <RouterLink to="/admin/dashboard" class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10 ">
                        <Icon name="ic:twotone-dashboard-customize" size="20" class="text-primary" />
                        <p class="font-normal text-sm">Dashboard</p>
                    </RouterLink>
                </li>
				<li>
                    <RouterLink to="/admin/service-category" class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10 ">
                        <Icon name="carbon:ibm-data-product-exchange" size="20" class="text-primary" />
                        <p class="font-normal text-sm">Service Category</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink to="/admin/service" class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10 ">
                        <Icon name="carbon:ibm-data-product-exchange" size="20" class="text-primary" />
                        <p class="font-normal text-sm">Services</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink to="/admin/package" class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10 ">
						<Icon name="carbon:ibm-data-product-exchange" size="20" class="text-primary" />
                        <p class="font-normal text-sm">Package</p>
                    </RouterLink>
                </li>
                <li>
                    <RouterLink  to="/admin/setting" class="flex items-center gap-2 px-3 py-2 hover:bg-primary/10 ">
                        <Icon name="material-symbols:settings-outline-rounded" size="20" class="text-primary" />
                        <p class="font-normal text-sm">Setting</p>
                    </RouterLink>
                </li>
            </ul>
        </div>
    </div>
</template>
