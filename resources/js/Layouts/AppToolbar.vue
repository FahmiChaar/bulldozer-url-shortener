<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <v-app-bar class="app-toolbar shadow" color="white" app>
        <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
        <Link href="/dashboard" class="d-flex router-link-active px-5">
            <img src="/assets/images/logo.png" width="25">
        </Link>
        <v-spacer></v-spacer>
        <v-toolbar-items>
            <v-menu offset-y transition="slide-y-transition">
                <template v-slot:activator="{ props }">
                    <v-btn text v-bind="props" class="capitalize">
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
        </v-toolbar-items>
    </v-app-bar>
</template>