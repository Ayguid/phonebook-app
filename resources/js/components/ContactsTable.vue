<script setup lang="ts">
import { router } from '@inertiajs/vue3';

const props = defineProps({
    contacts: Object,
    searchQuery: String
});

const deleteContact = (contact) => {
    if (confirm('Are you sure you want to delete this contact?')) {
        router.delete(`/contacts/${contact.id}`);
    }
};

const changePage = (page) => {
    if (props.searchQuery) {
        router.get('/search', { 
            query: props.searchQuery,
            page: page 
        });
    } else {
        router.get('/', { page: page });
    }
};
</script>

<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <h2 class="text-lg sm:text-xl font-semibold p-4 sm:p-6 border-b border-gray-200 dark:border-gray-700">Contacts</h2>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            <div
                v-for="contact in contacts.data"
                :key="contact.id"
                class="p-4 sm:p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 sm:gap-0"
            >
                <div>
                    <h3 class="font-medium">{{ contact.name }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ contact.phone_number }}</p>
                </div>
                <button
                    @click="deleteContact(contact)"
                    class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                >
                    Delete
                </button>
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-4 sm:px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    Showing {{ contacts.from }} to {{ contacts.to }} of {{ contacts.total }} results
                </div>
                <div class="flex flex-wrap gap-2 justify-center">
                    <button
                        v-for="page in contacts.last_page"
                        :key="page"
                        @click="changePage(page)"
                        :class="[
                            'px-3 py-1 rounded-lg text-sm',
                            page === contacts.current_page
                                ? 'bg-blue-500 text-white'
                                : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600'
                        ]"
                    >
                        {{ page }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template> 