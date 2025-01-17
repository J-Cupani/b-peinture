<template>
    <header>
        <div class="header-top bg-heading d-none d-md-block">
            <div class="container-fluid">
                <div class="header-top-space">
                    <div class="row">
                        <div class="col-lg-4 d-none d-lg-block">
                            <div class="welcome-text">
                                <span>{{ welcomeText }}</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="header-top-info">
                                <ul>
                                    <li><img src="/img/icon/sidebar-icon-1.png" class="img-fluid" alt="icon_img">{{ address }}</li>
                                    <li><img src="/img/icon/footer-icon-1.png" class="img-fluid" alt="icon_img"><a href="mailto:needhelp@company.com">{{ gmail }}</a></li>
                                    <li><img src="/img/icon/footer-icon-2.png" class="img-fluid" alt="icon_img"><a href="tel:926668880000">{{ number }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div :class="`${isSticky ? 'header-area transparent-header sticky-header2 white-bg sticky' : 'header-area transparent-header sticky-header2 white-bg'}`">
                <div class="container-fluid">
                    <div class="header-space">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-3 col-md-3 col-8 order-1 order-xl-1">
                                <div class="header-logo">
                                    <NuxtLink to="/"><img src="/img/logo/logo.png" class="img-fluid" alt="logo-img"></NuxtLink>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-1 col-md-2 col-4 order-3 order-xl-2">
                                <div class="main-menu main-menu-2 d-none d-xl-block">
                                    <nav id="mobile-menu">
                                        <Menus />
                                    </nav>
                                </div>
                                <div class="d-block d-xl-none text-end">
                                    <div class="menu-bar">
                                        <button class="bars" @click="handleSidebar">
                                            <i class="far fa-bars"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-8 col-md-7 d-none d-md-block order-2 order-xl-3">
                                <div class="header-right text-end">
                                    <div class="header-social header-social-2">
                                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                                        <a href="https://www.pinterest.com/" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                                        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                                    </div>
                                    <div class="header-search header-search-2">
                                        <a class="search-btn nav-search search-trigger" href="javascript:void(0)" @click="handleSearch">
                                            <i class="far fa-search"></i></a>
                                    </div>
                                    <div class="header-btn">
                                        <NuxtLink to="/about" class="theme-btn theme-btn-small theme-btn-small-border">Free Estimate</NuxtLink>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Mobile Menu Start -->
        <div class="fix">
            <div :class="`${showSidebar ? 'side-mobile-menu active' : 'side-mobile-menu'}`">
                <button class="close-mobile-menu" @click="handleSidebarClose"><i class="fas fa-times-circle"></i></button>
                <div class="side-info-content sidebar-menu mm-menu">
                    <ul>
                        <li class="menu-item-has-children has-droupdown"
                            v-bind:class="[menuOption.homeDropdown === true ? 'active' : '']">
                            <a @click="menuOption.homeDropdown = !menuOption.homeDropdown">Home</a>
                            <ul class="sub-menu" :class="[menuOption.homeDropdown === true ? 'active' : '',]">
                                <li>
                                    <NuxtLink to="/">Home Style 1</NuxtLink>
                                </li>
                                <li>
                                    <NuxtLink to="/index-2">Home Style 2</NuxtLink>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <NuxtLink to="/about">About</NuxtLink>
                        </li>
                        <li class="menu-item-has-children has-droupdown"
                            :class="[menuOption.coursesDropdown === true ? 'active' : '',]">
                            <a @click="menuOption.coursesDropdown = !menuOption.coursesDropdown">Services</a>
                            <ul class="sub-menu" :class="[menuOption.coursesDropdown === true ? 'active' : '',]">
                                <li>
                                    <NuxtLink to="/service">Services</NuxtLink>
                                </li>
                                <li>
                                    <NuxtLink to="/servicedetails">Services Details</NuxtLink>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children has-droupdown"
                            :class="[menuOption.shopDropdown === true ? 'active' : '']">
                            <a v-on:click="menuOption.shopDropdown = !menuOption.shopDropdown">Project</a>
                            <ul class="sub-menu" :class="[menuOption.shopDropdown === true ? 'active' : '',]">
                                <li>
                                    <NuxtLink to="/project">Project</NuxtLink>
                                </li>
                                <li>
                                    <NuxtLink to="/projectdetails">Project Details</NuxtLink>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children has-droupdown"
                            :class="[menuOption.blogDropdown === true ? 'active' : '']">
                            <a v-on:click="menuOption.blogDropdown = !menuOption.blogDropdown">Blog</a>
                            <ul class="sub-menu" :class="[menuOption.blogDropdown === true ? 'active' : '',]">
                                <li>
                                    <NuxtLink to="/blog">Blog</NuxtLink>
                                </li>
                                <li>
                                    <NuxtLink to="/blogdetails">Blog Details</NuxtLink>
                                </li>
                            </ul>
                        </li>
                        <li class="has-droupdown" :class="[menuOption.pagesDropDown === true ? 'active' : '',]">
                            <a @click="menuOption.pagesDropDown = !menuOption.pagesDropDown">Pages</a>
                            <ul class="sub-menu" :class="[menuOption.pagesDropDown === true ? 'active' : '',]">
                                <li><NuxtLink to="/pricing">Pricing</NuxtLink></li>
                                <li><NuxtLink to="/faq">Faq</NuxtLink></li>
                                <li><NuxtLink to="/team">Team</NuxtLink></li>
                                <li><NuxtLink to="/team-details">Team Details</NuxtLink></li>
                                <li><NuxtLink to="/signin">SignIn</NuxtLink></li>
                                <li><NuxtLink to="/forgot-password">Forgot Password</NuxtLink></li>
                                <li><NuxtLink to="/signup">SignUp</NuxtLink></li>
                                <li><NuxtLink to="/contact">Contact</NuxtLink></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="contact-infos mb-30">
                    <div class="contact-list mb-30">
                        <h4>Contact Info</h4>
                        <div class="mobile-search">
                            <form action="#">
                                <input type="text" placeholder="Search here...">
                                <button type="submit">
                                    <i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <ul>
                            <li><img src="/img/icon/sidebar-icon-1.png" class="img-fluid" alt="icon-img">86 broklyn street
                                road, New York</li>
                            <li><img src="/img/icon/footer-icon-1.png" class="img-fluid" alt="icon-img"><a
                                    href="mailto:info@sycho24.com">needhelp@company.com</a></li>
                            <li><img src="/img/icon/footer-icon-2.png" class="img-fluid" alt="icon-img"><a
                                    href="tel:926668880000">92 666 888 0000</a></li>
                        </ul>
                        <div class="sidebar__menu--social">
                            <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.pinterest.com/" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div :class="`${showSidebar ? 'offcanvas-overlay overlay-open' : 'offcanvas-overlay'}`" @click="handleSidebarClose"></div>
        <!-- Mobile Menu End -->

        <!-- Menu Search start -->
        <div :class="`${showSearch ? 'search-wrap active' : 'search-wrap'}`">
            <div class="search-inner">
                <i class="search-close" id="search-close" @click="handleSearchClose"><i class="fas fa-times-circle"></i></i>
                <div class="search-cell">
                    <form method="get">
                        <div class="search-field-holder">
                            <input type="search" class="main-search-input" placeholder="Search here...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Menu Search End -->
    </header>
</template>

<script>
import Menus from './Menus.vue';


export default {
    name: 'topbar',
    data() {
        return {
            welcomeText: 'Welcome to the Digital Marketing Agency',
            address: '86 broklyn street road, New York',
            gmail: 'needhelp@company.com',
            number: '92 666 888 0000',
            isSticky: false,
            showSidebar: false,
            showSearch: false,
            menuOption: {
                menuShow: false,
                homeDropdown: false,
                coursesDropdown: false,
                shopDropdown: false,
                pagesDropDown: false,
                instructorDropDown: false,
                faqDropDown: false,
                eventDropDown: false,
                blogDropdown: false,
            },
        };
    },
    methods: {
        handleSticky() {
            if (window.scrollY > 50) {
                this.isSticky = true;
            }
            else {
                this.isSticky = false;
            }
        },
        handleSidebar() {
            this.showSidebar = true;
        },
        handleSidebarClose() {
            this.showSidebar = false;
        },
        handleSearch() {
            this.showSearch = true;
        },
        handleSearchClose() {
            this.showSearch = false;
        },
    },
    mounted() {
        window.addEventListener('scroll', this.handleSticky);
    },
    components: { Menus }
}
</script>

<style lang="scss" scoped>
.navbar {
    display: inherit;
    padding: 0px;
}
.theme-btn-small-border {
    border: 1px solid #ff4040;
}
.transparent-header.sticky-header2.sticky {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    border-bottom: 1px solid #e9ebed;
}
</style>
