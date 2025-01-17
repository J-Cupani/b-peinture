<script setup>
import DialogCloseBtn from './DialogCloseBtnComponent.vue'

const props = defineProps({
  title: {},
  text: {},
  sizeBtn: { default: "small" },
  textTooltip: { default: "Supprimer", required: false },
  info: { default: "", required: false },
  ml: { default: "ml-2" },
  withLabel: false,
  reportCount: { default: 0, required: false }
})

const emit = defineEmits(["confirm"])
const isDialogVisible = ref(false)

const confirmAction = () => {
  emit("confirm")
  isDialogVisible.value = false
}
</script>

<template>
  <VTooltip :text="props.textTooltip">
    <template v-slot:activator="dd">
      <VBtn
        v-if="props.withLabel"
        color="error"
        v-bind="dd.props"
        variant="text"
        @click.stop="isDialogVisible = true"
        prepend-icon="tabler-trash"
        class="w-100 d-flex align-center justify-start"
      >
        {{ props.textTooltip }}
      </VBtn>
      <VBtn
        v-else
        :size="props.sizeBtn"
        :class="props.ml"
        color="error"
        icon="tabler-trash"
        v-bind="dd.props"
        variant="tonal"
        @click="isDialogVisible = true"
      />
    </template>
  </VTooltip>

  <VDialog
    v-model="isDialogVisible"
    class="v-dialog-sm"
    max-width="500"
    persistent
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="isDialogVisible = false" />

    <!-- Dialog Content -->
    <VCard :title="props.title" v-bind="$attrs">
      <VCardText>
        <VAlert v-if="props.info !== ''" :text="props.info" class="mb-2" />
        {{ props.text }}

        <VAlert
          color="error"
          :text="`Attention cet utilisateur est associé à ${reportCount} rapport(s)`"
          variant="tonal"
          class="mt-3"
          v-if="reportCount > 0"
          density="compact"
        />
      </VCardText>

      <VCardText class="d-flex justify-end gap-3 flex-wrap">
        <VBtn
          color="secondary"
          variant="tonal"
          @click="isDialogVisible = false"
        >
          Annuler
        </VBtn>
        <VBtn class="ml-2" color="error" @click="confirmAction">
          Supprimer
        </VBtn>
      </VCardText>
    </VCard>
  </VDialog>
</template>
