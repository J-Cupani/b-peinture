import { nanoid } from 'nanoid'

export const generateCsrfToken = () => {
  return nanoid() // Génère un token unique
}