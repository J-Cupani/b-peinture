import { useApi } from '@/composables/useApi.js'

export default defineEventHandler(async (event) => {
  const { fetchServer } = useApi(event)
  const query = getQuery(event); // Récupère les paramètres de la requête
  const token = query.token; // Extrait le token

  if (!token) {
    return { success: false, message: 'Token manquant.' };
  }

  const config = useRuntimeConfig()
  const url = `${config.apiBaseUrl}/project/delete-project/${token}`

  try {
    const { data, debugToken }  = await fetchServer(url, {
      method: 'DELETE'
    })

    const response = { success: data.success }

    if (process.env.NODE_ENV === 'development' && debugToken) {
      event.node.res.setHeader('x-debug-token', debugToken); // Ajoute le debugToken dans les en-têtes
    }

    return response
  } catch (error) {
    return { success: false, message: 'Une erreur s\'est produite lors de la mise à jour de l\'utilisateur'}
  }
})