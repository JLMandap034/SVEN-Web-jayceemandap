<script setup>
import { Head } from '@inertiajs/vue3';
import Hero from './Hero.vue';
import AboutUs from './AboutUs.vue';
import AppointmentForm from './AppointmentForm.vue';
</script>

<template>
    <Head title="Home" />
    <div class="font-open-sans">
        <Hero />
        <AboutUs />
        <AppointmentForm />
    </div>
</template>