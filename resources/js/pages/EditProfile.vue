<template>
    <div class="text-xl text-center mt-5 p-2">
        <form @submit.prevent="editData()">
            <div class="mb-3 pt-0 text-center">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="name">Name:</label>
            <input type="text" placeholder="Enter your name"
                   v-model="form.name"
                   :class="{ 'border-red-500': showErrorName }"
                   class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative 
                    bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/> 
            <div v-if="showErrorName" class="text-red-600 text-sm mt-1">Name is required</div>
            <div class="mb-3 pt-0 text-center">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="email">Email:</label>
            <input type="email" 
                  
                   v-model="form.email"
                   :class="{ 'border-red-500': showErrorEmail }"
                   placeholder="Email" 
                   class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative 
                    bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/> 
            <div v-if="showErrorEmail" class="text-red-600 text-sm mt-1">Email is required</div>
            </div>
            <div class="mb-3 pt-0 text-center">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="profile-picture">Profile Picture:</label>
            <input type="file" 
                   id="profile-picture" 
                   ref="profilePicture" 
                   class="w-1/2" 
                     @change="handleFileChange"
                   accept="image/*">
                   
        </div>
        <div class="mb-3 pt-0 text-center mx-auto">
        <img v-if="previewImage" :src="previewImage" class="w-1/4 h-2/4 mx-auto" alt="Profile Picture">
        <img v-else-if="user && user.profile_picture" :src="user.profile_picture" class="w-1/4 h-2/4 mx-auto mt-2 mb-5" alt="Profile Picture">
        </div>

        <div class="mb-3 pt-0 text-center mx-auto">
           
            <button class="
            bg-blue-500 hover:bg-blue-200 text-white  
            p-1 rounded mt-4
            ">
                Save Changes
            </button>
        </div>
        
        </div>
        </form>
        
    </div>  
</template>
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
const apiBaseUrl='http://127.0.0.1:8000';
const user = ref(null);
const id=ref(null);
const previewImage = ref('');
const router = useRouter();
const handleFileChange = (event) => {
    form.value.profile_picture = event.target.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(form.value.profile_picture);

    reader.onload = (e) => {
        previewImage.value = e.target.result;
    };
}

const form = ref({
    name: '',
    email: '',
    password: '',
    profile_picture: ''
});
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
        form.value.name = user.value.name;
        form.value.email = user.value.email;
        form.value.profile_picture = user.value.profile_picture;
        id.value=user.value.id;

    } catch (error) {
        console.error('Error fetching user data:', error);
    }
    });
    const editData = async () => {
    const token = localStorage.getItem('token');

    // form.value.profile_picture check type of file if string or file
    form.value.profile_picture = form.value.profile_picture instanceof File ? form.value.profile_picture : null;

    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('email', form.value.email);
    if (form.value.profile_picture != null) {
        formData.append('profile_picture', form.value.profile_picture);

    }
    try {
        const response = await axios.post(`${apiBaseUrl}/api/users/update/${id.value}`, formData, {  
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'multipart/form-data',
            }
        });
        console.log('Edit profile response:', response.data);
        if (response.status) {
            router.push('/dashboard/profile');
        }
        // router.push('/profile');
    } catch (error) {
        console.error('Error editing profile:', error);
    }
}

</script>