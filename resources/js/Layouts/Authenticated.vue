<script setup>
import AppToolbar from './AppToolbar.vue'
import ModalStack from '@/Components/ModalStack.vue'
import FlashMessages from '@/Layouts/FlashMessages.vue'
</script>

<template>
    <v-app id="inspire" light v-cloak class="bg-gray-100">
    <modal-stack />
    <app-toolbar />
    <div>
      <v-main>
        <v-container p-10>
          <flash-messages />
          <slot />
        </v-container>
      </v-main>
    </div>
  </v-app>
</template>
