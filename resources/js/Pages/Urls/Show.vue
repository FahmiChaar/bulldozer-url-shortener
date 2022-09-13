<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue'
import VCardHeader from '@/Components/VCardHeader.vue';

const { url, visits } = defineProps(['url', 'visits'])

</script>

<template>
    <div class="bg-white rounded-md shadow overflow-hidden">
        <Head :title="$t('tracking.title')" />
        <VCardHeader color="primary" :title="$t('tracking.title')" :showCloseModal="true" />
        <div class="py-2 px-4 text-sm">
            <span class="text-gray-400 mr-1">{{ $t('url.link') }}:</span>
            <a :href="url.link" class="text-blue-400 underline">{{ url.link }}</a>
        </div>
        <div class="py-2 px-4 text-sm">
            <span class="text-gray-400 mr-1">{{ $t('url.short') }}:</span>
            <a :href="url.shorten_link" class="text-blue-400 underline">{{ url.shorten_link }}</a>
        </div>
        <v-table class="shadow rounded-md">
            <thead>
                <tr>
                    <th>{{ $t('tracking.visited_at') }}</th>
                    <th>{{ $t('tracking.user') }}</th>
                    <th>{{ $t('tracking.ip') }}</th>
                    <th>{{ $t('tracking.country') }}</th>
                    <th>{{ $t('tracking.user_agent') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!visits || !visits.length" class="text-center text-gray-400">
                    <td colspan="5">
                        {{ $t('tracking.no_data') }}
                    </td>
                </tr>
                <tr v-for="visit in visits" :key="visit.id">
                    <td>{{ visit.formated_created_at }}</td>
                    <td>{{ (visit.user ? visit.user.name : '---') }}</td>
                    <td>{{ visit.ip }}</td>
                    <td>{{ visit.country }}</td>
                    <td>{{ visit.user_agent }}</td>
                </tr>
            </tbody>
        </v-table>

    </div>
</template>
