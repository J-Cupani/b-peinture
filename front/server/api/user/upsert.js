import { useApi } from '@/composables/useApi.js'

export default defineEventHandler(async (event) => {
  const { fetchServer } = useApi(event)

  const config = useRuntimeConfig()
  const url = `${config.apiBaseUrl}/user/upsert`

  const body = await readFormData(event)

  if (!body) {
    return { success: false, message: "Aucune donnée reçue" };
  }

  try {
    const { data, debugToken }  = await fetchServer(url, {
      method: 'POST',
      body: body
    })

    const response = {
      success: data.success,
      messages: data.success ? undefined : data.messages,
      user: data.success ? data.user : undefined,
    }

    if (process.env.NODE_ENV === 'development' && debugToken) {
      event.node.res.setHeader('x-debug-token', debugToken); // Ajoute le debugToken dans les en-têtes
    }

    return response
  } catch (error) {
    return { success: false, message: 'Une erreur s\'est produite lors de la mise à jour de l\'utilisateur'}
  }
})