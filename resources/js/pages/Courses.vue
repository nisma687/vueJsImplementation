<template>
    <div class="mt-2 text-center text-xl mb-5">
        This is all courses table for admin
    </div>
    <div class="mx-auto mt-2 ">
        <fwb-table hoverable>
      <fwb-table-head>
        <fwb-table-head-cell>Id</fwb-table-head-cell>
        <fwb-table-head-cell>Name</fwb-table-head-cell>
        <fwb-table-head-cell>Description</fwb-table-head-cell>
        <fwb-table-head-cell>Price</fwb-table-head-cell>
        <fwb-table-head-cell>Type</fwb-table-head-cell>
        <fwb-table-head-cell>Image</fwb-table-head-cell>
        <fwb-table-head-cell>Delete</fwb-table-head-cell>
        <fwb-table-head-cell>
          Edit
        </fwb-table-head-cell>
        <fwb-table-head-cell>
          Restore
        </fwb-table-head-cell>
      </fwb-table-head>

      <fwb-table-body>
        <fwb-table-row 
        v-for="course in courses" 
        :class="{ 'background-red': course.deleted_at }"
        :key="course.id">
          <fwb-table-cell>{{ course.id }}</fwb-table-cell>
          <fwb-table-cell>{{ course.name }}</fwb-table-cell>
          <fwb-table-cell>{{ course.description }}</fwb-table-cell>
          <fwb-table-cell>{{ course.price }} $</fwb-table-cell>
          <fwb-table-cell>{{ course.type }}</fwb-table-cell>
          <fwb-table-cell>
            <img :src="course.image" alt="course image" class="w-20 h-10 rounded-full" />
          </fwb-table-cell>
          <fwb-table-cell>
            <button @click="deleteCourse(course.id)"
            :disabled="course.deleted_at"
             class="text-red-500">Delete</button>
          </fwb-table-cell>
          <fwb-table-cell>
            
            <router-link 
            :to="{ name: 'UpdateCourse', params: { id: course.id } }"
             class="text-blue-700" >Edit</router-link>
          </fwb-table-cell>
          <fwb-table-cell>
            <!-- <router-link :to="{ name: 'edit-course', params: { id: course.id } }" class="text-blue-500">Edit</router-link> -->
            <button
            @click="restore(course.id)"
            :disabled="!course.deleted_at"
            class="text-pink-700" >Restore</button>
          </fwb-table-cell>

        </fwb-table-row>
       
        
      </fwb-table-body>
    </fwb-table>
    </div>
   
</template>
  
  <script setup>
  import Swal from 'sweetalert2';
  import {
    FwbA,
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
  } from 'flowbite-vue';
   
    
  import { useRouter } from 'vue-router';
import { ref } from 'vue';
import { onMounted } from 'vue';
import axiosInstance from '@/axios/axios.js';
const router = useRouter();
const courses = ref([]);


const dataRetrive= async()=>{
    try{
        const response = await axiosInstance.get('/courses');
        // console.log("ok");
        console.log(response.data.courses);
        courses.value = response.data.courses;
    }catch(err){
        console.log(err);
    }
}
onMounted(()=>{
    dataRetrive();

});
const restore =async(id)=>{
    try {
      //  console.log(id);
       const res= await axiosInstance.post(`courses/deleteAndRestore/${id}`);
        if(res){
          Swal.fire(
            'Restored!',
            'Your file has been restored.',
            'success'
          )
          dataRetrive();
        }
       
    } catch (error) {
        console.error(error);
    }
}

  const deleteCourse = async (id) => {
    try {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await axiosInstance.post(`courses/deleteAndRestore/${id}`);
                dataRetrive();
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
        
    }
     catch (err) {
        console.log(err);
    }
}
  </script>

  <style scoped>
  .background-red {
    background-color: #A52A2A !important;
    color: white !important;
  }
  </style>