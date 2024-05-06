<template>
    <div>
        <h1 class="text-2xl text-center mb-3">
            Enrolled Courses
        </h1>
        <h2 class=" text-center mb-3 mt-3 text-semibold text-purple-400">
            Welcome 
            <br>
            {{ user.name }} 
            <br>
            to your Enrolled Courses
        </h2>
    </div>
    <div class="mx-auto grid lg:grid-cols-2 grid-cols-1 gap-4">
        
    <fwb-card
        v-for="course in cart"
      img-alt="Desk"
        :img-src="course.course.image"
      variant="horizontal"
    >
      <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{course.course.name}}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
            {{course.course.description}}
        </p>
      </div>
        <div class="p-5">
            <p>
                <span class="font-semibold">Course Type:</span> {{ course.course.type }}
            </p>
            <div class="mt-4">
                <span class="text-blue-950">
                   Enrolled on: {{course.created_at}} 
                </span>
            </div>
        </div>
        <div class="p-5">
            <div class="mt-4 items-center">
                <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                
                >
                    View Course
            </button>
        
           </div>
        </div>
      
    </fwb-card>

</div>     
</template>
<script setup>
      import { FwbCard } from 'flowbite-vue'
  import { useRouter } from 'vue-router';
import { ref } from 'vue';
import { onMounted } from 'vue';
import axiosInstance from '@/axios/axios.js';
const router = useRouter();
const cart = ref([]);
const user=JSON.parse(localStorage.getItem('user'));
const id=user.id;
console.log(id);
const dataRetrive=async()=>{
    try{
        const response=await axiosInstance.get
        (`student-courses/getData/${id}`);
        cart.value=response.data.studentCourses;
        console.log(response.data.studentCourses);
        
    }catch(error){
        console.log(error);
    }
}
onMounted(()=>{
    dataRetrive();
});
</script>