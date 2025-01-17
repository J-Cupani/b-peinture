export default defineEventHandler(async (event) => {
  const body = await readBody(event)
  const config = useRuntimeConfig()

  try {
    // Requête à l'API Symfony pour réinitialiser le mot de passe
    const response = await $fetch(`${config.apiBaseUrl}/reset-password/${body.resetToken}`, {
      method: 'POST',
      body: {
        userToken: body.userToken,
        password: body.password,
      },
    })

    // Gestion des réponses en fonction du statut renvoyé par l'API Symfony
    if (response.status === 'success') {
      return { success: true, message: 'Mot de passe réinitialisé avec succès' }
    } else if (response.status === 'error' && response.msg === 'Timeout') {
      return { success: false, message: 'Le lien a expiré. Veuillez refaire une demande' }
    } else if (response.status === 'error' && response.msg === 'Account blocked') {
      return { success: false, message: 'Votre compte est bloqué. Veuillez contacter le support' }
    } else if (response.status === 'error' && response.msg === 'No user') {
      return { success: false, message: 'Utilisateur introuvable. Vérifiez le lien ou refaites une demande' }
    } else {
      return { success: false, message: 'Une erreur inattendue est survenue' }
    }
  } catch (error) {
    // Gestion des erreurs réseau ou autres exceptions
    return { success: false, message: 'Erreur de connexion avec le serveur. Veuillez contactez l\'administrateur' }
  }
})