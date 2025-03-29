<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps({
    searchQuery: String, // Receive search query from parent
});

const emit = defineEmits(["search"]); // Emit search event

const query = ref(props.searchQuery || "");

// Emit search event on submit
const searchContacts = () => {
    if (query.value.trim() === props.searchQuery) return; // Avoid unnecessary requests
    emit("search", query.value.trim());
};
</script>

<template>
    <div class="mb-6 sm:mb-8">
        <form @submit.prevent="searchContacts" class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <input
                v-model="query"
                type="text"
                :placeholder="$t('phonebook.search_placeholder')"
                class="w-full px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
            />
            <button
                type="submit"
                class="w-full sm:w-auto px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center justify-center"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </button>
        </form>
    </div>
</template>
