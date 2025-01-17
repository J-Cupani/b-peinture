<template>
    <div class="bd-team-area pt-120 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-6" v-for="item in team" :key="item.id">
                    <div class="kteam mb-30">
                        <div class="kteam-img">
                            <img :src="item.image" class="img-fluid" alt="team-img">
                            <div class="kteam-img-social">
                                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://www.pinterest.com/" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                                <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="kteam-text text-center">
                            <h4 class="kteam-title">
                                <NuxtLink to="/team-details">{{ item.name }}</NuxtLink>
                            </h4>
                            <span class="uppercase">{{ item.designation }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
export default {
    name: 'Team',
    data() {
        return {
            team: [{
                id: '1',
                image: '/img/team/team-img-1.jpg',
                name: 'sarah albert',
                designation: 'designer',
            },
            {
                id: '2',
                image: '/img/team/team-img-2.jpg',
                name: 'Mike Hardson',
                designation: 'developer',
            },
            {
                id: '3',
                image: '/img/team/team-img-3.jpg',
                name: 'Christine eve',
                designation: 'Programmer',
            },
            {
                id: '4',
                image: '/img/team/team-img-4.jpg',
                name: 'John Smith',
                designation: 'artist',
            },
            {
                id: '5',
                image: '/img/team/team-img-5.jpg',
                name: 'melinda albert',
                designation: 'writter',
            },
            {
                id: '6',
                image: '/img/team/team-img-6.jpg',
                name: 'Shane Watson',
                designation: 'Teacher',
            },
            {
                id: '7',
                image: '/img/team/team-img-7.jpg',
                name: 'Steve Smith',
                designation: 'Painter',
            },
            {
                id: '8',
                image: '/img/team/team-img-8.jpg',
                name: 'Christina Wills',
                designation: 'Speaker',
            }
            ],
        }
    }
}
</script>