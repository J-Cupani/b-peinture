export const useNotificationStore = defineStore('notification', () => {
  const isOpen = ref(false)
  const title = ref('')
  const text = ref([])
  const color = ref('primary')
  const isInDialog = ref(false)
  const openSnack = (message, messages) => {
    title.value = message
    text.value = messages
    isOpen.value = true

  }

  const openSnackSuccess = (message, messages = []) => {
    color.value = 'success'
    openSnack(message, messages)
  }

  const openSnackWarning = (message, messages = []) => {
    color.value = 'warning'
    openSnack(message, messages)
  }

  const errorMessage = (message, messages = []) => {
    color.value = 'error'
    openSnack(message, messages)
  }

  const closeSnack = () => {
    title.value = ''
    text.value = []
    isOpen.value = false
  }

  const setInDialog = (inDialog) => {  // Fonction pour définir si on est dans une boîte de dialogue
    isInDialog.value = inDialog
  }

  return {
    isOpen,
    title,
    text,
    color,
    isInDialog,  // Ajout de cette variable dans le retour
    openSnack,
    openSnackSuccess,
    openSnackWarning,
    errorMessage,
    closeSnack,
    setInDialog
  }
})