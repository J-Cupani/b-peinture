<script setup>
import { useGenerateImageVariant } from '@core/composable/useGenerateImageVariant'
import { VNodeRenderer } from '@layouts/components/VNodeRenderer'
import { themeConfig } from '@themeConfig'
import authV2ResetPasswordIllustrationDark from '@images/pages/auth-v2-reset-password-illustration-dark.png'
import authV2ResetPasswordIllustrationLight from '@images/pages/auth-v2-reset-password-illustration-light.png'
import authV2MaskDark from '@images/pages/misc-mask-dark.png'
import authV2MaskLight from '@images/pages/misc-mask-light.png'
import { useRoute } from '#app'
import { useNotificationStore } from "@/stores/notification"
import { requiredValidator, passwordValidator, confirmedValidator} from '@/utils/validators'

definePageMeta({
  layout: 'blank',
  public: true,
})

const authThemeImg = useGenerateImageVariant(authV2ResetPasswordIllustrationLight, authV2ResetPasswordIllustrationDark)
const authThemeMask = useGenerateImageVariant(authV2MaskLight, authV2MaskDark)

const { start, finish } = useLoadingIndicator()
const notificationStore = useNotificationStore()
const refVForm = ref()
const route = useRoute()
const email = ref()
const userToken = ref()

const password = ref({
  newPassword: '',
  confirmPassword: ''
})

const isPasswordVisible = ref(false)
const isConfirmPasswordVisible = ref(false)

const onSubmit = async () => {
  start()
  const { valid } = await refVForm.value.validate()

  if (valid) {
    try {
      const response = await $fetch('/api/auth/reset-password', {
        method: 'POST',
        body: {
          userToken: userToken.value,           // Le token de l'utilisateur
          password: password.value.newPassword, // Le nouveau mot de passe
          resetToken: route.params.resetToken,  // Le token de réinitialisation
        },
      })

      if (response.success) {
        notificationStore.openSnackSuccess(response.message)

        navigateTo({ path: '/login' })
      } else {
        // Gérer les erreurs de réponse
        notificationStore.errorMessage(response.message)
      }
    } catch (error) {
      // Gérer les erreurs de requête
      notificationStore.errorMessage(error.message)
    } finally {
      finish()
    }
  }
}

onBeforeMount(async () => {
  try {
    const response = await $fetch('/api/auth/verif-password-token', {
      method: 'POST',
      body: {
        token: route.params.resetToken
      },
    })

    if (response.success) {
      email.value = response.user.email
      userToken.value = response.user.token
    } else {
      notificationStore.errorMessage(response.message)
      navigateTo({ path: '/login' })
    }
  } catch (error) {
    notificationStore.errorMessage(error.message)
    navigateTo({ path: '/login' })
  }
})
</script>

<template>
  <NuxtLink to="/login">
    <div class="auth-logo d-flex align-center gap-x-3">
      <VNodeRenderer :nodes="themeConfig.app.logo" />
      <h1 class="auth-title">
        {{ themeConfig.app.title }}
      </h1>
    </div>
  </NuxtLink>

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
          style="padding-inline: 150px;"
        >
          <VImg
            max-width="451"
            :src="authThemeImg"
            class="auth-illustration mt-16 mb-2"
          />
        </div>

        <img
          class="auth-footer-mask flip-in-rtl"
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
        class="mt-12 mt-sm-0 pa-6"
      >
        <VCardText>
          <h4 class="text-h4 mb-1">
            Nouveau mot de passe 🔒
          </h4>
          <p class="mb-5">
            pour {{ email }}
          </p>
          <VAlert
            variant="tonal"
            color="primary"
            class="mb-4"
          >
            <VAlertTitle class="mb-1 text-caption font-weight-bold">
              Merci de respecter les consignes suivantes
            </VAlertTitle>
            <span class="text-caption ">Minimum de 8 caractères, majuscule & symbole</span>
          </VAlert>
        </VCardText>

        <VCardText>
          <VForm
            ref="refVForm"
            @submit.prevent="onSubmit"
            validate-on="submit lazy"
          >
            <VRow>
              <!-- password -->
              <VCol cols="12">
                <AppTextField
                  v-model="password.newPassword"
                  autofocus
                  label="Nouveau mot de passe"
                  placeholder="············"
                  :type="isPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible"
                  :rules="[requiredValidator, passwordValidator]"
                />
              </VCol>

              <!-- Confirm Password -->
              <VCol cols="12">
                <AppTextField
                  v-model="password.confirmPassword"
                  label="Confirmation du nouveau mot de passe"
                  placeholder="············"
                  :type="isConfirmPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isConfirmPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  @click:append-inner="isConfirmPasswordVisible = !isConfirmPasswordVisible"
                  :rules="[requiredValidator, confirmedValidator(password.confirmPassword, password.newPassword)]"
                />
              </VCol>

              <!-- Set password -->
              <VCol cols="12">
                <VBtn
                  block
                  type="submit"
                >
                  Définir le mot de passe
                </VBtn>
              </VCol>

              <!-- back to login -->
              <VCol cols="12">
                <NuxtLink
                  class="d-flex align-center justify-center"
                  :to="{ name: 'login' }"
                >
                  <VIcon
                    icon="tabler-chevron-left"
                    size="20"
                    class="me-1 flip-in-rtl"
                  />
                  <span>Retour à la page de connexion</span>
                </NuxtLink>
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
