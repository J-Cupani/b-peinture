import { useApi } from '@/composables/useApi.js'

export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()

  const url = `${config.apiBaseUrl}/public/get-all-project`

  try {
    const response = await $fetch(url, {
      method: 'GET',
    })

    return response.projects
  } catch (error) {
    return { success: false, message: 'Une erreur est survenue lors de la récupération des projets.' }
  }
})