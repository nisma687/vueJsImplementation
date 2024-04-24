<template>
    <div>
        <div class="text-2xl text-center font-semibold text-purple-500 italic ">Welcome to the Home Page</div>
        <!-- <div>
            <CustomButton
                :bgText="buttonText"
                bgColor="bg-[#4CAF50]"
                @buttonClick="handleButtonClick"
            />
        </div> -->
        
    </div>
    <div class="m-5 grid grid-cols-3 gap-2 ">
        <!-- v-for="index in 4"
      :key="index" for loop --> 
    <Card
      
      description="43 students"
      imgSrc="https://img.icons8.com/emoji/48/woman-student.png"
      imgAlt="student"
      variant="image"
    />
    <Card
    
      description="10 teachers"
      imgSrc="https://img.icons8.com/color-glass/96/teacher.png"
      imgAlt="teacher"
      variant="image"
    />
    

    </div>
    <div>
        <p class="text-xl text-center mt-2 mb-2">
            let's look at the bar-chart for the last 4 months
        </p>
    </div>
    <div class="m-2 p-5">
        <BarChart/>
    </div>
</template>

<script setup>
import CustomButton from '@/components/buttons/CustomButton.vue';
import { ref } from 'vue';
import Card from '../components/cards/Card.vue';
import BarChart from '../components/carts/BarChart.vue';

const cardTitle = ref('');
const cardDescription = ref('');
const cardImage = ref('');
const buttonText = ref('delete');

const fetchData = () => {
    console.log('fetched data');
}

const handleButtonClick = () => {
    fetchData();
}
</script>
