<script setup>
const scrollTo = (target) => {
    const element = document.querySelector(target);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
};
</script>

<template>
    <section id="about" class="py-16 px-8 md:px-16">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="text-left">
                <h1 class="text-5xl font-bold mb-5">Expert care for your furry, feathery, or scaley friend</h1>
                <p class="text-3xl text-gray-700 mt-5">We know how stressful it is to leave your pets at home alone. We're a team of experienced animal caregivers, well connected to local veterinarians. Trust to us to love them like our own, and to keep them safe and happy till you're home.
                </p>
                <button class="text-white bg-gray-600 hover:bg-gray-700 px-6 py-3 rounded-full mt-5" @click="scrollTo('#appointment')">Schedule a visit</button>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <img src="https://placehold.co/400x400" alt="Pet 1" class="rounded-lg">
                <img src="https://placehold.co/400x400" alt="Pet 2" class="rounded-lg">
                <img src="https://placehold.co/400x400" alt="Pet 3" class="rounded-lg">
                <img src="https://placehold.co/400x400" alt="Pet 4" class="rounded-lg">
            </div>
        </div>
    </section>
</template>