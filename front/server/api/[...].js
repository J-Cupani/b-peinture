
import { joinURL } from 'ufo'

export default defineEventHandler(async (event) => {
  const symfonyApiBaseUrl = 'http://193.203.191.231/v1'  // URL de Symfony via Nginx

  // On récupère l'URL de la requête API
  const path = event.node.req.url

  // Construire l'URL complète vers Symfony
  const targetUrl = joinURL(symfonyApiBaseUrl, path)

  // Proxy la requête vers Symfony
  return proxyRequest(event, targetUrl)
})