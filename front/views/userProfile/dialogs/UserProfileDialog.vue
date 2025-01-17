<script setup>
import DialogCloseBtn from '@/components/DialogCloseBtnComponent.vue'
import FileUploadComponent from '@/components/FileUploadComponent.vue'
import { useNotificationStore } from '@/stores/notification'
import { useUserStore } from '@/stores/user'
import { requiredValidator, emailValidator } from '@/utils/validators'
import { useDisplay } from 'vuetify'
import { objectToFormData } from '@/utils/helper'

const dialogVisible = ref(false)

const { smAndDown } = useDisplay()
const { start, finish } = useLoadingIndicator()
const notificationStore = useNotificationStore()

const userStore = useUserStore()
const refVForm = ref()
const fileWarning = ref(false)

const user = ref(null)

const { token: userStoreToken } = storeToRefs(userStore)

const emit = defineEmits(['upsert'])
// Définition des props avec des valeurs par défaut
const props = defineProps({
  hideButton: {
    type: Boolean,
    default: false,
  },
  item: {
    type: Object,
    required: false,
    default: () => ({
      token: '',
      name: '',
      firstName: '',
      lastName: '',
      email: '',
      active: false,
      file: null,
    })
  },
})

// Propriété calculée pour vérifier si le token du store est égal à celui des props
const isCurrentUser = computed(() => props.item.token === userStoreToken.value)

// Méthode de soumission
const upsert = async () => {
  start()

  try {
    const { valid } = await refVForm.value.validate()
    if (valid) {
      // Convertit l'objet user.value en FormData pour l'envoyer dans une requête multipart/form-data.
      const formData = objectToFormData(user.value)

      const response = await $fetch('/api/user/upsert', {
        method: 'POST',
        body: formData
      })

      if (response.success) {
        closeDialog()
        if (isCurrentUser.value) {
          userStore.updateUser(response.user)
          notificationStore.openSnackSuccess('Utilisateur mis à jour avec succès')

        } else {
          emit('upsert', response.user)

          notificationStore.openSnackSuccess('Utilisateur crée avec succès')
        }
      } else {
        if (Array.isArray(response.messages)) {
          response.messages.forEach((message) => {
            notificationStore.errorMessage(message)
          })
        } else {
          notificationStore.errorMessage(response.messages)
        }
      }
    }
  } catch (error) {
    notificationStore.errorMessage('Erreur de connexion avec le serveur. Veuillez contacter l\'administrateur')
  } finally {
    finish()
  }
}

// Ouvrir et fermer le dialogue
const openDialog = () => {
  dialogVisible.value = true
  notificationStore.setInDialog(true)
}

const closeDialog = () => {
  dialogVisible.value = false
  notificationStore.setInDialog(false)
}

onMounted(() => {

  user.value = Object.assign({}, props.item)
})

watch(() => props.item, (newVal) => {
  user.value = Object.assign({}, props.item)
}, {deep: true})

watch(dialogVisible, (newVal) => {
  if (newVal) {
    user.value = Object.assign({}, props.item)
  }
})

defineExpose({ openDialog })
</script>

<template>
  <VBtn
    v-if="user?.token!=='' && !props.hideButton && !smAndDown"
    icon="tabler-edit"
    variant="tonal"
    size="small"
    @click="openDialog"
  />
  <VBtn
    v-if="user?.token!=='' && !props.hideButton && smAndDown"
    variant="text"
    prepend-icon="tabler-edit"
    class="w-100 justify-start"
    @click.stop="openDialog"
  >
    Editer l'Utilisateur
  </VBtn>

  <VDialog v-model="dialogVisible" max-width="850">
    <DialogCloseBtn @click="closeDialog" />

    <VCard :title="user?.token !== '' ? 'Edition Fiche Admin' : 'Ajout Super Admin'">
      <VForm
        ref="refVForm"
        @submit.prevent="upsert"
      >
        <VCardText class="pt-4">
          <VRow>
            <VCol cols="12">
              <FileUploadComponent
                v-model:file="user.file"
                v-model:mandatory="fileWarning"
                :max-size="8"
            />
            </VCol>
            <VCol
              v-if="!isCurrentUser && userStore.isAdmin()"
              cols="12"
            >
              <VSwitch
                v-model="user.active"
                class="ml-1"
              >
                <template #label>
                  Utilisateur Actif
                  <VTooltip
                    location="top"
                  >
                    <template #activator="{ props: iconProps }">
                      <VIcon
                        class="ml-1"
                        color="grey-lighten-1"
                        v-bind="iconProps"
                      >
                        tabler-info-circle
                      </VIcon>
                    </template>
                    <span>Permets de désactiver les accès à un utilisateur.</span>
                  </VTooltip>
                </template>
              </VSwitch>
            </VCol>
            <VCol cols="12">
              <VTextField
                v-model="user.email"
                :rules="[requiredValidator, emailValidator]"
                label="Email"
              />
            </VCol>
            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="user.lastName"
                :rules="[requiredValidator]"
                label="Nom"
              />
            </VCol>
            <VCol
              cols="12"
              md="6"
            >
              <VTextField
                v-model="user.firstName"
                :rules="[requiredValidator]"
                label="Prénom"
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
