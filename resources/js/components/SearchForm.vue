<script setup lang="ts">
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    query: String
});

const searchQuery = ref(props.query || '');

const searchContacts = () => {
    router.get('/search', { 
        query: searchQuery.value,
        page: 1 // Reset to first page when searching
    });
};
</script>

<template>
    <div class="mb-6 sm:mb-8">
        <form @submit.prevent="searchContacts" class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Search by name or phone number..."
                class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
            />
            <button
                type="submit"
                class="w-full sm:w-auto px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
            >
                Search
            </button>
        </form>
    </div>
</template> 