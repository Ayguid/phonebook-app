<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ContactForm from '@/Components/ContactForm.vue';
import ContactsTable from '@/Components/ContactsTable.vue';
import SearchForm from '@/Components/SearchForm.vue';
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
import ThemeSwitcher from '@/Components/ThemeSwitcher.vue';

const props = defineProps({
    contacts: Object,
    query: String // Get search query from Inertia response (if available)
});

const searchQuery = ref(props.query || '');

// Function to handle search and update the URL
const searchContacts = (query: string) => {
    searchQuery.value = query;
    router.get('/', { query }, { preserveState: true, preserveScroll: true });
};
</script>

<template>
    <Head :title="$t('phonebook.title')" />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 flex justify-between items-center">
                    <Link href="/" class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $t('phonebook.title') }}
                    </Link>
                    <div class="flex gap-4">
                        <ThemeSwitcher />
                        <LanguageSwitcher />
                    </div>
                </div>
            </div>

            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="">
                    <!-- Pass searchQuery and emit search event -->
                    <SearchForm :searchQuery="searchQuery" @search="searchContacts" />
                    <ContactForm />
                    <!-- Pass searchQuery to ContactsTable to persist filtering -->
                    <ContactsTable :contacts="contacts" :searchQuery="searchQuery" />
                </div>
            </div>
        </div>
    </div>
</template>
