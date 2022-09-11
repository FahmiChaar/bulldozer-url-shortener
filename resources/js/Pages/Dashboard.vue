<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3'
import FlashMessages from '@/Layouts/FlashMessages.vue';
</script>

<template>
<BreezeAuthenticatedLayout>
    <Head title="Tableau de bord" />
    <flash-messages />
    <div class="shadow bg-white rounded-lg p-8">
        <h1 class="font-bold text-2xl text-center">Bienvenue dans mon application de raccourcissement d'url</h1>
        <p class="mt-4">
            ceci est une application de démonstration veuillez cliquer sur le bouton ci-dessous pour commencer votre expérience
        </p>
        <div class="text-center mt-4">
            <Link :href="route('dashboard.urls.index')">
                <v-btn color="primary">Commencer</v-btn>
            </Link>
        </div>
    </div>
</BreezeAuthenticatedLayout>
</template>