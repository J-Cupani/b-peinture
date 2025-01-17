<template>
  <div
    class="rn-contact-area rn-section-gap section-separator scrollSpysection"
    id="contacts"
  >
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title text-center">
            <span class="subtitle">Contact</span>
            <h2 class="title">Contactez moi</h2>
          </div>
        </div>
      </div>

      <div class="row mt--50 mt_md--40 mt_sm--40 mt-contact-sm">
        <div class="col-lg-4">
          <div class="contact-about-area">
            <div class="thumbnail">
              <nuxt-img
                src="/assets/images/profilPicture.webp"
                alt="contact-img"
                format="webp"
              />
            </div>
            <div class="title-area">
              <h4 class="title">Joachim Cupani</h4>
              <span class="color-blue">Développeur Fullstack</span>
            </div>
            <div class="description">
              <p>
                Je suis là pour donner vie à vos projets, que ce soit à travers des missions freelance ou des collaborations à long terme.
              </p>
              <span class="mail color-blue">
                Email: <a href="mailto:contact@c4dev.fr" class="color-white">contact@c4dev.fr</a></span>
            </div>
            <div class="social-area">
              <div class="name">RETROUVEZ-MOI SUR</div>
              <div class="social-icone">
                <a
                  v-for="(elm, i) in socials.slice(0, 3)"
                  :key="i"
                  :href="elm.link"
                  ><i :data-feather="elm.icon"></i
                >
                  <span class="sr-only">{{ elm.label }}</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div data-aos-delay="600" class="col-lg-8 contact-input">
          <div class="contact-form-wrapper">
            <div class="introduce">
              <form
                class="rnt-contact-form rwt-dynamic-form row needs-validation"
                @submit.prevent="handleSubmit"
                novalidate
              >
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="contact-name">Votre nom</label>
                    <input
                      class="form-control form-control-lg"
                      name="contact-name"
                      id="contact-name"
                      type="text"
                      v-model="formData.name"
                      required
                    />
                    <div class="invalid-feedback">Veuillez renseigner votre nom.</div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="contact-phone">Numéro de téléphone</label>
                    <input
                      class="form-control"
                      name="contact-phone"
                      id="contact-phone"
                      type="text"
                      v-model="formData.phone"
                    />
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="contact-email">Email</label>
                    <input
                      class="form-control form-control-sm"
                      id="contact-email"
                      name="contact-email"
                      type="email"
                      v-model="formData.email"
                      required
                    />
                    <div class="invalid-feedback">Veuillez renseigner une adresse email valide.</div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="subject">Sujet</label>
                    <input
                      class="form-control form-control-sm"
                      id="subject"
                      name="subject"
                      type="text"
                      v-model="formData.subject"
                      required
                    />
                    <div class="invalid-feedback">Veuillez renseigner un sujet.</div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="contact-message">Votre message</label>
                    <textarea
                      class="form-control"
                      name="contact-message"
                      id="contact-message"
                      cols="30"
                      rows="10"
                      v-model="formData.message"
                      required
                    ></textarea>
                    <div class="invalid-feedback">Veuillez écrire un message.</div>
                  </div>
                </div>

                <div class="col-lg-12 mb-5 mt-2">
                  <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                  <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>
                </div>
                <div class="col-lg-12">
                  <button
                    name="submit"
                    type="submit"
                    id="submit"
                    class="rn-btn"
                    :disabled="isSubmitting"
                  >
                    <span>{{ isSubmitting ? 'Envoi...' : 'ENVOYER' }}</span>
                  </button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

const socials = [
  { id: 1, icon: "github", link: "https://github.com/J-Cupani", label: 'Accéder à Github' },
  { id: 2, icon: "twitter", link: "https://x.com/C4dev_fr", label: 'Accéder à Twitter' },
  { id: 3, icon: "linkedin", link: "https://www.linkedin.com/in/joachim-cupani", label: 'Accéder à Linkedin' }
]

// Variables pour les données du formulaire
const formData = ref({
  name: "",
  phone: "",
  email: "",
  subject: "",
  message: "",
})

// États du formulaire
const isSubmitting = ref(false)
const successMessage = ref('')
const errorMessage = ref('')
const handleSubmit = async (event) => {
  // Validation HTML5
  const form = event.target
  if (!form.checkValidity()) {
    event.preventDefault()
    event.stopPropagation()
    form.classList.add('was-validated')
    return
  }

  isSubmitting.value = true
  successMessage.value = ''
  errorMessage.value = ''

  try {
    const { csrfToken } = await $fetch('/api/public/csrf')

    const response = await $fetch('/api/public/send-mail', {
      method: 'POST',
      headers: {
        'X-CSRF-Token': csrfToken, // Ajouter le token dans l'en-tête
      },
      body: { ...formData.value },
    })

    if (response.success) {
      successMessage.value = 'Votre message a été envoyé avec succès.'
      formData.value = { name: '', phone: '', email: '', subject: '', message: '' }
      form.classList.remove('was-validated')
    }
  } catch (error) {
    // Mettre à jour le message d'erreur à afficher
    errorMessage.value =
      error.response?.data?.message ||
      'Une erreur est survenue lors de l\'envoi du formulaire. Vous pouvez me contacter directement à l\'adresse : contact@c4dev.fr.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.thumbnail {
  margin-bottom: 28px;
  overflow: hidden;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  img {

    width: 75%;
    height: auto;
    transition: var(--transition);
  }
}

.color-blue {
  color: var(--color-primary) !important;
}

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border: 0;
}

   /* Optionnel : Ajouter des styles pour les messages */
 .alert {
   padding: 1rem;
   margin-top: 1rem;
   border-radius: 0.25rem;
 }

.alert-success {
  color: #56d373; /* Couleur verte pour le texte */
  border: 1px solid #56d373; /* Bordure verte */
  background-color: transparent; /* Pas de fond */
  padding: 10px; /* Optionnel : Ajoute un peu d'espace autour du texte */
  border-radius: 6px; /* Optionnel : Arrondit les coins */
  font-size: 14px; /* Optionnel : Ajuste la taille du texte */
}

.alert-danger {
  color: #ff4c60;
  border: 1px solid #ff4c60; /* Bordure verte */
  background-color: transparent; /* Pas de fond */
  padding: 10px; /* Optionnel : Ajoute un peu d'espace autour du texte */
  border-radius: 6px; /* Optionnel : Arrondit les coins */
  font-size: 14px; /* Optionnel : Ajuste la taille du texte */
}
</style>
