<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue'

const { datatable, reatchedMaxLinks } = defineProps(['datatable', 'reatchedMaxLinks'])

</script>

<template>
    <div class="bg-white rounded-md shadow overflow-hidden">
        <Head title="Suivi des visites de lien" />
        <VCardHeader color="primary" title="Suivi des visites de lien" :showCloseModal="true" />

        
    </div>
</template>
