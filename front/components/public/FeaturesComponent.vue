<template>
  <div
    class="rn-service-area rn-section-gap section-separator scrollSpysection"
    id="services"
  >
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div
            class="section-title text-center"
            data-aos="fade-up"
            data-aos-duration="500"
            data-aos-delay="100"
            data-aos-once="true"
          >
            <span class="subtitle">Ce que je propose</span>
            <h2 class="title">Mes Services</h2>
          </div>
        </div>
      </div>
      <div class="row row--25 mt_md--10 mt_sm--10">
        <!-- Start Single Service -->
        <div
          v-for="(elm, i) in features.slice(0, 3)"
          :key="i"
          data-aos="fade-up"
          data-aos-duration="500"
          data-aos-delay="100"
          data-aos-once="true"
          class="col-xl-4 col-12 mt--50 mt_md--30 mt_sm--30"
        >
          <div class="rn-service">
            <div class="inner">
              <div class="icon">
                <i :data-feather="elm.icon"></i>
              </div>
              <div class="content">
                <h4 class="title">
                  {{ elm.title }}
                </h4>
                <p class="description">
                  {{ elm.description }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- End Single Service -->
      </div>
    </div>
  </div>
</template>

<script setup>
const features = [
  {
    id: 1,
    delay: 100,
    icon: "globe",
    title: "Site internet",
    description: "Création de sites web modernes et adaptés à vos besoins, avec une attention particulière au design et à l'expérience utilisateur.",
  },
  {
    id: 2,
    delay: 300,
    icon: "layout",
    title: "Application Web",
    description: "Développement d'applications web interactives et performantes, conçues pour offrir des solutions sur mesure à vos projets.",
  },
  {
    id: 3,
    delay: 500,
    icon: "server",
    title: "API",
    description: "Conception et déploiement d'API robustes et sécurisées pour connecter vos services et améliorer la communication entre vos systèmes.",
  },
]
</script>
