<script setup>
import DialogCloseBtn from '@/components/DialogCloseBtnComponent.vue'
import FileUploadComponent from '@/components/FileUploadComponent.vue'
import { useNotificationStore } from '@/stores/notification'
import { requiredValidator } from '@/utils/validators'
import { useDisplay } from 'vuetify'
import { objectToFormData } from '@/utils/helper'

const dialogVisible = ref(false)

const { smAndDown } = useDisplay()
const { start, finish } = useLoadingIndicator()
const notificationStore = useNotificationStore()

const refVForm = ref()
const fileWarning = ref(false)

const project = ref(null)

const tagList = [
  { label: "Site internet", value: "website" },
  { label: "Application Web", value: "webapp" },
  { label: "API", value: "api" },
]

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
      title: '',
      tag: null,
      description: '',
      active: false,
      file: null,
    })
  },
})

// Méthode de soumission
const upsert = async () => {
  start()

  try {
    const { valid } = await refVForm.value.validate()
    if (valid) {
      const formData = objectToFormData(project.value)

      const response = await $fetch('/api/project/upsert', {
        method: 'POST',
        body: formData
      })

      if (response.success) {
        closeDialog()
        if (project.token === '') {
          notificationStore.openSnackSuccess('Projet crée avec succès')
        } else {
          notificationStore.openSnackSuccess('Projet mis à jour avec succès')
        }

        emit('upsert', response.project)
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

const openDialog = () => { dialogVisible.value = true }

const closeDialog = () => { dialogVisible.value = false }

watch(dialogVisible, (newVal) => {
  if (newVal) {
    project.value = Object.assign({}, props.item)
  }
})

onMounted(() => {
  project.value = Object.assign({}, props.item)
})

defineExpose({ openDialog })
</script>

<template>
  <VBtn
    v-if="project?.token!=='' && !props.hideButton && !smAndDown"
    icon="tabler-edit"
    variant="tonal"
    size="small"
    @click="openDialog"
  />
  <VBtn
    v-if="project?.token!=='' && !props.hideButton && smAndDown"
    variant="text"
    prepend-icon="tabler-edit"
    class="w-100 justify-start"
    @click.stop="openDialog"
  >
    Editer projet
  </VBtn>

  <VDialog v-model="dialogVisible" max-width="850">
    <DialogCloseBtn @click="closeDialog" />

    <VCard :title="project?.token !== '' ? 'Editer une fiche projet' : 'Ajouter un nouveau projet'">
      <VForm
        ref="refVForm"
        @submit.prevent="upsert"
      >
        <VCardText class="pt-4">
          <VRow>
            <VCol cols="12">
              <FileUploadComponent
                v-model:file="project.file"
                v-model:mandatory="fileWarning"
                :max-size="8"
            />
            </VCol>
          </VRow>
          <VRow class="d-flex justify-space-between">
            <VCol cols="12">
              <VTextField
                v-model="project.title"
                :rules="[requiredValidator]"
                label="Nom du projet"
              />
            </VCol>
            <VCol
              cols="12"
              md="9"
            >
              <VSelect
                v-model="project.tag"
                :items="tagList"
                label="Choisir un type de projet"
                item-title="label"
                item-value="value"
                :rules="[requiredValidator]"
              >
              </VSelect>
            </VCol>
            <VCol cols="12" md="3" class="d-flex justify-center">
              <VSwitch
                v-model="project.active"
              >
                <template #label>
                  Projet Actif
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
                    <span>Permets de désactiver un projet.</span>
                  </VTooltip>
                </template>
              </VSwitch>
            </VCol>
          </VRow>
          <VRow>
            <VCol cols="12">
              <VTextarea
                v-model="project.description"
                label="Votre message"
                placeholder="Entrez votre texte ici..."
                rows="7"
                outlined
                clearable
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

<style>
.v-list .v-list-item {
  padding: 0 4px !important;
}
</style>
