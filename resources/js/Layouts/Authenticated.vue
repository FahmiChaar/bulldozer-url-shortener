<script setup>
import AppToolbar from './AppToolbar.vue'
import ModalStack from '../Components/ModalStack.vue'
</script>

<template>
    <v-app id="inspire" light v-cloak class="bg-gray-100">
    <ModalStack />
    <AppToolbar />
    <div class="transition-fade">
      <v-main>
        <v-container p-10>
          <flash-messages />
          <slot />
        </v-container>
      </v-main>
    </div>
  </v-app>
</template>
