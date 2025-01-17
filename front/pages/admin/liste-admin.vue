<script setup>
import { useActionToolbarStore } from '@/stores/actionToolbar'
import { useNotificationStore } from '@/stores/notification'
import UserAdminFormDialog from '@/views/userProfile/dialogs/UserProfileDialog.vue'
import AvatarNameComponent from '@/components/AvatarNameComponent.vue'
import DeleteButtonDialogComponent from '@/components/DeleteButtonDialogComponent.vue'
import { useDisplay } from 'vuetify'
import { objectToFormData } from '@/utils/helper'

definePageMeta({
  middleware: 'auth'
})

const { start, finish } = useLoadingIndicator()
const { smAndDown, lgAndDown } = useDisplay()

const actionToolbarStore = useActionToolbarStore()
const notificationStore = useNotificationStore()

const headers = [
  {
    title: 'Nom complet',
    align: 'start',
    sortable: true,
    key: 'fullName',
    width: lgAndDown ? '70%' : '80%',
  },
  {
    title: 'Actif',
    key: 'active',
    align: 'start',
    sortable: false,
    width: lgAndDown ? '10%' : '10%',
  },
  {
    title: 'Actions',
    key: 'actions',
    align: 'end',
    sortable: false,
    width: lgAndDown ? '20%' : '10%',
  },
]

const newItem = ref()
const users = ref([])

const refreshUser = (user) => {
  Object.assign(users.value.find(c => c.token === user.token), user)
}

const updateUser = async (user) => {
  start()
  try {
    const formData = objectToFormData(user)

    const response = await $fetch('/api/user/upsert', {
      method: 'POST',
      body: formData
    })
    if (response.success) {
      notificationStore.openSnackSuccess('Utilisateur mis à jour avec succès')
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

const insertUser = (user) => {
  users.value.push(user)
}

const deleteUserQuestion = async (user) => {
  start()
  try {
    const token = user.token
    const response = await $fetch('/api/user/delete', {
      method: 'DELETE',
      params: { token }, // Ajoute les paramètres de requête
    })

    if (response.success) {
      users.value = users.value.filter(e => e.token !== user.token)
      notificationStore.openSnackSuccess("Utilisateur supprimée")
    } else {
      notificationStore.errorMessage('Erreur lors de la suppression de l\'utilisateur, Veuillez contactez l\'administrateur')
    }
  } catch (error) {
    notificationStore.errorMessage('Erreur de connexion avec le serveur. Veuillez contacter l\'administrateur')
  } finally {
    finish()
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
    const response = await $fetch('/api/user/get-users', {
      method: 'GET',
    })

    if (response.success) {
      users.value = response.users
    } else {
      notificationStore.errorMessage(response.messages)
    }
  } catch (error) {
    notificationStore.errorMessage('Erreur de connexion avec le serveur. Veuillez contacter l\'administrateur')
  } finally {
    finish()
  }
})
</script>

<template>
  <div>
    <UserAdminFormDialog
      ref="newItem"
      @upsert="insertUser"
    />

    <VCard>
      <VCardText>
        <VCardTitle>
          Liste Administrateurs
        </VCardTitle>
        <VDataTable
          :headers="headers"
          :items="users"
          :sort-by="[{ key: 'fullName', order: 'asc' }]"
        >
          <template #item.fullName="{ item }">
            <AvatarNameComponent :item="item" />
          </template>

          <!-- 🟢 Active -->
          <template #item.active="{ item }">
            <VSwitch
              v-model="item.active"
              @update:model-value="updateUser(item)"
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
                    <UserAdminFormDialog
                      :item="item"
                      @upsert="refreshUser"
                    />
                  </VListItem>
                  <VListItem>
                    <DeleteButtonDialogComponent
                      text="Vous êtes sur le point de supprimer cet utilisateur."
                      title="Suppression de l'utilisateur"
                      :text-tooltip="'Supprimer l\'utilisateur'"
                      :ml="'ml-0'"
                      :with-label="true"
                      @confirm="deleteUserQuestion(item)"
                    />
                  </VListItem>
                </VList>
              </VMenu>
            </div>
            <div v-else>
              <UserAdminFormDialog
                :item="item"
                @upsert="refreshUser"
              />
              <DeleteButtonDialogComponent
                text="Vous êtes sur le point de supprimer cet utilisateur."
                title="Suppression de l'utilisateur"
                :text-tooltip="'Supprimer l\'utilisateur'"
                :ml="'ml-2'"
                @confirm="deleteUserQuestion(item)"
              />
            </div>
          </template>


          <!-- 📛 No Data -->
          <template #no-data>
            <VBtn
              color="primary"
              @click="newItem.openDialog()"
            >
              <VIcon
                size="26"
                icon="tabler-square-rounded-plus"
                class="mr-2"
              />
              Ajouter un super admin
            </VBtn>
          </template>
        </VDataTable>
      </VCardText>
    </VCard>
  </div>
</template>
