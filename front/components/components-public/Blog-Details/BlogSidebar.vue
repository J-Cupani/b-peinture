<template>
    <div class="sidebar-wrap">
        <div class="sidebar-search-from mb-30">
            <form action="#">
                <input type="text" placeholder="Search here">
                <button type="submit"> <i class="far fa-search"></i></button>
            </form>
        </div>

        <div class="widget_-latest-posts mb-30" v-for="item in postTitle" :key="item.title">
            <h4 class="bs-widget-title mb-25"> {{ item.title }} </h4>
            <div class="sidebar__widget-content">
                <div class="rc-post d-flex mb-15" v-for="item in rcPost" :key="item.image">
                    <div class="rc-thumb">
                        <NuxtLink :to="item.imageUrl"><img :src="item.image" class="img-fluid" alt="blog-img"></NuxtLink>
                    </div>
                    <div class="rc-text">
                        <div class="kblog-meta">
                            <NuxtLink :to="item.bdMetaUrl"><i class="fal fa-user-circle"></i> {{ item.bdMetaAuthor }}
                            </NuxtLink>
                        </div>
                        <h5>
                            <NuxtLink :to="item.bdMetaUrl">{{ item.bdMetaTitle }}</NuxtLink>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget_categories grey-bg mb-30" v-for="item in catTitle" :key="item.title">
            <h4 class="bs-widget-title pl-15">{{ item.title }}</h4>
            <ul v-for="item in rcCategories" :key="item.catLink">
                <li>
                    <NuxtLink :to="item.catLinkUrl">{{ item.catLink }} <i class="fas fa-long-arrow-alt-right"></i></NuxtLink>
                </li>
            </ul>
        </div>

        <div class="widget_tag_cloud" v-for="item in tagTitle" :key="item.title">
            <h4 class="bs-widget-title mb-25"> {{ item.title }} </h4>
            <div class="tagcloud">
                <NuxtLink :to="item.tagLinkUrl" class="tag-cloud-link" v-for="item in rcTags" :key="item.tagLink">
                    {{ item.tagLink }}</NuxtLink>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Breadcrumb',
    data() {
        return {
            postTitle: [{
                title: 'Latest Posts',
            }],
            catTitle: [{
                title: 'Categories',
            }],
            tagTitle: [{
                title: 'Tags',
            }],
            rcPost: [{
                image: '/img/blog/sidebar-post-img1.jpg',
                imageUrl: '/blogdetails',
                bdMetaAuthor: 'by Admin',
                bdMetaUrl: '/blogdetails',
                bdMetaTitle: 'experiences that connect us',
            },
            {
                image: '/img/blog/sidebar-post-img2.jpg',
                imageUrl: '/blogdetails',
                bdMetaAuthor: 'by Admin',
                bdMetaUrl: '/blogdetails',
                bdMetaTitle: 'From banking and insurance to',
            },
            {
                image: '/img/blog/sidebar-post-img3.jpg',
                imageUrl: '/blogdetails',
                bdMetaAuthor: 'by Admin',
                bdMetaUrl: '/blogdetails',
                bdMetaTitle: 'We work with you to business',
            }],

            rcCategories: [{
                catLink: 'Web Developement',
                catLinkUrl: '/blogdetails',
            },
            {
                catLink: 'Graphic Design',
                catLinkUrl: '/blogdetails',
            },
            {
                catLink: 'SEO &amp; Content Writting',
                catLinkUrl: '/blogdetails',
            },
            {
                catLink: 'Digital Marketing',
                catLinkUrl: '/blogdetails',
            },
            {
                catLink: 'App Development',
                catLinkUrl: '/blogdetails',
            }],

            rcTags: [{
                tagLink: 'Graphics',
                tagLinkUrl: '/blogdetails',
            },
            {
                tagLink: 'Design',
                tagLinkUrl: '/blogdetails',
            },
            {
                tagLink: 'Business',
                tagLinkUrl: '/blogdetails',
            },
            {
                tagLink: 'Development',
                tagLinkUrl: '/blogdetails',
            },
            {
                tagLink: 'Technology',
                tagLinkUrl: '/blogdetails',
            },
            {
                tagLink: 'Content',
                tagLinkUrl: '/blogdetails',
            }]
        }
    }
}
</script>

<style lang="scss" scoped></style>
