<template>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
</template>
  
<script>
export default {
    mounted() {
        const result = document.querySelector('.progress-wrap');
        if (result) {
            document.addEventListener("scroll", () => {
                if (window.scrollY > 200) {
                    result.style.display = "block";
                } else {
                    result.style.display = "none";
                }
            });
            result.addEventListener("click", () => {
                window.scrollTo({ top: 0, behavior: "smooth" });
            });
        }
    },
};
</script>