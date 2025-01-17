import { useActionToolbarStore } from '@/stores/actionToolbar'

export default defineNuxtRouteMiddleware(async (to, from) => {
  const actionToolbarStore = useActionToolbarStore()
  actionToolbarStore.resetButton() // Réinitialise les boutons à chaque navigation

  const layout = to.meta.layout || 'default'

  if (layout === 'public' || layout === 'blank') {
    return // N'applique pas le middleware pour les layouts publics
  }

  try {
    const data = await $fetch('/api/auth/verify-token', {
      method: 'GET',
    })


    if (!data.valid) {
      return navigateTo('/login')
    }
  } catch (error) {
    console.error('Erreur lors de la vérification du token:', error)
    return navigateTo('/login')
  }
})