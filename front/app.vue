<script setup>
import {useRoute} from '#imports' // Utilise le hook fourni par Nuxt
import {useTheme} from 'vuetify'
import ScrollToTop from '@core/components/ScrollToTop.vue'
import initCore from '@core/initCore'
import {initConfigStore, useConfigStore} from '@core/stores/config'
import {hexToRgb} from '@core/utils/colorConverter'
import {staticPrimaryColor} from '@/plugins/vuetify/theme.js'
import DebugToolbar from "@/components/DebugToolbar.vue"
// import '@core/scss/template/index.scss'

const route = useRoute() // Utilise le hook `useRoute` de Nuxt pour accéder aux informations de la route
const {global} = useTheme()

// Sync current theme with initial loader theme
initCore()
initConfigStore()

const configStore = useConfigStore()
const {isMobile} = useDevice()

if (isMobile) configStore.appContentLayoutNav = 'vertical'

// Détermine si le layout est 'front'
const isFrontLayout = route.meta.layout === 'public' // Accède aux métadonnées de la route via `useRoute`
const isDev = process.env.NODE_ENV === 'development'
</script>

<template>
  <div v-if="isFrontLayout">
    <NuxtLayout>
      <NuxtPage />
    </NuxtLayout>
  </div>

  <VLocaleProvider v-else :rtl="configStore.isAppRTL">
    <NuxtLoadingIndicator :color="staticPrimaryColor" v-if="!isFrontLayout"/>
    <!-- Si ce n'est pas le layout front, utilise Vuetify -->
    <VApp :style="`--v-global-theme-primary: ${hexToRgb(global.current.value.colors.primary)}`">
      <NuxtLayout>
        <NuxtPage/>
      </NuxtLayout>

      <SnackbarComponent/>
      <ScrollToTop/>
    </VApp>
  </VLocaleProvider>

  <DebugToolbar v-if="isDev && !isFrontLayout"/>
</template>