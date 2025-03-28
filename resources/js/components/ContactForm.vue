<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const newContact = ref({
    name: '',
    phone_number: ''
});

const addContact = () => {
    router.post('/contacts', newContact.value, {
        onSuccess: () => {
            newContact.value = { name: '', phone_number: '' };
        }
    });
};
</script>

<template>
    <div class="mb-6 sm:mb-8 bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow">
        <h2 class="text-lg sm:text-xl font-semibold mb-4">Add New Contact</h2>
        <form @submit.prevent="addContact" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input
                    v-model="newContact.name"
                    type="text"
                    required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                <input
                    v-model="newContact.phone_number"
                    type="tel"
                    required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                />
            </div>
            <button
                type="submit"
                class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
            >
                Add Contact
            </button>
        </form>
    </div>
</template> 