import { generateCsrfToken } from '@/utils/csrfToken.js'

export default defineEventHandler((event) => {
  // Générer un token CSRF
  const csrfToken = generateCsrfToken()

  // Stocker le token dans un cookie HTTP-only
  setCookie(event, 'csrf_token', csrfToken, {
    httpOnly: true,
    secure: process.env.NODE_ENV === 'production',
    sameSite: 'strict',
    path: '/',
    maxAge: 60 * 10, // Token valide 10 minutes
  })

  return { success: true, csrfToken } // Optionnel, si vous voulez aussi retourner le token
})