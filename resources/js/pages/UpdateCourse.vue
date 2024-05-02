<template>
    <div class="container mx-auto ">
       
            <div class="m-3 p-4  border-2 items-center justify-center ">
                <form @submit.prevent="updateData()">
                    <h1 class="text-2xl text-center">Update Course</h1>
                    <div v-if="showError" 
                    class="bg-red-100
                     border-l-4 mb-3
                      border-red-500
                       text-red-700 p-4 mt-4" role="alert">
                        <p>
                            <span class="font-bold">Error</span>
                        <span>There was an error updating the course. Please try again.</span>
                        </p>
                        <p>{{ showError }}</p>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Course Name</label>
                        <input type="text" id="name" v-model="course.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Course Description</label>
                        <textarea id="description" v-model="course.description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Course Price</label>
                        <input type="number" id="price" v-model="course.price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Course Type</label>
                        <select id="type" v-model="course.type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="cse">CSE</option>
                            <option value="business"> Business </option>
                            <option value="marketing">Marketing</option>
                            <option value="seo">SEO</option>
                            <option value="design">Design</option>
                            <option value="english">English</option>
                            <option value="math">Math</option>
                            <option value="grammar">Grammar</option>
                            <option value="hr">Hr</option>
                            <option value="accounting">Accounting</option>
                            <option value="Science">Science</option>


                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Course Image</label>
                        <input type="file" 
                        id="image" 
                        ref="image"
                        @change="handleImageChange"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div>
                        <img v-if="previewImage" :src="previewImage" class="w-1/4 h-2/4 mx-auto" alt="Course Image">
                        <img v-else-if="course && course.image" :src="course.image" class="w-1/4 h-2/4 mx-auto mt-2 mb-5" alt="Course Image">

                    </div>
                    <div class="mb-4 text-center">
                        <button class="bg-blue-500
                        
                         hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Update Course</button>
                    </div>
                </form>
                
            </div>
        
    </div>


</template>
<script setup>
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import Swal from 'sweetalert2';
import axiosInstance from '@/axios/axios.js'
const route = useRoute();
const showError = ref(false);
const courseId =route.params.id;
const course = ref({});
const previewImage = ref('');
console.log(courseId);
const form = ref({
    name: '',
    description: '',
    price: '',
    type: '',
    image: ''
});

const handleImageChange = (e) => {
    form.value.image = e.target.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(form.value.image);

    reader.onload = (e) => {
        previewImage.value = e.target.result;
    };
}
const dataSHow= async()=>{
    try {
        const response = await axiosInstance.get(`courses/${courseId}`);
        console.log(response.data.course);
        course.value = response.data.course;
        
    } catch (error) {
        console.error(error);
    }
}
onMounted(()=>{
    dataSHow();
});
const updateData = async () => {
    try {
        const formData = new FormData();
        const token = localStorage.getItem('token');
        formData.append('name', course.value.name);
        formData.append('description', course.value.description);
        formData.append('price', course.value.price);
        formData.append('type', course.value.type);
        if (form.value.image) { 
            formData.append('image', form.value.image); 
        }

        const response = await axiosInstance.post(`courses/update-course/${courseId}`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data', 
                'Authorization': `Bearer ${token}`
            }
        });

        console.log(response.data);
        if(response.data) {
            showError.value = false;
            Swal.fire({
                title: 'Course Updated',
                text: 'Course has been updated successfully',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }
    } catch (error) {
        console.error(error);
        showError.value = error.response.data.message;
    }
}



</script>