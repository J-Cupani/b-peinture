import { defineNuxtPlugin } from '#app'
import piniaPersistedstate from 'pinia-plugin-persistedstate'

export default defineNuxtPlugin((nuxtApp) => {
  const pinia = nuxtApp.$pinia // Récupère l'instance Pinia de Nuxt
  pinia.use(piniaPersistedstate) // Active le plugin de persistance sur Pinia
})
