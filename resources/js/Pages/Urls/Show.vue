<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue'
import VCardHeader from '@/Components/VCardHeader.vue';

const { url, visits } = defineProps(['url', 'visits'])

</script>

<template>
    <div class="bg-white rounded-md shadow overflow-hidden">
        <Head title="Suivi des visites de lien" />
        <VCardHeader color="primary" title="Suivi des visites de lien" :showCloseModal="true" />
        <div class="py-2 px-4 text-sm">
            <span class="text-gray-400 mr-1">Lien:</span>
            <a :href="url.link" class="text-blue-400 underline">{{ url.link }}</a>
        </div>
        <v-table class="shadow rounded-md">
            <thead>
                <tr>
                    <th>Visitée le</th>
                    <th>Utilisateur</th>
                    <th>Adresse IP</th>
                    <th>Pays</th>
                    <th>User Agent</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!visits || !visits.length" class="text-center text-gray-400">
                    <td colspan="5">
                        Lien pas encore visité
                    </td>
                </tr>
                <tr v-for="visit in visits" :key="visit.id">
                    <td>{{ visit.created_at }}</td>
                    <td>{{ (visit.user ? visit.user.name : '---') }}</td>
                    <td>{{ visit.ip }}</td>
                    <td>{{ visit.country }}</td>
                    <td>{{ visit.user_agent }}</td>
                </tr>
            </tbody>
        </v-table>

    </div>
</template>
