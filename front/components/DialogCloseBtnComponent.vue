<script setup>
const props = defineProps({
  icon: {
    type: String,
    required: false,
    default: 'tabler-x',
  },
  iconSize: {
    type: String,
    required: false,
    default: '24',
  },
})
</script>

<template>
  <IconBtn
    variant="elevated"
    size="36"
    :ripple="false"
    class="v-dialog-close-btn"
  >
    <VIcon
      :icon="props.icon"
      :size="props.iconSize"
    />
  </IconBtn>
</template>

<style>
  .v-dialog-close-btn {
    inset-block-start: -0.3rem !important;
    inset-inline-end: -0.3rem !important;
  }
</style>
