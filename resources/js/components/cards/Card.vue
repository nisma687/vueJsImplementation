<template>
    <div class="bg-blue-200 rounded ">
        <div class="p-5 bg-slate-200 w-1/4 ">
        
        <div class="flex gap-6 items-center  ">
           <img 
           src="https://img.icons8.com/emoji/48/woman-student.png"
              alt="Desk"
           :src="imgSrc" :alt=" imgAlt " class="w-20 h-20 rounded-lg">
            <p class="font-normal  text-2xl ml-3 
            text-gray-700 dark:text-gray-400">
            {{ description || 'No description'}} 
        </p>
        </div>
      </div>
    </div>
    
</template>
  <script setup>
  import { FwbCard } from 'flowbite-vue'
  
  const props = defineProps({
    imgAlt: String,
    imgSrc: String,
    variant: String,
    description: String,
    
  })
  </script>
  