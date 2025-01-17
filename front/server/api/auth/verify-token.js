import jwt from 'jsonwebtoken'

export default defineEventHandler((event) => {
  const token = getCookie(event, 'accessToken')

  if (!token) {
    return { valid: false }
  }

  try {
    // Décodage du token sans vérifier la signature
    const decoded = jwt.decode(token)

    if (!decoded || !decoded.exp) {
      return { valid: false }
    }

    // Vérification si le token est expiré
    const currentTime = Math.floor(Date.now() / 1000) // Temps actuel en secondes
    if (decoded.exp < currentTime) {
      return { valid: false, message: 'Session expirée' }
    }

    return { valid: true, user: decoded }
  } catch (error) {
    return { valid: false }
  }
})
