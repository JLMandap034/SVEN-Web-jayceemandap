<script setup>
import ScheduleForm from './ScheduleForm.vue';

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>

<template>
    <section id="appointment">
        <div class="block sm:grid grid-flow-col grid-cols-3">
            <div class="container bg-gray-500 text-white mx-auto text-center col-span-1 py-16 px-8 md:px-16">
                <a href="#" @click.prevent="scrollToTop">
                    <img src="https://placehold.co/600x400" alt="Pawtastic Logo" class="w-32 mx-auto mb-8">
                </a>
                <h1 class="text-4xl"><strong>All services include:</strong></h1>
                <ul class="list-disc text-2xl">
                    <li class="my-5">A photo update for you along</li>
                    <li class="mb-5">Notifications of sitter arrival</li>
                    <li class="mb-5">Treats for your pet, with your</li>
                </ul>
            </div>
            <div class="bg-red-50 col-span-2 py-16 px-8 md:px-16">
                <h2 class="text-4xl font-bold mb-6">We'll take your dog for a walk. Just tell us when!</h2>
                <ScheduleForm />
            </div>
        </div>
    </section>
</template>