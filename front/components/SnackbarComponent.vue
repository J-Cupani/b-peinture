<script setup>
import { useNotificationStore } from "@/stores/notification"

const notificationStore = useNotificationStore()
</script>

<template>
  <VSnackbar
    v-model="notificationStore.isOpen"
    :color="notificationStore.color"
    :timeout="2500"
    location="bottom right"
  >
    <p class="ma-0">{{ notificationStore.title }}</p>
    <template v-if="notificationStore.text?.length">
      <div v-for="text in notificationStore.text">{{ text }}</div>
    </template>

    <template v-slot:actions>
      <VBtn
        color="default"
        size="small"
        variant="text"
        @click="notificationStore.closeSnack"
        icon
      >
        <VIcon
          icon="mdi-close"
          size="24"
        />
      </VBtn>
    </template>
  </VSnackbar>
</template>
