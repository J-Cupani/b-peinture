<script setup>
import avatar1 from '@images/avatars/avatar-1.png'
import UserPasswordDialog from '@/views/userProfile/dialogs/UserPasswordDialog.vue'
import UserProfileDialog from '@/views/userProfile/dialogs/UserProfileDialog.vue'
import { useUserStore } from '@/stores/user'
import { getInitials } from '@/utils/helper.js'

const userStore = useUserStore()
const passwordDialog = ref()
const profileDialog = ref()

const { fullName, roleLabel } = storeToRefs(userStore)

const openPasswordDialog = () => {
  passwordDialog.value.openDialog()
}

const openProfileDialog = () => {
  profileDialog.value.openDialog()
}

const logout = async () => {
  try {
    await $fetch('/api/auth/logout', {
      method: 'GET',
    })

    userStore.destroySession()
    return navigateTo('/login')
  } catch (error) {
    console.error('Erreur lors de la vérification du token:', error)
    return navigateTo('/login')
  }}
</script>

<template>
  <VBadge
    dot
    location="bottom right"
    offset-x="3"
    offset-y="3"
    bordered
    color="success"
  >
    <VAvatar class="cursor-pointer">
      <VImg
        :src="userStore.image"
        v-if="userStore && userStore.image"
      />
      <template v-else>
        <span>{{ getInitials(fullName) }}</span>
      </template>

      <!-- SECTION Menu -->
      <VMenu
        activator="parent"
        width="230"
        location="bottom end"
        offset="14px"
      >
        <VList>
          <!-- 👉 User Avatar & Name -->
          <VListItem>
            <template #prepend>
              <VListItemAction start>
                <VBadge
                  dot
                  location="bottom right"
                  offset-x="3"
                  offset-y="3"
                  color="success"
                >
                  <VAvatar>
                    <VImg
                      :src="userStore.image"
                      v-if="userStore && userStore.image"
                    />
                    <template v-else>
                      <span>{{ getInitials(fullName) }}</span>
                    </template>
                  </VAvatar>
                </VBadge>
              </VListItemAction>
            </template>

            <VListItemTitle class="font-weight-semibold">
              {{ fullName }}
            </VListItemTitle>
            <VListItemSubtitle>{{ roleLabel === 'Super Admin' ? 'Administrateur' : roleLabel}}</VListItemSubtitle>
          </VListItem>

          <VDivider class="my-2" />

          <VListItem :to="'/admin'">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-home"
                size="22"
              />
            </template>

            <VListItemTitle>Accueil</VListItemTitle>
          </VListItem>

          <!-- 👉 Profile -->
          <VListItem @click="openProfileDialog">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-user"
                size="22"
              />
            </template>
            <VListItemTitle>Profil</VListItemTitle>
          </VListItem>

          <!-- Changer de mot de passe -->
          <VListItem @click="openPasswordDialog">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-key"
                size="22"
              />
            </template>
            <VListItemTitle>Mot de passe</VListItemTitle>
          </VListItem>

          <VDivider class="my-2" />

          <!-- Déconnexion -->
          <VListItem @click="logout">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-logout"
                size="22"
              />
            </template>
            <VListItemTitle>Déconnexion</VListItemTitle>
          </VListItem>
        </VList>
      </VMenu>
    </VAvatar>
  </VBadge>

  <!-- Dialogues pour Profil et Mot de passe -->
  <UserPasswordDialog ref="passwordDialog" />
  <UserProfileDialog
    ref="profileDialog"
    :item="userStore.getUser()"
    :hideButton=true
  />
</template>
