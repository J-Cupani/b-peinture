// import { editPref } from "@/services/UserService"
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', () => {

  const isConnected = ref(false)
  const email = ref('')
  const firstName = ref('')
  const lastName = ref('')
  const image = ref('')
  const role = ref('')
  const roleLabel = ref('')
  const roles = ref('')
  const token = ref('')
  const file = ref(null)
  // const menu_rail = ref(false)
  const fullName = computed(() => {
    return firstName.value + ' ' + lastName.value
  })

  const updateUser = (data) => {
    email.value = data.email
    firstName.value = data.firstName
    lastName.value = data.lastName
    image.value = data.image
    role.value = data.role
    roleLabel.value = data.roleLabel
    roles.value = data.roles
    token.value = data.token
    file.value = data.file
    // menu_rail.value = data.menu_rail
    if (data.token) {
      isConnected.value = true
    }
  }

  const getUser = () => {
    return {
      isConnected: isConnected.value,
      email: email.value,
      firstName: firstName.value,
      lastName: lastName.value,
      image: image.value,
      role: role.value,
      roleLabel: roleLabel.value,
      roles: roles.value,
      token: token.value,
      file: file.value,
      active: true
    }
  }

  // const updatePref = (data) => {
  //   editPref(token.value, data).then(r => {
  //     menu_rail.value = data.menu_rail
  //   })
  // }

  const destroySession = () => {
    isConnected.value = false
    email.value = ''
    firstName.value = ''
    lastName.value = ''
    image.value = ''
    role.value = ''
    roleLabel.value = ''
    token.value = ''
    roles.value = ''
    file.value = null
    // menu_rail.value = ''
  }

  const isAdmin = () => {
    return role.value === 'ROLE_SUPER_ADMIN'
  }

  return {
    isConnected,
    email,
    firstName,
    lastName,
    image,
    role,
    roleLabel,
    token,
    fullName,
    file,
    // menu_rail,
    updateUser,
    getUser,
    // updatePref,
    isAdmin,
    destroySession,
  }
}, {
  persist: true // Active la persistance des données
})