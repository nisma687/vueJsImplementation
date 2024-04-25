<template>
    <div class="text-xl text-center mt-2">
        <div v-if="user">
            <h2>{{ user.name }}</h2>
            <p>Email: {{ user.email }}</p>
            <!-- Display profile picture if available -->
            <img v-if="user.profile_picture" :src="`${apiBaseUrl}/${user.profile_picture}`" alt="Profile Picture">
            <!-- Add more user details as needed -->
        </div>
        <div v-else>
            <p>Loading...</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const apiBaseUrl = 'http://127.0.0.1:8000'; // Base URL of your backend API

const user = ref(null);
const previewImage = ref('');
onMounted(async () => {
    try {
        const token = localStorage.getItem('token');
        const response = await axios.get(`${apiBaseUrl}/api/current-user`, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
        console.log('User data:', response.data);
        user.value = response.data;
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
});
</script>
