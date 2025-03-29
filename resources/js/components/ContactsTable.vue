<script setup lang="ts">
import { useI18n } from 'vue-i18n';
import { router } from '@inertiajs/vue3';

const { t } = useI18n();

const props = defineProps({
    contacts: Object,
    searchQuery: String // Accept search query from parent
});

// Ensure pagination includes the search query
const changePage = (page: number) => {
    router.get('/', { 
        query: props.searchQuery, 
        page: page 
    }, {
        preserveState: true, 
        preserveScroll: true 
    });
};

const deleteContact = (contact) => {
    if (confirm('Are you sure you want to delete this contact?')) {
        router.delete(`/contacts/${contact.id}`);
    }
};
</script>

<template>
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow">
        <div v-if="contacts.data.length === 0" class="text-center py-4 text-gray-500 dark:text-gray-400">
            {{ $t('phonebook.no_contacts') }}
        </div>
        <div v-else class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ $t('phonebook.name') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ $t('phonebook.phone_number') }}
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ $t('phonebook.delete') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr v-for="contact in contacts.data" :key="contact.id">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ contact.name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ contact.phone_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <button
                                @click="deleteContact(contact)"
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                            >
                                {{ $t('phonebook.delete') }}
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 sm:px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    {{ $t('phonebook.pagination.showing') }} {{ contacts.from }} {{ $t('phonebook.pagination.to') }} {{ contacts.to }} {{ $t('phonebook.pagination.of') }} {{ contacts.total }} {{ $t('phonebook.pagination.results') }}
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
