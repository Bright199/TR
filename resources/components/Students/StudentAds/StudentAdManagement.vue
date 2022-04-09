<template>
    <div>
        <div class="container-jumbotron TopBar1">
            <DashboardNavBar />
        </div>
        <div class="container">
            <div class="spinner" v-if="loading">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <div
                class="container MainContainer bg-white p-4 mt-3"
                v-if="loaded && studentAds.length"
            >
                <table class="table table-responsive table-hover">
                    <tbody>
                        <tr v-for="(ad, index) in studentAds" :key="ad.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ ad.title }}</td>
                            <td v-if="ad.published === 0">
                                Status: <span>unpublished</span>
                            </td>
                            <td v-else-if="ad.published === 1">
                                Status:
                                <span style="color: blue"
                                    >Pending upproval</span
                                >
                            </td>
                            <td v-else-if="ad.published === 2">
                                Status:
                                <span style="color: #029e20">Active</span>
                            </td>
                            <td>
                                <router-link :to="'/student/single/ad/' + ad.id"
                                    >view details</router-link
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="container" v-else>
                <div class="row mt-2" v-if="loaded">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h2>
                            There are no ads for you yet. Make one by following
                            the link below
                        </h2>
                        <!-- <router-link to="/student/create/ad">Create ad</router-link> -->
                        <a href="/student/create/ad">Create ad</a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { mapState, mapMutations } from "vuex";
import DashboardNavBar from "../DashboardNavBar.vue";
export default {
    name: "StudentAdManagement",
    components: { DashboardNavBar },
    data() {
        return {
            studentAds: "",
            loading: false,
            loaded: false,
            count: 1,
        };
    },
    methods: {
        getStudentAds() {
            this.loading = true;
            axios
                .get("/student/ads")
                .then((response) => {
                    this.studentAds = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
    computed: mapState({
        AuthUserDetails: (state) => state.loggedUser,
    }),
    mounted() {
        this.getStudentAds();
    },
};
</script>
<style scoped>
/* spinner */
.spinner {
    margin: 100px auto;
    width: 40px;
    height: 40px;
    position: relative;
    text-align: center;

    -webkit-animation: sk-rotate 2s infinite linear;
    animation: sk-rotate 2s infinite linear;
}

.dot1,
.dot2 {
    width: 60%;
    height: 60%;
    display: inline-block;
    position: absolute;
    top: 0;
    background-color: #029e02;
    border-radius: 100%;

    -webkit-animation: sk-bounce 2s infinite ease-in-out;
    animation: sk-bounce 2s infinite ease-in-out;
}

.dot2 {
    top: auto;
    bottom: 0;
    -webkit-animation-delay: -1s;
    animation-delay: -1s;
}

@-webkit-keyframes sk-rotate {
    100% {
        -webkit-transform: rotate(360deg);
    }
}
@keyframes sk-rotate {
    100% {
        transform: rotate(360deg);
        -webkit-transform: rotate(360deg);
    }
}

@-webkit-keyframes sk-bounce {
    0%,
    100% {
        -webkit-transform: scale(0);
    }
    50% {
        -webkit-transform: scale(1);
    }
}

@keyframes sk-bounce {
    0%,
    100% {
        transform: scale(0);
        -webkit-transform: scale(0);
    }
    50% {
        transform: scale(1);
        -webkit-transform: scale(1);
    }
}
/*  */

tr:nth-child(even) {
    background-color: #f8f9fa;
}
.MainContainer{
    height: 400px;
    overflow-y: auto
}
</style>
