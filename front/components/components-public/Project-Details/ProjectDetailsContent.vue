<template>
    <section class="project-details-area pt-120 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="project-big-thumb">
                        <img :src="image" class="img-fluid" alt="project_img">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12">
                    <div class="p-details-content mb-40">
                        <h3>{{ descriptionTitle }}</h3>
                        <p>{{ description1 }}</p>
                        <p>{{ description2 }}</p>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                    <div class="sidebar-wrap mb-40">
                        <div class="sidebar-right">
                            <div class="sidebar-single" v-for="item in sidebar" :key="item.client">
                                <label>{{ item.client }}</label>
                                <span>{{ item.content }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: '',
    data() {
        return {
            image: '/img/project/project-big-img.jpg',
            descriptionTitle: 'Fimlor Experience',
            description1: 'Need something changed or is there something not quite working the way you envisaged? Is your van a little old and tired and need refreshing? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            description2: 'Need something changed or is there something not quite working the way you envisaged? Is your van a little old and tired and need refreshing? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            sidebar: [{
                client: 'Clients:',
                content: 'Jessica Brown',
            },
            {
                client: 'Category:',
                content: 'Design , Development',
            },
            {
                client: 'Value:',
                content: 'Jessica Brown',
            },
            {
                client: 'Date:',
                content: '20 Aug, 2023',
            }
            ]
        }
    }
}
</script>

<style lang="scss" scoped></style>
