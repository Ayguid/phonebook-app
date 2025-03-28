<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const newContact = ref({
    name: '',
    phone_number: ''
});

const isExpanded = ref(false);
const errors = ref({});

const addContact = () => {
    errors.value = {};
    router.post('/contacts', newContact.value, {
        onSuccess: () => {
            newContact.value = { name: '', phone_number: '' };
            isExpanded.value = false; // Collapse form after successful submission
        },
        onError: (validationErrors) => {
            errors.value = validationErrors;
        }
    });
};

const toggleForm = () => {
    isExpanded.value = !isExpanded.value;
    if (!isExpanded.value) {
        newContact.value = { name: '', phone_number: '' }; // Clear form when collapsing
        errors.value = {}; // Clear errors when collapsing
    }
};
</script>

<template>
    <div class="mb-6 sm:mb-8 bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow">
        <div class="flex justify-between items-center" :class="{ 'mb-4': isExpanded }">
            <h2 class="text-lg sm:text-xl font-semibold">Add New Contact</h2>
            <button
                @click="toggleForm"
                class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-500 text-white hover:bg-blue-600 transition-colors"
                :class="{ 'bg-red-500 hover:bg-red-600': isExpanded }"
            >
                {{ isExpanded ? '−' : '+' }}
            </button>
        </div>

        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <form v-if="isExpanded" @submit.prevent="addContact" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input
                        v-model="newContact.name"
                        type="text"
                        required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                        :class="{ 'border-red-500': errors.name }"
                    />
                    <p v-if="errors.name" class="mt-1 text-sm text-red-500">{{ errors.name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                    <input
                        v-model="newContact.phone_number"
                        type="tel"
                        required
                        class="mt-1 block w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                        :class="{ 'border-red-500': errors.phone_number }"
                    />
                    <p v-if="errors.phone_number" class="mt-1 text-sm text-red-500">{{ errors.phone_number }}</p>
                </div>
                <button
                    type="submit"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
                >
                    Add Contact
                </button>
            </form>
        </Transition>
    </div>
</template> 