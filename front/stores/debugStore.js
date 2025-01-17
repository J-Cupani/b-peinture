
export const useDebugStore = defineStore('debugStore', () => {
  // État : tableau pour stocker les tokens et le dernier token
  const debugTokens = ref([]);
  const latestDebugToken = computed(() => debugTokens.value[debugTokens.value.length - 1] || null);

  // Action pour ajouter un nouveau token de débogage
  const addDebugToken = (token) => {
    if (token) {
      debugTokens.value.push(token); // Ajoute le token au tableau
    }
  }

  return {
    debugTokens,         // Liste de tous les tokens
    latestDebugToken,    // Dernier token ajouté
    addDebugToken,       // Fonction pour ajouter un token
  };
});