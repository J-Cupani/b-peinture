<script setup>
import { useGenerateImageVariant } from '@core/composable/useGenerateImageVariant.js'
import authV2LoginIllustrationBorderedDark from '@images/pages/auth-v2-login-illustration-bordered-dark.png'
import authV2LoginIllustrationBorderedLight from '@images/pages/auth-v2-login-illustration-bordered-light.png'
import authV2LoginIllustrationDark from '@images/pages/auth-v2-login-illustration-dark.png'
import authV2LoginIllustrationLight from '@images/pages/auth-v2-login-illustration-light.png'
import authV2MaskDark from '@images/pages/misc-mask-dark.png'
import authV2MaskLight from '@images/pages/misc-mask-light.png'
import { VNodeRenderer } from '@layouts/components/VNodeRenderer.jsx'
import { themeConfig } from '@themeConfig'
import { useUserStore } from "@/stores/user"
import { useNotificationStore } from '@/stores/notification'
import { requiredValidator, emailValidator } from '@/utils/validators'

definePageMeta({
  layout: 'blank',
  public: true,
})

const authThemeImg = useGenerateImageVariant(authV2LoginIllustrationLight, authV2LoginIllustrationDark, authV2LoginIllustrationBorderedLight, authV2LoginIllustrationBorderedDark, true)
const authThemeMask = useGenerateImageVariant(authV2MaskLight, authV2MaskDark)

const { start, finish } = useLoadingIndicator()
const notificationStore = useNotificationStore()
const userStore = useUserStore()

const refVForm = ref()
const isPasswordVisible = ref(false)
const router = useRouter()
const errorMessage = ref('')

const credentials = ref({
  username: '',
  password: '',
})

const login = async () => {
  start()
  const { valid } = await refVForm.value.validate()

  if (valid) {
    try {
      // Appel à l'API de connexion via le serveur Nuxt
      const response = await $fetch('/api/auth/login', {
        method: 'POST',
        body: {
          username: credentials.value.username,
          password: credentials.value.password,
        },
      })

      if (response.success) {
        notificationStore.openSnackSuccess("Vous êtes bien connecté")

        userStore.updateUser(response.user)

        navigateTo({ path: '/admin' })
      } else {
        notificationStore.errorMessage(response.message)
      }
    } catch (error) {
      notificationStore.errorMessage("Une erreur est survenue. Veuillez contacter l’administrateur.")
    } finally {
      finish()
    }
  }
}
</script>

<template>
  <div class="auth-logo d-flex align-center gap-x-3">
    <VNodeRenderer :nodes="themeConfig.app.logo" />
    <h1 class="auth-title">
      {{ themeConfig.app.title }}
    </h1>
  </div>

  <VRow
    no-gutters
    class="auth-wrapper bg-surface"
  >
    <VCol
      md="8"
      class="d-none d-md-flex"
    >
      <div class="position-relative bg-background w-100 me-0">
        <div
          class="d-flex align-center justify-center w-100 h-100"
          style="padding-inline: 6.25rem;"
        >
          <VImg
            max-width="613"
            :src="authThemeImg"
            class="auth-illustration mt-16 mb-2"
          />
        </div>

        <img
          class="auth-footer-mask"
          :src="authThemeMask"
          alt="auth-footer-mask"
          height="280"
          width="100"
        >
      </div>
    </VCol>

    <VCol
      cols="12"
      md="4"
      class="auth-card-v2 d-flex align-center justify-center"
    >
      <VCard
        flat
        :max-width="500"
        class="mt-12 mt-sm-0 pa-6 w-100"
      >
        <VCardText>
          <h4 class="text-h4 mb-1">
            Bienvenue 👋🏻
          </h4>
          <p class="mb-0">
            Connectez-vous à votre compte
          </p>
        </VCardText>
        <VCardText>
          <VForm
            ref="refVForm"
            @submit.prevent="login"
            validate-on="submit lazy"
          >
            <VRow>
              <!-- email -->
              <VCol cols="12">
                <AppTextField
                  v-model="credentials.username"
                  autofocus
                  label="Email"
                  type="email"
                  placeholder="johndoe@email.com"
                  autocomplete="email"
                  :rules="[requiredValidator, emailValidator]"
                />
              </VCol>

              <!-- password -->
              <VCol cols="12">
                <AppTextField
                  v-model="credentials.password"
                  label="Mot de passe"
                  placeholder="············"
                  :type="isPasswordVisible ? 'text' : 'password'"
                  autocomplete="current-password"
                  :append-inner-icon="isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible"
                  :rules="[requiredValidator]"
                />

                <div class="d-flex align-center flex-wrap justify-space-between mt-2 mb-4">
                  <NuxtLink
                    class="text-primary ms-2 mb-1"
                    to="/mot-de-passe-oublie"
                  >
                    Mot de passe oublié ?
                  </NuxtLink>
                </div>

                <VBtn
                  block
                  type="submit"
                >
                  Connexion
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>

<style lang="scss">
@use "@core/scss/template/pages/page-auth.scss";
</style>
