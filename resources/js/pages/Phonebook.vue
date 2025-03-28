<script setup lang="ts">
import { ref } from 'vue';
import SearchForm from '@/Components/SearchForm.vue';
import ContactForm from '@/Components/ContactForm.vue';
import ContactsTable from '@/Components/ContactsTable.vue';

const props = defineProps({
    contacts: Object,
    query: String
});
</script>

<template>
    <Head title="Phonebook">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 text-gray-900 dark:text-gray-100">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8">Phone Book</h1>

        <SearchForm :query="query" />
        <ContactForm />
        <ContactsTable :contacts="contacts" :search-query="query" />
    </div>
</template>
