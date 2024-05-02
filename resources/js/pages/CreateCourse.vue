<template>
    
    <div class="mx-auto">
        <h2 class="mt-2 text-center text-xl">Create a course</h2>
        <form class="w-1/2 mx-auto" @submit.prevent="createCourse">
            <div class="mb-3 pt-0 text-center">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="name">Course Name:</label>
                <input type="text" placeholder="Course Name"
                       id="name"
                       v-model="form.name"
                       :class="{ 'border-red-500': showErrorName }"
                       class="px-2 py-2 placeholder-blueGray-300 text-blueGray-600 relative 
                        bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/> 
                <div v-if="showErrorName" class="text-red-600 text-sm mt-1">Course Name is required</div>
            </div>
            <div class="mb-3 pt-0 text-center">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="description">Description:</label>
                <textarea 
                       id="description"
                       v-model="form.description"
                       :class="{ 'border-red-500': showErrorDescription }"
                       placeholder="Description" 
                       class="p-10  placeholder-blueGray-300 text-blueGray-600 relative 
                        bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-2/4 required"/> 
                <div v-if="showErrorDescription" class="text-red-600 text-sm mt-1">Description is required</div>
            </div>
            <div class="mb-3 pt-0 text-center">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="price">Price:</label>
                <input type="text" 
                       id="price"
                       v-model="form.price"
                       :class="{ 'border-red-500': showErrorPrice }"
                       placeholder="Price" 
                       class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative 
                        bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/> 
                <div v-if="showErrorPrice" class="text-red-600 text-sm mt-1">Price
                    is required</div>


            </div>
            <div class="mb-3 pt-0 text-center">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="course-picture">Course Picture:</label>
                <input type="file" 
                       id="course-picture" 
                       ref="coursePicture" 
                       class="w-1/2" 
                       @change="handleFileChange"
                       accept="image/*">
            </div>
            <div class="mb-3 pt-0 text-center mx-auto">
                <img v-if="previewImage" 
                :src="previewImage" class="w-1/4 h-2/4 mx-auto" alt="Course Picture">
            </div>
            <div class="mb-3 pt-0 text-center">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="type">Type:</label>
                <input type="text" 
                       id="type"
                       v-model="form.type"
                       :class="{ 'border-red-500': showType }"
                       placeholder="Type" 
                       class="px-2 py-1 placeholder-blueGray-300 text-blueGray-600 relative 
                        bg-white rounded text-sm border border-blueGray-300 outline-none focus:outline-none focus:ring w-1/2 required"/> 
                <div v-if="showType" class="text-red-600 text-sm mt-1">
                    Type is required
                </div>
            </div>
            <div class="mb-2 pt-0 text-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Course
                </button>
            </div>
    </form>
    </div>
    
    
</template>

<script setup>
import { FwbCard } from 'flowbite-vue'
import { ref } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import { useRouter } from 'vue-router';
const apiBaseUrl='http://127.0.0.1:8000';
const form = ref({
    name: '',
    description: '',
    price: '',
    image: null,
    type: ''
});
const showErrorName = ref(false);
const showErrorDescription = ref(false);
const showErrorPrice = ref(false);
const showType = ref(false);
const previewImage = ref(''); 
const router = useRouter();
const handleFileChange = (event) => {
    form.value.image = event.target.files[0];
    const reader = new FileReader();
    reader.onload = () => {
        previewImage.value = reader.result;
    };
    reader.readAsDataURL(form.value.image);
};

const createCourse = async () => {
    
    if (!form.value.name) {
        showErrorName.value = true;
        return;
    }
    if (!form.value.description) {
        showErrorDescription.value = true;
        return;
    }
    if (!form.value.price) {
        showErrorPrice.value = true;
        return;
    }
    if (!form.value.type) {
        showType.value = true;
        return;
    }
    try {
        const formData = new FormData();
        for (const key in form.value) {
            formData.append(key, form.value[key]);
        }
       // console.log('Form data:', formData);
        const token = localStorage.getItem('token');
        const response = await axios.post(`${apiBaseUrl}/api/courses`, formData, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'multipart/form-data',
            },
        });
        console.log('Course created:', response.data);
        //router.push('/dashboard');
        if (response.data) {
            Swal.fire({
                title: 'Course created successfully',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
            });
            form.value.name = '';
            form.value.description = '';
            form.value.price = '';
            form.value.image = null;
            form.value.type = '';
            previewImage.value = '';
            const fileInput = document.getElementById('course-picture');
            if (fileInput) {
            fileInput.value = null;
            }
        }
    } catch (error) {
        console.error(error);
    }
};


</script>