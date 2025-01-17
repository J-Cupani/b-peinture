<script setup>
import { useActionToolbarStore } from '@/stores/actionToolbar'
import { useNotificationStore } from '@/stores/notification'
import AddProjectDialog from '@/views/project/dialogs/AddProjectDialog.vue'
import DeleteButtonDialogComponent from "@/components/DeleteButtonDialogComponent.vue"
import { useDisplay } from 'vuetify'
import {objectToFormData} from "@/utils/helper.js";

definePageMeta({
  middleware: 'auth'
})

const { start, finish } = useLoadingIndicator()
const isLoading = ref(true)
const { smAndDown, lgAndDown, mobile } = useDisplay()

const actionToolbarStore = useActionToolbarStore()
const notificationStore = useNotificationStore()

const newItem = ref()
const projects = ref([])

const headers = [
  {
    title: 'Nom du projet',
    align: 'start',
    sortable: true,
    key: 'title',
    width: lgAndDown ? '50%' : '80%',
    mobile: true,
  },
  {
    title: 'Actif',
    key: 'active',
    align: 'start',
    sortable: false,
    width: lgAndDown ? '10%' : '10%',
    mobile: false,
  },
  {
    title: 'Tag',
    key: 'tag',
    align: 'center',
    sortable: true,
    width: lgAndDown ? '20%' : '10%',
    mobile: false,
  },
  {
    title: 'Actions',
    key: 'actions',
    align: 'end',
    sortable: false,
    width: lgAndDown ? '20%' : '10%',
    mobile: true,
  },
]

const visibleHeaders = computed(() => {
  return smAndDown.value ? headers.filter(header => header.mobile) : headers
})

const refreshProject = (item) => {
  Object.assign(projects.value.find(c => c.token === item.token), item)
}

const updateProject = async (user) => {
  start()
  try {
    const formData = objectToFormData(user)

    const response = await $fetch('/api/project/upsert', {
      method: 'POST',
      body: formData
    })
    if (response.success) {
      notificationStore.openSnackSuccess('Projet mis à jour avec succès')
    } else {
      if (Array.isArray(response.messages)) {
        response.messages.forEach((message) => {
          notificationStore.errorMessage(message)
        })
      } else {
        notificationStore.errorMessage(response.messages)
      }
    }
  } catch (error) {
    notificationStore.errorMessage('Erreur de connexion avec le serveur. Veuillez contacter l\'administrateur')
  } finally {
    finish()
  }
}

const insertProject = (item) => {
  projects.value.push(item)
}

const deleteUserQuestion = async (item) => {
  start()
  try {
    const token = item.token
    const response = await $fetch('/api/project/delete', {
      method: 'DELETE',
      params: { token }, // Ajoute les paramètres de requête
    })

    if (response.success) {
      projects.value = projects.value.filter(e => e.token !== item.token)
      notificationStore.openSnackSuccess("Projet supprimé")
    } else {
      notificationStore.errorMessage('Erreur lors de la suppression du projet, Veuillez contactez l\'administrateur')
    }
  } catch (error) {
    notificationStore.errorMessage('Erreur de connexion avec le serveur. Veuillez contacter l\'administrateur')
  } finally {
    finish()
  }
}

const getTagColor = (tag) => {
  switch (tag) {
    case 'webapp':
      return 'info' // Couleur pour webapp
    case 'website':
      return 'primary' // Couleur pour website
    case 'api':
      return 'warning' // Couleur pour api
    default:
      return 'grey lighten-1' // Couleur par défaut
  }
}

const getTagLabel = (tag) => {
  switch (tag) {
    case 'webapp':
      return 'Application Web'
    case 'website':
      return 'Site Internet'
    case 'api':
      return 'API'
    default:
      return 'Inconnu'
  }
}

actionToolbarStore.$subscribe((mutation, state) => {
  if (state.newAction) {
    actionToolbarStore.$patch({newAction: false})
    newItem.value.openDialog()
  }
})

onMounted(async () => {
  actionToolbarStore.showNewButton = true

  start()
  try {
    const response = await $fetch('/api/project/get-projects', {
      method: 'GET',
    })

    if (response.success) {
      projects.value = response.projects
    } else {
      notificationStore.errorMessage(response.messages)
    }
  } catch (error) {
    notificationStore.errorMessage('Erreur de connexion avec le serveur. Veuillez contacter l\'administrateur')
  } finally {
    isLoading.value = false // Le chargement est terminé

    finish()
  }
})
</script>

<template>
  <div>
    <AddProjectDialog
      ref="newItem"
      @upsert="insertProject"
    />

    <VCard>
      <VCardText>
        <VCardTitle>
          Liste des projets
        </VCardTitle>
        <VDataTable
          :headers="visibleHeaders"
          :items="projects"
          :sort-by="[{ key: 'title', order: 'asc' }]"
        >
          <!-- Tag avec VChip -->
          <template #item.tag="{ item }">
            <VChip
              :color="getTagColor(item.tag)"
              class="ma-1"
              text
            >
              {{ getTagLabel(item.tag) }}
            </VChip>
          </template>

          <!-- 🟢 Active -->
          <template #item.active="{ item }">
            <VSwitch
              v-model="item.active"
              @update:model-value="updateProject(item)"
            />
          </template>

          <!-- 🎮 Actions -->
          <template #item.actions="{ item }">
            <div v-if="smAndDown">
              <VMenu left>
                <template #activator="{ props }">
                  <VBtn
                    size="small"
                    color="secondary"
                    variant="tonal"
                    icon="tabler-dots-vertical"
                    v-bind="props"
                  />
                </template>

                <VList>
                  <VListItem>
                    <AddProjectDialog
                      :item="item"
                      @upsert="refreshProject"
                    />
                  </VListItem>
                  <VListItem>
                    <DeleteButtonDialogComponent
                      text="Vous êtes sur le point de supprimer cet utilisateur."
                      title="Suppression de l'utilisateur"
                      text-tooltip="Supprimer le projet"
                      :ml="'ml-0'"
                      :with-label="true"
                      @confirm="deleteUserQuestion(item)"
                    />
                  </VListItem>
                </VList>
              </VMenu>
            </div>
            <div v-else>
              <AddProjectDialog
                :item="item"
                @upsert="refreshProject"
              />
              <DeleteButtonDialogComponent
                text="Vous êtes sur le point de supprimer ce projet."
                title="Suppression du projet"
                :text-tooltip="'Supprimer le projet'"
                :ml="'ml-2'"
                @confirm="deleteUserQuestion(item)"
              />
            </div>
          </template>


          <!-- 📛 No Data -->
          <template #no-data v-if="!isLoading">
            <VBtn
              color="primary"
              @click="newItem.openDialog()"
            >
              <VIcon
                size="26"
                icon="tabler-square-rounded-plus"
                class="mr-2"
              />
              Ajouter un nouveau projet
            </VBtn>
          </template>
        </VDataTable>
      </VCardText>
    </VCard>
  </div>
</template>
