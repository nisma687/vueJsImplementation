<template>
    <div class="text-xl text-center mt-5 p-2">
        <div v-if="user">
            <h2><span class="mr-2 text-blue-800">Name:</span>{{ user.name }}</h2>
            <p><span class="mr-2 mb-2 text-blue-800">Email:</span> {{ user.email }}</p>
            <!-- Display profile picture if available -->
            <img v-if="user.profile_picture"
            class="w-1/4 h-2/4 mx-auto mt-2 mb-5"
             :src="user.profile_picture" alt="Profile Picture">
            <!-- Add more user details as needed -->
            <div>
                <router-link to="edit-profile" class="bg-blue-500 hover:bg-blue-700 text-white button
                font-bold py-1 px-2 rounded mt-2">
                    Edit Profile
                </router-link>
            </div>
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
