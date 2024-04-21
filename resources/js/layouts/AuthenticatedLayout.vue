<template>
    <div>
        <div class="text-2xl">Top bar</div>
       
    </div>
    
    <!-- sidebar -->
    <div>
        <router-link to="/">Home</router-link>
        <router-link to="/about">About</router-link>
    </div>

    <RouterView />
</template>