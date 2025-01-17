<script setup>
const { injectSkinClasses } = useSkins()

// ℹ️ This will inject classes in body tag for accurate styling
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
  <div class="layout-wrapper layout-blank">
    <slot />
  </div>
</template>

<style>
.layout-wrapper.layout-blank {
  flex-direction: column;
}
</style>

<style src="@/plugins/iconify/icons.css" />
