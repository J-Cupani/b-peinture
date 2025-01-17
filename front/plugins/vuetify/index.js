import { deepMerge } from '@antfu/utils'
import { createVuetify } from 'vuetify'
import { VBtn } from 'vuetify/components/VBtn'
import defaults from './defaults'
import { icons } from './icons'
import { staticPrimaryColor, staticPrimaryDarkenColor, themes } from './theme'
import { themeConfig } from '@themeConfig'

// Styles
import { cookieRef } from '@/@layouts/stores/config'
import '@core/scss/template/libs/vuetify/index.scss'
import 'vuetify/styles'

export default defineNuxtPlugin(nuxtApp => {
  // Utilisation de useNuxtApp pour récupérer l'instance Nuxt
  const nuxtAppInstance = useNuxtApp()

  if (!nuxtAppInstance || !nuxtAppInstance.vueApp) {
    throw new Error('Nuxt application is not initialized properly.')
  }

  // Récupération des thèmes en fonction des cookies
  const cookieThemeValues = {
    defaultTheme: resolveVuetifyTheme(themeConfig.app.theme),
    themes: {
      light: {
        colors: {
          'primary': cookieRef('lightThemePrimaryColor', staticPrimaryColor).value,
          'primary-darken-1': cookieRef('lightThemePrimaryDarkenColor', staticPrimaryDarkenColor).value,
        },
      },
      dark: {
        colors: {
          'primary': cookieRef('darkThemePrimaryColor', staticPrimaryColor).value,
          'primary-darken-1': cookieRef('darkThemePrimaryDarkenColor', staticPrimaryDarkenColor).value,
        },
      },
    },
  }

  // Fusionner les thèmes avec les cookies et les thèmes par défaut
  const optionTheme = deepMerge({ themes }, cookieThemeValues)

  // Créer une instance de Vuetify avec les options
  const vuetify = createVuetify({
    ssr: false, // Activation de la compatibilité SSR
    aliases: {
      IconBtn: VBtn,
    },
    defaults,
    icons,
    theme: optionTheme,
  })

  // Utiliser Vuetify avec vueApp de Nuxt
  nuxtAppInstance.vueApp.use(vuetify)
})