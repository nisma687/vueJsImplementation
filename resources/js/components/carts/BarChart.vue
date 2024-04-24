<template>
    <Bar :data="chartData" />
  </template>
  
  <script>
  import { Bar } from 'vue-chartjs'
  import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
  
  ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
  
  export default {
    name: 'BarChart',
    components: { Bar },
    data() {
      return {
        chartData: {
          labels: [ 'January', 'February', 'March', 'April'],
          datasets: [
            {
              label: 'Student',
              backgroundColor: '#3e95cd',
              data: [30, 40, 25, 50]
            },
            {
                label: 'Faculty',
                backgroundColor: '#7C77B9',
                data: [10, 20, 22, 30]
            }


          ]
        }
      }
    }
  }
  </script>