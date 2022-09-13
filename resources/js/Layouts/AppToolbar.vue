<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { loadLanguageAsync } from 'laravel-vue-i18n';

const currentAppLocal = ref(localStorage.app_local || 'fr')

const switchLanguage = (lang) => {
    localStorage.app_local = lang
    currentAppLocal.value = lang
    loadLanguageAsync(lang)
}

</script>

<template>
    <v-app-bar class="app-toolbar shadow" color="white" app>
        <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
        <Link href="/dashboard/urls" class="d-flex router-link-active px-5">
            <img src="/assets/images/logo.png" width="25">
        </Link>
        <v-spacer></v-spacer>
        <v-menu offset-y transition="slide-y-transition">
            <template v-slot:activator="{ props }">
                <v-btn variant="icon" v-bind="props">
                    <v-icon size="large" icon="language" class="mr-1" />
                </v-btn>
            </template>
            <v-list>
                <v-list-item ripple @click="switchLanguage('fr')" :disabled="currentAppLocal === 'fr'">
                    <v-list-item-title>Français</v-list-item-title>
                </v-list-item>
                <v-list-item ripple @click="switchLanguage('en')" :disabled="currentAppLocal === 'en'">
                    <v-list-item-title>English</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
        <v-menu offset-y transition="slide-y-transition">
            <template v-slot:activator="{ props }">
                <v-btn variant="text" v-bind="props" class="capitalize">
                    <v-icon class="mr-1" icon="account_circle" />
                    {{ $page.props.auth.user.name }}
                </v-btn>
            </template>
            <v-list>
                <v-list-item ripple>
                    <v-list-item-content>
                        <Link class="cursor-pointer" :href="route('logout')" method="post" as="v-btn">
                            <v-icon icon="power_settings_new"/> Déconnexion
                        </Link>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-menu>
    </v-app-bar>
</template>