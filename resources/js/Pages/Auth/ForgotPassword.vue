<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600">
            Mot de passe oublié? Aucun problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <v-text-field
                label="Email"
                type="email"
                :error-messages="form.errors.email"
                v-model="form.email"
                name="email"
                class="w-full"
                variant="outlined"
            ></v-text-field>

            <div class="flex items-center justify-end mt-4">
                <v-btn type="submit" color="primary" class="capitalize" :loading="form.processing" :disabled="form.processing">
                    Lien de réinitialisation du mot de passe par e-mail
                </v-btn>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
