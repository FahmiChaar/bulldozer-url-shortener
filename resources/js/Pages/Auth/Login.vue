<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Connexion" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <v-text-field
                label="Email"
                type="email"
                :error-messages="!form.email && form.errors.email"
                v-model="form.email"
                name="email"
                append-inner-icon="email"
                class="w-full"
                variant="outlined"
                color="primary"
            ></v-text-field>
            <v-text-field
                label="Mot de passe"
                type="password"
                :error-messages="!form.password && form.errors.password"
                v-model="form.password"
                name="password"
                class="w-full"
                append-inner-icon="lock"
                variant="outlined"
                color="primary"
            ></v-text-field>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Mot de passe oublié?
                </Link>

                <v-btn type="submit" color="primary" class="ml-4 capitalize" :loading="form.processing" :disabled="form.processing">
                    Connexion
                </v-btn>
            </div>
        </form>
        <div class="text-center mt-6">
            <Link href="/register">
                <v-btn class="normal-case" variant="palin" color="primary" size="small">
                    Vous n'avez pas de compte, inscrivez-vous
                </v-btn>
            </Link>
        </div>
    </BreezeGuestLayout>
</template>
