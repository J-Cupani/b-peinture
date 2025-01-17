<template>
  <!-- Dialog pour afficher les pages du profiler -->
  <v-dialog v-model="dialogVisible" max-width="60vw" max-height="90vh" :persistent="false">
    <v-card>
      <v-card-title>{{ dialogTitle }}</v-card-title>
      <v-card-text>
        <iframe v-if="dialogUrl" :src="dialogUrl" width="100%" height="600px" frameborder="0"></iframe>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="closeDialog">Fermer</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

  <!-- Toolbar avec deux boutons alignés en bas à droite -->
  <div class="debug-toolbar">
    <v-btn color="primary" @click="openProfilerSearch">
      <v-icon left class="mr-2">tabler-list-search</v-icon>
      Request List
    </v-btn>
    <v-btn color="primary" @click="openLatestProfiler" class="toolbar-btn" :disabled="!latestToken">
      <v-icon left class="mr-2">tabler-current-location</v-icon>
      Latest Request
    </v-btn>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useDebugStore } from '@/stores/debugStore';

const dialogVisible = ref(false);
const dialogUrl = ref('');
const dialogTitle = ref('');

// Accéder au dernier token depuis le store
const debugStore = useDebugStore();
const latestToken = computed(() => debugStore.latestDebugToken);

// Fonction pour ouvrir la recherche du profiler dans la boîte de dialogue
const openProfilerSearch = () => {
  dialogUrl.value = 'https://localhost:8443/_profiler/empty/search/results?limit=10';
  dialogTitle.value = 'Request List';
  dialogVisible.value = true;
};

// Fonction pour ouvrir le profiler pour le dernier token dans la boîte de dialogue
const openLatestProfiler = () => {
  if (latestToken.value) {
    dialogUrl.value = `https://localhost:8443/_profiler/${latestToken.value}`;
    dialogTitle.value = 'Latest Request';
    dialogVisible.value = true;
  }
};

// Fonction pour fermer la boîte de dialogue
const closeDialog = () => {
  dialogVisible.value = false;
  dialogUrl.value = '';
};
</script>

<style scoped>
.debug-toolbar {
  position: fixed;
  bottom: 16px;
  right: 16px;
  display: flex;
  gap: 8px;
  z-index: 1000;
}

</style>