<template>
    <div class="bg-gray-100 min-h-screen h-fit flex ">
        <Sidebar />
        <div class="flex-1">
            
            <div class="p-5">
                <RouterView />
            </div>
        </div>
    </div>

</template>
<script setup>
import Sidebar from '@/components/Sidebar/Sidebar.vue';
import Navbar from '@/components/Navbar/Navbar.vue';
</script>