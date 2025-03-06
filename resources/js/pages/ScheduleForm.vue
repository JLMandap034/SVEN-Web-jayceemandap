<script setup>
import { useForm } from '@inertiajs/vue3';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { ref, reactive, computed } from 'vue';
import axios from 'axios';

const form = useForm({
    frequency: 'Recurring',
    start_date: '',
    days: [],
    times: [],
    notes: '',
});

const errors = reactive({});

const days = ref([
    { label: 'Mon', value: 'mon' },
    { label: 'Tue', value: 'tue' },
    { label: 'Wed', value: 'wed' },
    { label: 'Thu', value: 'thu' },
    { label: 'Fri', value: 'fri' },
    { label: 'Sat', value: 'sat' },
    { label: 'Sun', value: 'sun' },
]);

const times = ref([
    { label: 'Morning', value: 'morning' },
    { label: 'Afternoon', value: 'afternoon' },
    { label: 'Evening', value: 'evening' },
]);

const toggleDay = (day) => {
    if (form.days.includes(day)) {
        form.days = form.days.filter((d) => d !== day);
    } else {
        form.days.push(day);
    }
};

const toggleTime = (time) => {
    if (form.times.includes(time)) {
        form.times = form.times.filter((t) => t !== time);
    } else {
        form.times.push(time);
    }
};

// Get today's date in YYYY-MM-DD format
const today = computed(() => {
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    const day = now.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
});


const scheduleService = () => {
    axios.post('/schedule', form)
    .then(response => { // Handle success response
        alert(response.data.message);
        form.frequency = 'Recurring';
        form.start_date = '';
        form.days = [];
        form.times = [];
        form.notes = '';

        errors.start_date = '';
        errors.days = '';
        errors.times = '';
    })
    .catch(err => { // Handle error response
        alert("Something went wrong.");
        errors.start_date = err.response.data.errors.start_date[0];
        errors.days = err.response.data.errors.days[0];
        errors.times = err.response.data.errors.times[0];
    });
};
</script>

<template>
    <div>
        <div class="grid grid-cols-2 gap-6">
            <div class="mb-4">
                <Label
                    for="frequency"
                    class="block text-sm font-medium text-gray-700"
                >
                    Frequency <span class="text-red-500">*</span>
                </Label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <Button
                        type="button"
                        class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-gray-500 focus:border-gray-500"
                        :class="{ 'bg-red-200 hover:bg-red-200': form.frequency === 'Recurring' }"
                        @click="form.frequency = 'Recurring'"
                    >
                        Recurring
                    </Button>
                    <Button
                        type="button"
                        class="-ml-px relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-gray-500 focus:border-gray-500"
                        :class="{ 'bg-red-200 hover:bg-red-200': form.frequency === 'One Time' }"
                        @click="form.frequency = 'One Time'"
                    >
                        One time
                    </Button>
                </div>
            </div>

            <div class="mb-4">
                <Label
                    for="start_date"
                    class="block
                    text-sm font-medium text-gray-700"
                >
                    Start date <span class="text-red-500">*</span>
                </Label>
                <Input
                    id="start_date"
                    type="date"
                    v-model="form.start_date"
                    :min="today"
                />
                <div v-if="errors.start_date" class="text-red-500 text-sm mt-1">{{ errors.start_date }}</div>
            </div>
        </div>

        <div class="mb-4">
            <Label
                class="block text-sm font-medium text-gray-700"
            >
                Days - Select all that apply <span class="text-red-500">*</span>
            </Label>
            <div class="mt-2 grid grid-cols-7 gap-2">
                <Button
                    v-for="day in days"
                    :key="day.value"
                    class="px-3 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    :class="{ 'bg-red-200 hover:bg-gray-500': form.days.includes(day.value) }"
                    type="button"
                    @click="toggleDay(day.value)"
                >
                    {{ day.label }}
                </Button>
            </div>
            <div v-if="errors.days" class="text-red-500 text-sm mt-1">{{ errors.days }}</div>
        </div>

        <div class="mb-4">
            <Label
                class="block text-sm font-medium text-gray-700"
            >
                Times - Select all that apply <span class="text-red-500">*</span>
            </Label>
            <div class="mt-2 grid grid-cols-3 gap-2">
                <Button
                    v-for="time in times"
                    :key="time.value"
                    type="button"
                    class="px-3 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    :class="{ 'bg-red-200 hover:bg-gray-500': form.times.includes(time.value) }"
                    @click="toggleTime(time.value)"
                >
                    {{ time.label }}
                </Button>
            </div>
            <div v-if="errors.times" class="text-red-500 text-sm mt-1">{{ errors.times }}</div>
        </div>

        <div class="mb-4">
            <Label
                for="notes"
                class="block text-sm font-medium text-gray-700"
            >
                Notes for your sitter
            </Label>
            <textarea
                id="notes"
                v-model="form.notes"
                rows="3"
                class="px-3 py-2 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                placeholder="Food preferences, leash location, treats given, etc."
            ></textarea>
        </div>

        <div class="mb-4 text-center">
            <Button
                type="button"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                @click="scheduleService"
            >
                Schedule Service
            </Button>
        </div>
    </div>
</template>