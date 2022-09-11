<script setup>
import VCardHeader from '@/Components/VCardHeader.vue'
import { defineProps } from 'vue'
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { useBus } from '@/events';

const { url } = defineProps(['url', 'isModal'])

const form = useForm({
    id: null,
    link: null,
    shorten_url: null,
    ...url
});

const bus = useBus() 

const store = () => {
    form.post(route("dashboard.urls.store"), {
        onSuccess: () => {
            form.reset()
            bus.$emit('datatable:refresh')
        },
    });
}
</script>

<template>
    <div class="bg-white rounded-md shadow overflow-hidden">
        <Head title="Raccourcir un lien" />
        <VCardHeader v-if="isModal" color="primary" title="Raccourcir un lien" :showCloseModal="true" />
        <form @submit.prevent="store">
            <div class="p-8">
                <v-text-field
                    label="Lien"
                    placeholder="example: https//www.google.com"
                    type="text"
                    :error-messages="form.errors.link"
                    v-model="form.link"
                    class="w-full"
                    variant="outlined"
                ></v-text-field>
                <div class="pt-2 flex justify-start items-center">
                    <v-btn :loading="form.processing" color="primary" type="submit" class="capitalize">Enregistrer</v-btn>
                </div>
            </div>
        </form>
    </div>
</template>