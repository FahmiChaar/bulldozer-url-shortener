<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import LaravelTable from '@/Components/LaravelTable.vue'
import { defineProps } from 'vue'

const { datatable, reatchedMaxLinks } = defineProps(['datatable', 'reatchedMaxLinks'])

</script>

<template>
    <Head title="Mes Liens" />

    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="mb-8 font-bold text-3xl">Mes Liens</h1>
                <LaravelTable 
                    :data='datatable'
                    :actions="['show', 'delete']"
                    createText="Ajouter"
                    :createInModal="true"
                    :actions-modal="['show']"
                    :createRoute="route('dashboard.urls.create')"
                >
                    <template #before-table>
                        <div v-if="reatchedMaxLinks" class="text-orange-500 text-sm bg-orange-100 inline-block py-1 px-2 rounded-md mb-2">
                            vous avez atteint le maximum de lien créé, vous devez supprimer des liens pour en ajouter d'autres
                        </div>
                    </template>
                </LaravelTable>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
