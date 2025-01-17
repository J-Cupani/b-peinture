import { useApi } from '@/composables/useApi.js'
export default defineEventHandler(async (event) => {
  const { fetchServer } = useApi(event)

  const body = await readBody(event)
  const config = useRuntimeConfig()

  try {
    // Requête à l'API Symfony pour réinitialiser le mot de passe
    const response = await fetchServer(`${config.apiBaseUrl}/user/edit-password/${body.token}`, {
      method: 'POST',
      body: {
        password: body.password,
      },
    })

    // Vérifie la réponse du serveur
    if (response.status === 'success') {
      return { success: true, message: 'Mot de passe modifié avec succès' }
    } else  {
      return { success: false, message: 'Le mot de passe doit contenir au moins 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial.' }
    }
  } catch (error) {
    // Gestion des erreurs réseau ou autres exceptions
    return { success: false, message: 'Erreur de connexion avec le serveur. Veuillez contacter l\'administrateur' }
  }
})
