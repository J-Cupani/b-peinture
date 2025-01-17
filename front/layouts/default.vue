<script setup>
import {useConfigStore} from '@core/stores/config'
import {AppContentLayoutNav} from '@layouts/enums'
import {switchToVerticalNavOnLtOverlayNavBreakpoint} from '@layouts/utils'

// Composants de layout asynchrones
const DefaultLayoutWithHorizontalNav = defineAsyncComponent(() => import('./components/DefaultLayoutWithHorizontalNav.vue'))
const DefaultLayoutWithVerticalNav = defineAsyncComponent(() => import('./components/DefaultLayoutWithVerticalNav.vue'))

const configStore = useConfigStore()

// Basculer vers la navigation verticale lorsque le point de rupture défini est atteint (pour la navigation horizontale)
switchToVerticalNavOnLtOverlayNavBreakpoint()

// Injection des classes de skin
const {layoutAttrs, injectSkinClasses} = useSkins()
injectSkinClasses()

useHead({
  link: [
    { rel: 'stylesheet', href: '/assets/styles/css/icons.css' }, // Fichier compilé depuis @/plugins/iconify/icons.css
    {
      rel: 'stylesheet',
      href: 'https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap',
    }
  ]
})
</script>

<template>
  <Component
    v-bind="layoutAttrs"
    :is="configStore.appContentLayoutNav === AppContentLayoutNav.Vertical ? DefaultLayoutWithVerticalNav : DefaultLayoutWithHorizontalNav"
  >
    <slot/>
  </Component>
</template>

<style lang="scss">
// As we are using `layouts` plugin we need its styles to be imported
@use "@layouts/styles/default-layout";
</style>

<style src="@/plugins/iconify/icons.css" />