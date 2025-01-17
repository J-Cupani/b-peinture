export default defineEventHandler(async (event) => {
  const body = await readBody(event)
  const config = useRuntimeConfig()

  try {
    // Requête à l'API Symfony pour la connexion
    const response = await $fetch(`${config.apiBaseUrl}/verif-password-token`, {
      method: 'POST',
      body: {
        token: body.token,
      },
    })

    if (response.result === 'match') {
      return { success: true, user: response.user}
    } else {
      return { success: false, message: 'Votre lien de renouvellement de mot de passe est dépassé' }
    }
  } catch (error) {
    return { success: false, message: 'Votre lien de renouvellement de mot de passe est dépassé' }
  }
})
