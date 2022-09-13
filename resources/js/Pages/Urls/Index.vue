<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import LaravelTable from '@/Components/LaravelTable.vue'
import { defineProps } from 'vue'

const { datatable, reatchedMaxLinks } = defineProps(['datatable', 'reatchedMaxLinks'])

</script>

<template>
    <Head :title="$t('url.title')" />

    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="mb-8 font-bold text-3xl">{{ $t('url.title') }}</h1>
                <LaravelTable 
                    :data='datatable'
                    :actions="['show', 'delete']"
                    :createText="$t('buttons.add')"
                    :createInModal="true"
                    :actions-modal="['show']"
                    :createRoute="route('dashboard.urls.create')"
                >
                    <template #before-table>
                        <div v-if="reatchedMaxLinks" class="text-orange-500 text-sm bg-orange-100 inline-block py-1 px-2 rounded-md mb-2">
                            {{ $t('url.reatched_max') }}
                        </div>
                    </template>
                </LaravelTable>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
