import { useApi } from '@/composables/useApi.js'

export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()
  const url = `${config.apiBaseUrl}/project/get-all-project`

  const { fetchServer } = useApi(event)

  try {
    const { data, debugToken } = await fetchServer(url, {
      method: 'GET'
    })

    const response = {
      success: data.success,
      messages: data.success ? undefined : data.messages,
      projects: data.success ? data.projects : undefined,
    }

    // Ajouter le debugToken au store en mode développement uniquement
    if (process.env.NODE_ENV === 'development' && debugToken) {
      event.node.res.setHeader('x-debug-token', debugToken); // Ajoute le debugToken dans les en-têtes
    }
    return response
  } catch (error) {
    console.error('Erreur lors de la requête API:', error)
    return { success: false, message: 'Une erreur est survenue lors de la récupération des utilisateurs.' }
  }
})
