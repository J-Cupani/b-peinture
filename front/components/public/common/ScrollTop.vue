<template>
  <div @click="scrollTop" class="backto-top" style="opacity: 0">
    <div style="display: flex; justify-content: center; align-items: center">
      <i class="feather-arrow-up"></i>
    </div>
  </div>
</template>

<script setup>
const scrollTop = () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth", // You can use 'auto' or 'instant' as well
  });
};
const scrollTopVisivle = () => {
  var scrollTop = document.querySelector(".backto-top");

  var topPos = window.pageYOffset || document.documentElement.scrollTop;
  if (topPos > 100) {
    scrollTop.style.opacity = "1";
  } else {
    scrollTop.style.opacity = "0";
  }
};
onMounted(() => {
  window.addEventListener("scroll", scrollTopVisivle);
});
onUnmounted(() => {
  window.removeEventListener("scroll", scrollTopVisivle);
});
</script>

<style lang="scss" scoped></style>
