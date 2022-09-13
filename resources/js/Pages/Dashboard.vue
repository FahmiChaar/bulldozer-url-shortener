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
        <h1 class="font-bold text-2xl text-center">{{ $t("welcome.title") }}</h1>
        <p class="mt-4">
            {{ $t('welcome.content') }}
        </p>
        <div class="text-center mt-4">
            <Link :href="route('dashboard.urls.index')">
                <v-btn color="primary">{{ $t('welcome.start') }}</v-btn>
            </Link>
        </div>
    </div>
</BreezeAuthenticatedLayout>
</template>