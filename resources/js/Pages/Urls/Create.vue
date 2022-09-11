<script setup>
import VCardHeader from '@/Components/VCardHeader.vue'
import { defineProps } from 'vue'
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { useBus } from '@/events';
import Swal from 'sweetalert2'
import { useToast } from 'vue-toastification';

const { url } = defineProps(['url', 'isModal'])
const bus = useBus()
const toast = useToast()

const form = useForm({
    id: null,
    link: null,
    shorten_url: null,
    ...url
});

const copyLinkToClipboard = (link) => {
    if (navigator?.clipboard) {
        navigator.clipboard.writeText(link);
    }else {
        const elem = document.createElement('textarea');
        elem.value = link;
        document.body.appendChild(elem);
        elem.select();
        document.execCommand('copy');
        document.body.removeChild(elem);
    }
    toast.info('Lien raccourci copié dans le presse-papiers')
}

const store = () => {
    form.post(route("dashboard.urls.store"), {
        onSuccess: async ({ props }) => {
            form.reset()
            bus.$emit('datatable:refresh')
            console.log(props.additionalData.shortenUrl.shorten_link)
            const shorten_link = props.additionalData.shortenUrl.shorten_link
            const result = await Swal.fire({
                title: 'Copier le lien raccourci ?',
                text: shorten_link,
                icon: 'info',
                confirmButtonText: 'copiez-le!'
            })
            if (result.isConfirmed) {
                copyLinkToClipboard(shorten_link)
            }
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