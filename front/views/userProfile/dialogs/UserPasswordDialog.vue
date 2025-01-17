<script setup>
import DialogCloseBtn from '@/components/DialogCloseBtnComponent.vue'
import { useNotificationStore } from '@/stores/notification'
import { useUserStore } from '@/stores/user'
import { requiredValidator, passwordValidator, confirmedValidator } from '@/utils/validators'

const dialogVisible = ref(false)

const { start, finish } = useLoadingIndicator()
const notificationStore = useNotificationStore()
const userStore = useUserStore()

const { token } = storeToRefs(userStore)

const refVForm = ref(null)
const isNewPasswordVisible = ref(false)
const isConfirmPasswordVisible = ref(false)

const password = ref({
  newPassword: '',
  confirmPassword: ''
})

// Méthode de sauvegarde du mot de passe
const submit = async () => {
  start()
  const { valid } = await refVForm.value.validate()

  if (valid) {
    try {
      const response = await $fetch('/api/user/edit-password', {
        method: 'POST',
        body: {
          password: password.value.newPassword,
          token: token.value
        },
      })

      if (response.success) {
        notificationStore.openSnackSuccess(response.message)
        closeDialog()
      } else {
        notificationStore.errorMessage(response.message)
      }
    } catch (error) {
      notificationStore.errorMessage('Erreur de connexion avec le serveur. Veuillez contacter l\'administrateur')
    } finally {
      finish()
    }
  }
}

const openDialog = () => {
  dialogVisible.value = true
  notificationStore.setInDialog(true)

}

const closeDialog = () => {
  dialogVisible.value = false
  notificationStore.setInDialog(false)
}

defineExpose({
  openDialog
})
</script>

<template>
  <VDialog v-model="dialogVisible" max-width="850">
    <DialogCloseBtn @click="closeDialog" />

    <VCard title="Edition mot de passe">
      <VForm
        ref="refVForm"
        @submit.prevent="submit"
        validate-on="submit lazy"
      >
        <VCardText class="pt-4">
          <VAlert
            class="mb-4"
            color="warning"
            variant="tonal"
            density="compact"
          >
            <VAlertTitle class="mb-1">
              Merci de respecter les consignes suivantes
            </VAlertTitle>
            <span class="span-alert">Minimum de 8 caractères, majuscule & symbole</span>
          </VAlert>


            <VRow>
              <VCol cols="12" md="6">
                <VTextField
                  v-model="password.newPassword"
                  :append-inner-icon="isNewPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  :type="isNewPasswordVisible ? 'text' : 'password'"
                  :rules="[requiredValidator, passwordValidator]"
                  label="Nouveau mot de passe"
                  @click:append-inner="isNewPasswordVisible = !isNewPasswordVisible"
                />
              </VCol>
              <VCol cols="12" md="6">
                <VTextField
                  v-model="password.confirmPassword"
                  :append-inner-icon="isConfirmPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  :type="isConfirmPasswordVisible ? 'text' : 'password'"
                  :rules="[requiredValidator, confirmedValidator(password.confirmPassword, password.newPassword)]"
                  label="Confirmation du mot de passe"
                  @click:append-inner="isConfirmPasswordVisible = !isConfirmPasswordVisible"
                />
              </VCol>
            </VRow>
        </VCardText>

        <VCardText class="d-flex justify-end gap-3 flex-wrap">
          <VBtn
            color="secondary"
            variant="tonal"
            @click="closeDialog"
          >
            Annuler
          </VBtn>
          <VBtn
            class="ml-2"
            color="primary"
            type="submit"
          >
            Enregistrer
          </VBtn>
        </VCardText>
      </VForm>
    </VCard>
  </VDialog>
</template>

<style scoped>
.v-alert-title{
  font-size: 1rem !important;
}
.span-alert{
  font-size: 0.8rem !important;
}
</style>
