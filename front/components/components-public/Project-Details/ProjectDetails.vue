<script>
import Breadcrumb from "../Common/Breadcrumb.vue";
import ProjectItems from "./ProjectItems";
import ProjectDetailsContent from "./ProjectDetailsContent";
import Pagination from "./Pagination";
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";

export default {
    name: "app",
    components: {
    Breadcrumb,
    ProjectItems,
    ProjectDetailsContent,
    Pagination,
    PageFooter,
    HeaderDefault,
    ScrollTop
}
};
</script>

<template>
<main>
    <!-- Header area  -->
    <HeaderDefault />
    <!-- Header area end -->

    <!-- page title area  -->
    <Breadcrumb pageTitle="Project Details" pageSubTitle="Project Details" />
    <!-- page title area end -->

    <!-- project details area start  -->
    <ProjectDetailsContent />
    <!-- project detials area end  -->

    <!-- pagination area  -->
    <Pagination />
    <!-- pagination area  end-->

    <!-- project area start  -->
    <ProjectItems />
    <!-- project area end  -->

    <!-- Header area  -->
     <PageFooter />
    <!-- Header area end -->

    <!-- scrolltop area start here -->
    <ScrollTop />
    <!-- scrolltop area end here -->
</main>
</template>

<style scoped>

</style>
