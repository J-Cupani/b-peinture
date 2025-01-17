import { useDebugStore } from '@/stores/debugStore'

export default defineNuxtPlugin((nuxtApp) => {
  const originalFetch = $fetch

  $fetch = async (url, options = {}) => {
    try {
      // Utiliser $fetch.raw pour accéder aux en-têtes
      const response = await originalFetch.raw(url, options)

      if (process.env.NODE_ENV === 'development') {
        // Extraire le debugToken des en-têtes
        const debugToken = response.headers.get('x-debug-token')
        if (debugToken) {
          // Accéder au store Pinia et ajouter le debugToken
          const debugStore = useDebugStore()
          debugStore.addDebugToken(debugToken)
        }
      }

      return response._data
    } catch (error) {
      throw error
    }
  }
})
