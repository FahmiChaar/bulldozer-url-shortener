<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-gray-600">
            Il s'agit d'une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.
        </div>

        <form @submit.prevent="submit">
            <v-text-field
                label="Mot de passe"
                type="password"
                :error-messages="form.errors.password"
                v-model="form.password"
                name="password"
                class="w-full"
                variant="outlined"
            ></v-text-field>

            <div class="flex justify-end mt-4">
                <v-btn type="submit" color="primary" class="ml-4" :loading="form.processing" :disabled="form.processing">
                    Confirmer
                </v-btn>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
