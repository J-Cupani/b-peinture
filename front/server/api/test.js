
export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()

  try {
    // Requête vers l'API Symfony via Nginx, en utilisant le préfixe /v1
    const response = await $fetch(`${config.apiBaseUrl}/test`, {
      method: 'GET',
    })

    // Retourner la réponse obtenue depuis Symfony
    return response
  } catch (error) {
    // Gérer les erreurs et renvoyer un message d'erreur personnalisé
    return { error: 'Erreur lors de la requête API', details: error.message }
  }
})