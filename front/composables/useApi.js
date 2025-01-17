import {getCookie} from 'h3'
import {defu} from 'defu'

export function useApi(event) {
  const isDev = process.env.NODE_ENV === 'development' // Vérifie l'environnement

  const token = getCookie(event, 'accessToken')

  if (!token) {
    return
  }

  // Gestion de la réponse pour les `dd()` de Symfony
  const handleDebugResponse = async (response, error = null) => {
    const statusCode = error ? error.response.status : response.status
    const debugContent = error ? error.response._data : response._data

    if (debugContent) {
      event.node.res.setHeader('Content-Type', 'text/html')
      event.node.res.statusCode = statusCode || 500
      event.node.res.end(debugContent)
    } else {
      event.node.res.setHeader('Content-Type', 'text/html')
      event.node.res.statusCode = 500
      event.node.res.end('<p>Erreur lors de la requête au backend Symfony.</p>')
    }
  }

  // Extraire le `debugToken` des en-têtes de réponse
  const storeDebugToken = (response) => {
    return response.headers.get('x-debug-token')
  }

  // Méthode pour le mode développement
  const fetchDev = async (url, options = {}) => {
    const defaults = {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    }

    const params = defu(options, defaults)

    try {
      const response = await $fetch.raw(url, { ...params, responseType: 'text' })

      const debugToken = storeDebugToken(response)

      if (response && response._data && response.status === 500) {
        await handleDebugResponse(response)
      }

      const contentType = response.headers.get('content-type')

      const data = contentType && contentType.includes('application/json')
        ? JSON.parse(response._data)
        : response._data

      return { data, debugToken }
    } catch (error) {
      console.error('[fetchDev] Error:', error)

      if (error.response && error.response._data) {
        console.warn('[fetchDev] Handling debug response for error')
        await handleDebugResponse(null, error)
      } else {
        console.error('[fetchDev] Unexpected error:', error)
        event.node.res.setHeader('Content-Type', 'text/html')
        event.node.res.statusCode = 500
        event.node.res.end('<p>Erreur lors de la requête au backend Symfony.</p>')
      }
      return { data: null }
    }
  }

  // Méthode pour le mode production
  const fetchProd = async (url, options = {}) => {

    const defaults = {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    }

    const params = defu(options, defaults)

    try {
      const data = await $fetch(url, params) // Appel direct avec `$fetch` pour la production
      return { data }
    } catch (error) {
      return { data: null }
    }
  }

  // Sélectionne la méthode en fonction de l'environnement
  const fetchServer = isDev ? fetchDev : fetchProd

  return {
    fetchServer,
  }
}