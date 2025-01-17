export const useActionToolbarStore = defineStore('actionToolbar', () => {
  const newAction = ref(false)
  const editAction = ref(false)
  const saveAction = ref(false)
  const cancelAction = ref(false)
  const paramsAction = ref(false)
  const deleteAction = ref(false)
  const exportXlsAction = ref(false)
  const exportPdfAction = ref(false)
  const duplicateAction = ref(false)
  const responseAction = ref(false)
  const menuAction = ref(false)

  const showNewButton = ref(false)
  const showEditButton = ref(false)
  const showSaveButton = ref(false)
  const showCancelButton = ref(false)
  const showParamsButton = ref(false)
  const showDeleteButton = ref(false)
  const showExportXlsButton = ref(false)
  const showExportPdfButton = ref(false)
  const showDuplicateButton = ref(false)
  const showResponseButton = ref(false)
  const showMenuButton = ref(false)

  const resetButton = () => {
    showNewButton.value = false
    showEditButton.value = false
    showSaveButton.value = false
    showCancelButton.value = false
    showParamsButton.value = false
    showDeleteButton.value = false
    showExportXlsButton.value = false
    showExportPdfButton.value = false
    showDuplicateButton.value = false
    showResponseButton.value = false
    showMenuButton.value = false
  }

  return {
    newAction,
    editAction,
    saveAction,
    cancelAction,
    paramsAction,
    deleteAction,
    exportXlsAction,
    exportPdfAction,
    duplicateAction,
    responseAction,
    menuAction,
    showNewButton,
    showEditButton,
    showSaveButton,
    showCancelButton,
    showParamsButton,
    showDeleteButton,
    showExportXlsButton,
    showExportPdfButton,
    showDuplicateButton,
    showResponseButton,
    showMenuButton,
    resetButton
  }
})
