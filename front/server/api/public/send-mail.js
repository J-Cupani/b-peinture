import { getCookie } from 'h3'

export default defineEventHandler(async (event) => {

  const config = useRuntimeConfig()
  const url = `${config.apiBaseUrl}/public/send-mail`

  // Lire le corps de la requête
  const body = await readBody(event)

  if (!body) {
    return { success: false, message: "Aucune donnée reçue" }
  }

  // Récupération et vérification du CSRF token
  const csrfTokenFromClient = event.req.headers['x-csrf-token']
  const csrfTokenFromCookie = getCookie(event, 'csrf_token')

  if (!csrfTokenFromClient || csrfTokenFromClient !== csrfTokenFromCookie) {
    return { success: false, message: "Token CSRF invalide ou absent." }
  }

  try {
    // Appeler l'API avec les données
    await $fetch(url, {
      method: 'POST',
      body: body,
    })

    return { success: true }
  } catch (error) {
    console.error('Erreur lors de l\'envoi du mail :', error)
    return { success: false, message: 'Une erreur est survenue lors de l\'envoi du mail.' }
  }
})