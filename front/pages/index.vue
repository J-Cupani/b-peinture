<script setup>
definePageMeta({
  layout: 'public',
  public: true,
})

useSeoMeta({
  title: "C4Dev",
  description: "C4Dev - Développeur freelance web et mobile",
  lang: "fr"
})

const navItemsMain = [
  { id: 1, title: "Accueil", href: "#accueil" },
  { id: 2, title: "Mes Services", href: "#services" },
  { id: 3, title: "Portfolio", href: "#portfolio" },
  { id: 4, title: "A propos", href: "#a-propos" },
]
</script>

<template>
  <div class="template-color-1 spybody">
    <HeaderComponent :navItems="navItemsMain" />
    <div class="main-page-wrapper mx-2">
      <HeroComponent />
      <FeaturesComponent />
      <PortfolioComponent />
      <ResumeComponent />
      <ContactComponent />
    </div>
    <FooterComponent />
    <CommonComponents />
  </div>
</template>


<style>
html, body {
  background-color: #212428; /* Exemple : couleur de fond */
}
</style>