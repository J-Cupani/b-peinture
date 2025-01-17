<template>
    <main>
        <!-- Header area  -->
        <HeaderDefault />
        <!-- Header area end -->

        <!-- Breadcrumb area  -->
        <Breadcrumb pageTitle="Sign In" pageSubTitle="Sign In" />
        <!-- Breadcrumb area end -->

        <!-- Signin area  -->
        <section class="login__area pt-110 pb-110">
            <div class="container">
                <div class="login__inner p-relative z-index-1">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="login__wrapper">
                                <div class="login__top mb-30 text-center">
                                    <h3 class="login__title">Hello Again</h3>
                                    <p>Enter your credentials to acces your account.</p>
                                </div>
                                <div class="login__form">
                                    <form @submit.prevent="handleSubmit">
                                        <div class="login__input-wrapper">
                                            <div class="login__input-item">
                                                <div class="login__input">
                                                    <input name="email" type="email" placeholder="Enter your email"
                                                        id="email" required />
                                                </div>
                                            </div>
                                            <div class="login__input-item">
                                                <div class="login__input-item-inner p-relative">
                                                    <div class="login__input">
                                                        <input type="password" name="password" placeholder="Password"
                                                            id="password" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="login__option mb-25 d-sm-flex justify-content-between">
                                            <div class="login__remember">
                                                <input type="checkbox" id="tp-remember" />
                                                <label for="tp-remember">Remember me</label>
                                            </div>
                                            <div class="login__forgot">
                                                <NuxtLink class="login__top p" to="/forgot-password">forgot password?
                                                </NuxtLink>
                                            </div>
                                        </div>
                                        <div class="login__btn text-center">
                                            <button type="submit" class="theme-btn theme-btn-small border-btn">
                                                SignIn
                                            </button>
                                        </div>
                                    </form>
                                    <div class="login__register-now">
                                        <p>
                                            Don’t have an account?
                                            <NuxtLink to="/signup"> Register Now</NuxtLink>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Signin area end -->

        <!-- PageFooter area  -->
        <PageFooter />
        <!-- PageFooter area end -->

        <!-- scrolltop area start here -->
        <ScrollTop />
        <!-- scrolltop area end here -->
    </main>
</template>

<script>
import PageFooter from "../Common/PageFooter";
import HeaderDefault from "../Common/HeaderDefault.vue";
import ScrollTop from "../Common/ScrollTop.vue";
import Breadcrumb from "../Common/Breadcrumb.vue";

export default {
    name: "app",
    components: {
        PageFooter,
        HeaderDefault,
        ScrollTop,
        Breadcrumb
    },
    methods: {
        handleSubmit(event) {
            event.preventDefault();
        }
    }
};
</script>

<style scoped></style>
