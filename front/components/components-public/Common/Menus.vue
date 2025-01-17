<template>
    <ul>
        <li class="menu-item-has-children">
            <NuxtLink to="/">Home</NuxtLink>
            <ul class="sub-menu">
                <li>
                    <nuxt-link to="/">Home Style 1</nuxt-link>
                </li>
                <li>
                    <nuxt-link to="/index-2">Home Style 2</nuxt-link>
                </li>
            </ul>
        </li>
        <li>
            <nuxt-link to="/about">About</nuxt-link>
        </li>
        <li class="menu-item-has-children">
            <NuxtLink to="/service">Services</NuxtLink>
            <ul class="sub-menu">
                <li>
                    <NuxtLink to="/service">Services</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/servicedetails">Services Details</NuxtLink>
                </li>
            </ul>
        </li>
        <li class="menu-item-has-children">
            <NuxtLink to="/project">Project</NuxtLink>
            <ul class="sub-menu">
                <li>
                    <NuxtLink to="/project">Project</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/projectdetails">Project Details</NuxtLink>
                </li>
            </ul>
        </li>
        <li class="menu-item-has-children">
            <NuxtLink to="/blog">Blog</NuxtLink>
            <ul class="sub-menu">
                <li>
                    <NuxtLink to="/blog">Blog</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/blogdetails">Blog Details</NuxtLink>
                </li>
            </ul>
        </li>
        <li><a href="#">Pages</a>
            <ul class="sub-menu">
                <li>
                    <NuxtLink to="/pricing">Pricing</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/faq">Faq</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/team">Team</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/team-details">Team Details</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/signin">SignIn</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/forgot-password">Forgot Password</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/signup">SignUp</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/contact">Contact</NuxtLink>
                </li>
            </ul>
        </li>
    </ul>
</template>