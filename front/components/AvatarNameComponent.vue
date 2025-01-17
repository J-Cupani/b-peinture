<template>
  <VListItem class="px-0">
    <template #prepend>
      <VListItemAction start>
        <VAvatar
          :color="(!item.image && props.disableAvatarBackground) || (!props.disableAvatarBackground) ? 'primary' : ''"
          :variant="(!item.image && props.disableAvatarBackground) || (!props.disableAvatarBackground)  ? 'tonal' : undefined"
        >
          <VImg
            v-if="item && item.image"
            :src="item.image"
            cover
          />
          <div v-if="!item.image">
            {{ item[name].charAt(0) }}
          </div>
        </VAvatar>
      </VListItemAction>
    </template>

    <VListItemTitle :class="bold ? 'font-weight-semibold' : 'text-body-2'">
      {{ item[name] }}
    </VListItemTitle>
  </VListItem>
</template>

<script setup>
const props = defineProps({
  name: {
    type: String,
    default: "fullName"
  },
  item: {
    type: Object,
    required: true,
    default: null
  },
  bold: {
    type: Boolean,
    default: true
  },
  disableAvatarBackground: {
    type: Boolean,
    default: false
  }
})
</script>

<style scoped>
.text-body-2 {
  font-size: 14px !important;
}
</style>
