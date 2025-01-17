<template>
  <div>
    <VBtn
      v-show="actionToolbarStore.showNewButton"
      class="mr-2"
      size="32"
      @click="New()">
      <VTooltip
        activator="parent"
        location="bottom"
      >
        Ajouter un nouvel élément
      </VTooltip>
      <VIcon icon="tabler-square-rounded-plus" size="22"/>
    </VBtn>

    <VBtn
      v-show="actionToolbarStore.showMenuButton"
      class="mr-2"
      size="32"
      @click="Menu()"
    >
      <VIcon icon="tabler-menu-deep" size="22"/>
    </VBtn>

    <VBtn
      v-show="actionToolbarStore.showSaveButton"
      class="mr-2"
      size="32"
      @click="Save()"
    >
      <VIcon icon="carbon:save" size="22"/>
    </VBtn>

    <VBtn
      v-show="actionToolbarStore.showExportXlsButton"
      class="mr-2"
      color="green-darken-2"
      size="32"
      @click="ExportXls()"
    >
      <VIcon icon="tabler-file-type-xls" size="22"/>
    </VBtn>

    <VBtn
      v-show=actionToolbarStore.showResponseButton
      class="mr-2"
      color="green-darken-3"
      size="32"
      @click="Response()"
    >
      <VTooltip
        activator="parent"
        location="bottom"
      >
        Editer les réponses
      </VTooltip>
      <VIcon icon="tabler-versions" size="22"/>
    </VBtn>

    <VBtn
      v-show="actionToolbarStore.showEditButton"
      class="mr-2"
      size="32"
      @click="Edit()"
    >
      <VTooltip
        activator="parent"
        location="bottom"
      >
        Editer le rapport
      </VTooltip>
      <VIcon icon="tabler-edit" size="22"/>
    </VBtn>

    <VBtn
      v-show="actionToolbarStore.showExportPdfButton"
      class="mr-2"
      color="purple-darken-3"
      size="32"
      @click="ExportPdf()"
    >
      <VTooltip
        activator="parent"
        location="bottom"
      >
        Exporter en PDF
      </VTooltip>
      <VIcon icon="tabler-file-type-pdf" size="22"/>
    </VBtn>

    <VBtn
      v-show="actionToolbarStore.showDuplicateButton"
      class="mr-2"
      color="success"
      size="32"
      @click="Duplicate()"
    >
      <VIcon icon="tabler-copy" size="22"/>
    </VBtn>

    <VBtn
      v-show=actionToolbarStore.showCancelButton
      color="secondary"
      size="32"
      @click="Cancel()"
    >
      <VIcon icon="carbon:save" size="22"/>
    </VBtn>

    <VBtn
      v-show=actionToolbarStore.showDeleteButton
      class="mr-2"
      color="error"
      size="32"
      @click="Delete()"
    >
      <VIcon icon="tabler-trash" size="22"/>
    </VBtn>

    <VBtn
      v-show=actionToolbarStore.showParamsButton
      color="info"
      size="32"
      @click="Params()"
    >
      <VIcon icon="tabler-adjustments" size="22"/>
    </VBtn>
  </div>
</template>

<script setup>
import { useActionToolbarStore } from "@/stores/actionToolbar"

const actionToolbarStore = useActionToolbarStore()

const New = () => {
  actionToolbarStore.$patch({newAction: true})
}

const Save = () => {
  actionToolbarStore.$patch({saveAction: true})
}

const Cancel = () => {
  actionToolbarStore.$patch({cancelAction: true})
}

const Params = () => {
  actionToolbarStore.$patch({paramsAction: true})
}

const Delete = () => {
  actionToolbarStore.$patch({deleteAction: true})
}

const Edit = () => {
  actionToolbarStore.$patch({editAction: true})
}

const ExportXls = () => {
  actionToolbarStore.$patch({exportXlsAction: true})
}

const ExportPdf = () => {
  actionToolbarStore.$patch({exportPdfAction: true})
}

const Duplicate = () => {
  actionToolbarStore.$patch({duplicateAction: true})
}

const Menu = () => {
  actionToolbarStore.$patch({menuAction: true})
}

const Response = () => {
  actionToolbarStore.$patch({responseAction: true})
}
</script>
