<template>
    <div class="bg-blue-900 text-white p-20 ">
        <div class="text-2xl my-5">Side bar</div>
        <div class="mb-2">
        <router-link to="/">Home</router-link> 
        </div>
        <!-- <div class="mb-2">
        <router-link >About</router-link>
        </div> -->
        <div class="mb-2">
        <router-link to="/dashboard/profile">Profile</router-link>
        </div>
        <div class="mb-2">
        <router-link to="/dashboard/courses">Courses</router-link>
        </div>
        <div class="mb-2">
        <router-link to="/dashboard/cart">
            Enrolled Courses
        </router-link>
        </div>
        <!-- <div class="mb-2">
        <router-link >Settings</router-link>
        </div> -->

        
    </div>
   

</template>
<script setup>
</script>