<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <v-text-field
                label="Nom"
                type="text"
                :error-messages="form.errors.name"
                v-model="form.name"
                name="name"
                class="w-full"
                outlined
            ></v-text-field>

            <v-text-field
                label="Email"
                type="email"
                :error-messages="form.errors.email"
                v-model="form.email"
                name="email"
                class="w-full"
                outlined
            ></v-text-field>

            <v-text-field
                label="Mot de passe"
                type="password"
                :error-messages="form.errors.password"
                v-model="form.password"
                name="password"
                class="w-full"
                outlined
            ></v-text-field>

            <v-text-field
                label="Confirmation mot de passe"
                type="password_confirmation"
                :error-messages="form.errors.password_confirmation"
                v-model="form.password_confirmation"
                name="password_confirmation"
                class="w-full"
                outlined
            ></v-text-field>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Déjà enregistré?
                </Link>

                <v-btn type="submit" color="primary" class="ml-4" :loading="form.processing" :disabled="form.processing">
                    S'inscrire
                </v-btn>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
