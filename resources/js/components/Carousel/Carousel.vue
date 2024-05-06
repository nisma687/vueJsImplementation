<template>
    <fwb-carousel :pictures="pictures" slide :slide-interval="1000"/>
  </template>
  
  <script setup>
  
  import { FwbCarousel } from 'flowbite-vue'
  
  const pictures = [
    {src: 'https://flowbite.com/docs/images/blog/image-1.jpg', alt: 'Image 1'},
    {src: 'https://flowbite.com/docs/images/blog/image-1.jpg', alt: 'Image 2'},
    {src: 'https://flowbite.com/docs/images/blog/image-1.jpg', alt: 'Image 3'},
  ]
  </script>