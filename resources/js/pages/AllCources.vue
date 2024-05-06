<template>
    <div>
        <h1 class="text-2xl text-center">This is All Courses Page</h1>
    </div>
  <div class="m-5 p-2 grid lg:grid-cols-3 lg:gap-5 md:grid-cols-2 gap-2">
    <div
     v-for="course in courses"
    
      :key="course.id">
     <fwb-card
     img-alt="Desk"
        v-if="course.image"
        :img-src="course.image"
        variant="image"
    >
      <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{course.name}}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
            {{course.description}}
        </p>
        <p>
           <span class="font-semibold">Course Type:</span> {{ course.type }}
        </p>
        <div class="mt-4">
            <span class="text-xl font-bold text-gray-900 dark:text-white">
                ${{course.price}}
            </span>
        </div>
        <!-- <div>{{ course.id }}</div> -->
        <div class="mt-4 items-center">
            <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            @click="handleAddToCart(course.id)"
            >
                Enroll Course
        </button>
    
       </div>
        
      </div>
      
     
    </fwb-card>
    
    </div>
  </div>
  
    
  
</template>
<script setup>
import { ref, onMounted } from 'vue';
import axiosInstance from '@/axios/axios.js';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';
const router = useRouter();
import { FwbCard } from 'flowbite-vue';
const courses = ref([]);
const isLoggedIn=()=>{
    if(localStorage.getItem('token')){
        return true;
    }
    return false;
}
const StudentId=JSON.parse(localStorage.getItem('user'));
console.log(StudentId.id);
const handleAddToCart = async (courseId) => {
    if (!isLoggedIn()) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please log in to add the course to cart!',
        });
        router.push({ name: 'Login' });
    }
    try {
        const response = await axiosInstance.post('student-courses', {
            course_id: courseId,
            student_id: StudentId.id,
           
        });
        console.log(response.data);
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Course added to cart successfully!',
        });
    } catch (error) {
        console.error(error);
    }
}
const handleUpdate = (courseId) => {
    if (!isLoggedIn()) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please log in to update the course!',
        });
        router.push({ name: 'Login' });
    }
}
const dataRetrive= async()=>{
    try {
        const response = await axiosInstance.get('courses');
        console.log(response.data.courses);
        courses.value = response.data.courses.filter(course => !course.deleted_at)
        
    } catch (error) {
        console.error(error);
    }

}
onMounted(()=>{
    dataRetrive();
});



</script>