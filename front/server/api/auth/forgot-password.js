export default defineEventHandler(async (event) => {
  const body = await readBody(event)
  const config = useRuntimeConfig()

  try {
    // Requête à l'API Symfony pour la connexion
    const response = await $fetch(`${config.apiBaseUrl}/forgot-password`, {
      method: 'POST',
      body: {
        email: body.email,
      },
    })


    if (response) {
      return { success: true, message: 'Si l\'email est valide, vous recevrez un message pour réinitialiser votre mot de passe.' }
    }

    if (process.env.NODE_ENV === 'development' && debugToken) {
      event.node.res.setHeader('x-debug-token', debugToken); // Ajoute le debugToken dans les en-têtes
    }
    return response
  } catch (error) {
    return { success: false, message: 'Erreur lors de la récupération de mot de passe' }
  }
})
