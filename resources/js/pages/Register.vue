<template>
    <div class="text-2xl text-center">
        Join Us today
    </div>
    <div class="mt-2 mb-2 text-xl text-center">
        this is Sign Up Page
    </div>
    <div v-if="showSuccessMessage " class="text-green-600 text-center mt-4">
        Registration successful. Please login.
    </div>
    <div v-if="showErrorMessage " class="text-red-600 text-center mt-4">
        {{ errorMessage }}
    </div>
   <div class="p-5 m-5">
    <form @submit.prevent="validateAndRegister"> 
        <div class="mb-3 pt-0 text-center">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Name:</label>
            <input type="text" placeholder="Name"
                   v-model="name"
                   :class="{ 'border-red-500': showErrorName }"
                   class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative 
                    bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/> 
            <div v-if="showErrorName" class="text-red-600 text-sm mt-1">Name is required</div>
        </div>
        <div class="mb-3 pt-0 text-center">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Email:</label>
            <input type="email" 
                   v-model="email"
                   :class="{ 'border-red-500': showErrorEmail }"
                   placeholder="Email" 
                   class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative 
                    bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/> 
            <div v-if="showErrorEmail" class="text-red-600 text-sm mt-1">Email is required</div>
        </div>
        <div class="mb-3 pt-0 text-center">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Password:</label>
            <input v-model="password"
                   :class="{ 'border-red-500': showErrorPassword }"
                   type="password" 
                   placeholder="Password" 
                   class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative 
                    bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/>
            <div v-if="showErrorPassword" class="text-red-600 text-sm mt-1">Password is required</div>
        </div>
      
        <div class="mb-2 pt-0 text-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Sign Up
            </button>
        </div>
    </form>
   </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const name = ref('');
const email = ref('');
const password = ref('');
const showSuccessMessage = ref(false);
const showErrorMessage = ref(false);
const errorMessage = ref('');
const showErrorName = ref(false);
const showErrorEmail = ref(false);
const showErrorPassword = ref(false);

const validateAndRegister = async () => {
    showErrorName.value = !name.value;
    showErrorEmail.value = !email.value;
    showErrorPassword.value = !password.value;

    if (!name.value || !email.value || !password.value) {
        return; // If any field is empty, don't proceed
    }

    try {
        const response = await axios.post('/api/students', {
            name: name.value,
            email: email.value,
            password: password.value
        });
        console.log(response.data);
        showSuccessMessage.value = true;
        // Reset form fields
        name.value = '';
        email.value = '';
        password.value = '';
        showErrorMessage.value = false;
    } catch (error) {
        console.error(error);
        showSuccessMessage.value = false;
        showErrorMessage.value = true;
        errorMessage.value = error.response.data.message;
        
    }
}
</script>
