export default defineEventHandler(async (event) => {
  const body = await readBody(event)
  const config = useRuntimeConfig()

  try {
    // Vérification des paramètres envoyés dans la requête
    if (!body.username || !body.password) {
      return { success: false, message: 'Nom d’utilisateur ou mot de passe manquant.' }
    }

    // Requête à l'API Symfony pour la connexion
    const response = await $fetch(`${config.apiBaseUrl}/login`, {
      method: 'POST',
      body: {
        username: body.username,
        password: body.password,
      },
    })
    // Vérifier si la réponse contient un token
    const token = response.token

    if (!token) {
      return { success: false, message: 'Token JWT manquant dans la réponse.' }
    }

    // Stocker le token JWT dans un cookie sécurisé
    setCookie(event, 'accessToken', token, {
      httpOnly: true,               // Empêche l'accès au cookie via le JavaScript client
      secure: process.env.NODE_ENV === 'production',
      sameSite: 'Strict',           // Empêche les attaques CSRF
      maxAge: 60 * 60 * 24 * 7,     // Durée de vie du cookie (7 jours)
    })

    // Requête pour récupérer les infos de l'utilisateur avec le token
    const userResponse = await $fetch(`${config.apiBaseUrl}/user/me`, {
      method: 'GET',
      headers: {
        Authorization: `Bearer ${token}`,
      },
    })

    // Vérification de la réponse utilisateur
    if (!userResponse) {
      return { success: false, message: 'Impossible de récupérer les informations utilisateur.' }
    }

    // Si tout va bien, retourner les informations de l'utilisateur
    return { success: true, user: userResponse }

  } catch (error) {
    // Gestion des erreurs détaillées
    return {
      success: false,
      message: 'Identifiants ou mot de passe incorrect'
    }
  }
})