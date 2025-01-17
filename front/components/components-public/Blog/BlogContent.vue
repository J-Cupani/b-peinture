<template>
    <section class="blog-2 pt-120 pb-115">
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 mb-30" v-for="item in blog" :key="item.image">
                    <div class="kblog">
                        <div class="kblog-img">
                            <NuxtLink :to="item.imageUrl"><img :src="item.image" class="img-fluid" alt="blog-img">
                            </NuxtLink>
                            <span>{{ item.date }}</span>
                        </div>
                        <div class="kblog-text">
                            <div class="kblog-meta">
                                <NuxtLink :to="item.metaAdminUrl"><i class="far fa-user-circle"></i>{{ item.metaAdmin }}
                                </NuxtLink>
                                <NuxtLink :to="item.metaCommentUrl"><i class="far fa-comments"></i>{{ item.metaComment }}
                                </NuxtLink>
                            </div>
                            <h3 class="kblog-text-title mb-20">
                                <NuxtLink :to="item.titleUrl"> {{ item.title }}</NuxtLink>
                            </h3>
                            <div class="kblog-text-link">
                                <NuxtLink :to="item.blogLinkUrl">{{ item.blogLink }} <i class="far fa-chevron-right"></i>
                                </NuxtLink>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="basic-pagination mt-20 wow fadeInUp" data-wow-delay=".5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <ul>
                            <li><span aria-current="page" class="page-numbers current">1</span></li>
                            <li><a class="page-numbers" href="#">2</a></li>
                            <li><a class="page-numbers" href="#">3</a></li>
                            <li><a class="next page-numbers" href="#">
                                    <i class="far fa-long-arrow-alt-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Blog',
    data() {
        return {
            blog: [{
                image: '/img/blog/blog-img-9.jpg',
                imageUrl: '/blogdetails',
                date: '20 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'Our Strategy Create Business Growth',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                image: '/img/blog/blog-img-10.jpg',
                imageUrl: '/blogdetails',
                date: '21 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'We work with change oriented executives',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                image: '/img/blog/blog-img-11.jpg',
                imageUrl: '/blogdetails',
                date: '22 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'From banking and insurance to wealth',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                image: '/img/blog/blog-img-6.jpg',
                imageUrl: '/blogdetails',
                date: '23 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'Representation on Digital platforms.',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                image: '/img/blog/blog-img-7.jpg',
                imageUrl: '/blogdetails',
                date: '24 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'Everything to keep in mind when designing',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            },
            {
                image: '/img/blog/blog-img-8.jpg',
                imageUrl: '/blogdetails',
                date: '24 May',
                metaAdmin: 'by Admin',
                metaAdminUrl: '/blogdetails',
                metaComment: '2 Comments',
                metaCommentUrl: '/blogdetails',
                title: 'A step-by-step adding authentication',
                titleUrl: '/blogdetails',
                blogLink: 'Read more',
                blogLinkUrl: '/blogdetails',
            }
            ]
        }
    }
}
</script>

<style scoped></style>
