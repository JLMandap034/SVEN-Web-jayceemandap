<script setup>
const scrollTo = (target) => {
    const element = document.querySelector(target);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
};
</script>

<template>
    <section class="relative h-screen bg-cover bg-center text-white" style="background-image: url('https://placehold.co/1878x966')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 w-full">
            <div class="container mx-auto px-4 flex justify-between items-start pt-4"> 
                <img src="https://placehold.co/600x400" alt="Pawtastic Logo" class="w-24"> 
                <div class="space-x-4">
                    <button class="text-sm hover:underline" @click="scrollTo('#about')">About Us</button> 
                    <button class="text-sm hover:underline" @click="scrollTo('#appointment')">Schedule a visit</button> 
                </div>
            </div>
            <div class="mx-auto px-4 mt-16 md:mt-32"> 
                <div class="sm:absolute max-w-xl right-10"> 
                    <h1 class="text-7xl font-bold mb-4">We care for your furry little loved ones while</h1> 
                    <button class="bg-gray-600 hover:bg-gray-700 px-6 py-3 rounded-full text-sm" @click="scrollTo('#appointment')">Schedule a visit</button> 
                </div>
            </div>
        </div>
    </section>
</template>

