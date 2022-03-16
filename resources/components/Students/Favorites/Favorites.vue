<template>
    <div>
        <DashboardNavBar />
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-3 me-3 mb-3 LeftBar">
                    <div class="border-bottom p-3">
                        <h4>My Lists</h4>
                    </div>
                </div>
                <div class="col-md-8 pb-4 RightBar">
                    <div class="border-bottom p-3">
                        <h4>
                            <span>Favorites &nbsp;</span>

                            <span
                                style="font-size: 14px; font-weight: normal"
                                v-if="favTeachersLength > 0 && Favteachers.to"
                            >
                                {{ Favteachers.total }} &nbsp; teachers</span
                            >
                        </h4>
                    </div>
                    <div class="row p-4" v-if="favTeachersLength > 0">
                        <div
                            class="col-md-12 col-lg-12 col-sm-12 p-3 HoverTeacher"
                            v-for="teacher in Favteachers.data"
                            :key="teacher.id"
                            :class="teacher.id === removalClass?'removalClass':''"
                        >
                            <div class="row pt-3">
                                <div class="col-md-3 mb-2">
                                    <img
                                        v-if="teacher.teacher_image !== null"
                                        :src="
                                            '/images/' + teacher.teacher_image
                                        "
                                        alt=""
                                        width="150"
                                    />
                                    <img
                                        v-else
                                        src="/images/avatar.png"
                                        alt="avatar"
                                        width="150"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <p
                                        style="
                                            font-size: 23px;
                                            font-weight: 550;
                                        "
                                    >
                                        {{ teacher.name }}
                                        <i
                                            class="fa-solid fa-flag-checkered"
                                        ></i>
                                    </p>
                                    <!-- <span style="font-size:bolder">Malawi </span> -->
                                    <p>
                                        <i
                                            class="fa-solid fa-chalkboard-user"
                                        ></i
                                        >&nbsp;Teaches English
                                    </p>
                                    <p>
                                        Speaks:
                                        <span>{{ teacher.first_language }}</span
                                        >&nbsp;
                                        <span class="MainFluencyLevel">{{
                                            teacher.first_language_proficiency
                                        }}</span>
                                        {{ teacher.second_language }}
                                        <span class="SecondFluencyLevel">{{
                                            teacher.second_language_proficiency
                                        }}</span>
                                        {{ teacher.third_language }}
                                        <span class="ThirdFluencyLevel">{{
                                            teacher.third_language_proficiency
                                        }}</span>
                                    </p>
                                    <p v-if="teacher.description.length > 200">
                                        <span
                                            v-if="showShortDescription"
                                            class="shortDescription"
                                        >
                                            {{
                                                teacher.description.slice(
                                                    0,
                                                    150
                                                )
                                            }}
                                            <span
                                                @click="readMore"
                                                style="color: #029e02"
                                                >...Read More</span
                                            >
                                        </span>
                                        <span v-else class="shortDescription">
                                            {{ teacher.description }}
                                            <span
                                                @click="readLess"
                                                style="color: #029e02"
                                                >Hide details</span
                                            >
                                        </span>
                                    </p>
                                    <p v-else>
                                        {{ teacher.description }}
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div
                                            class="col-md-4"
                                            style="font-size: 20px"
                                        >
                                            <!-- <p>
                                        5 <br /><span style="font-size: 13px"
                                            >reviews</span
                                        >
                                    </p> -->
                                        </div>
                                        <div
                                            class="col-md-8"
                                            style="font-size: 20px"
                                        >
                                            <p
                                                v-if="teacher.currency == 'USD'"
                                                style="
                                                    font-size: 23px;
                                                    font-weight: 550;
                                                "
                                                class="d-flex justify-content-end"
                                            >
                                                ${{ teacher.hourly_pay }}
                                                {{ teacher.currency }}<br />
                                            </p>
                                            <p
                                                v-else-if="
                                                    teacher.currency == 'EUR'
                                                "
                                                style="
                                                    font-size: 23px;
                                                    font-weight: 550;
                                                "
                                                class="d-flex justify-content-end"
                                            >
                                                €{{ teacher.hourly_pay }}
                                                {{ teacher.currency }}<br />
                                            </p>
                                            <p
                                                v-else-if="
                                                    teacher.currency == 'GBP'
                                                "
                                                style="
                                                    font-size: 23px;
                                                    font-weight: 550;
                                                "
                                                class="d-flex justify-content-end"
                                            >
                                                £{{ teacher.hourly_pay }}
                                                {{ teacher.currency }}<br />
                                            </p>
                                            <p
                                                style="
                                                    line-height: 2px;
                                                    font-size: 14px;
                                                "
                                                class="d-flex justify-content-end"
                                            >
                                                per hour
                                            </p>

                                            <p
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Remove from list"
                                                class="d-flex justify-content-end"
                                                @click="
                                                    removeFromFavorite(
                                                        teacher.id
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fa-solid fa-heart"
                                                    style="color:#fe0609"
                                                ></i>
                                            </p>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <a href="" class="btn d-block FilterBtn"
                                        >Details</a
                                    ><br />
                                    <a
                                        href=""
                                        class="btn d-block btn-warning mb-3 RemoveOutline"
                                        >Hire</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="spinner" v-if="loading2 == true">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                        <div class="contnainer py-5" v-if="loaded == true">
                            <span class="d-flex justify-content-center"
                                ><i
                                    class="fa-solid fa-box-open"
                                    style="font-size: 100px"
                                ></i
                            ></span>
                            <h4 class="d-flex justify-content-center">
                                You don't have teachers
                            </h4>
                            <p class="d-flex justify-content-center">
                                Add teachers to your list for the most
                                convenient way to access them later.
                            </p>
                            <router-link
                                to="/student/teachers"
                                class="BrowseTeachers"
                                >Browse Teachers</router-link
                            >
                        </div>
                    </div>

                    <div class="container">
                        <Pagination
                            :data="Favteachers"
                            align="right"
                            @pagination-change-page="getStudentFavorites"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

import axios from "axios";
import DashboardNavBar from "../DashboardNavBar.vue";
import LaravelVuePagination from "laravel-vue-pagination";
export default {
    name: "Messages",
    components: {
        DashboardNavBar,
        Pagination: LaravelVuePagination,
    },
    data() {
        return {
            Favteachers: {},
            favTeachersLength: 0,
            loaded: false,
            loading2: false,
            removalClass:0,

            showShortDescription: true,
            StudentFavoritesIds: "",
            addedToFavorite: true,
        };
    },
    methods: {
        getFavorites() {
            axios
                .get("/student/getFavoriteTeacherIds")
                .then((response) => {
                    this.StudentFavoritesIds = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getStudentFavorites(page = 1) {
            this.loading2 = true;
            axios
                .get("/student/getAllStudentFavorites?page" + page)
                .then((response) => {
                    this.Favteachers = response.data;
                    if (response.data.data.length > 0) {
                        this.favTeachersLength = response.data.data.length;
                    } else {
                        this.loaded = true;
                    }
                })
                .finally(() => {
                    this.loading2 = false;
                });
        },

        removeFromFavorite(teacherId) {
            this.removalClass = teacherId;
            if (this.addedToFavorite == true) {
                this.addedToFavorite = false;
                this.$store.commit("subtrFavoriteCount", 1);
            } else {
                this.$store.commit("addFavoriteCount", 1);
                this.addedToFavorite = true;
            }
            axios.post("/student/removeFromFavorite", { id: teacherId });
        },
        
        readMore() {
            this.showShortDescription = false;
        },
        readLess() {
            this.showShortDescription = true;
        },
    },
    mounted() {
        this.getStudentFavorites();
        this.getFavorites();
    },
};
</script>
<style scoped>
.removalClass{
    display:none
}
.LeftBar {
    height: 250px;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    padding: 0;
}
.RightBar {
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    padding: 0;
    height: 700px;
    overflow-y: auto;
}

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

.fa-heart:hover {
    animation: beat 1.2s ease-in-out infinite;
    font-size: 20px;
}
@keyframes beat {
    0% {
        font-size: 19px;
    }
    100% {
        font-size: 18px;
    }
}

.btn {
    border-radius: 0;
}
.FilterBtn {
    background-color: #029e02;
    color: white;
}
.FilterBtn:focus {
    outline: none;
    box-shadow: none;
}
.RemoveOutline:focus {
    outline: none;
    box-shadow: none;
}
.MainFluencyLevel {
    color: #029e02;
    background-color: rgb(2, 158, 2, 0.1);
    padding: 4px;
    border-radius: 5px;
}
.SecondFluencyLevel {
    color: #027a9e;
    background-color: rgba(2, 83, 158, 0.1);
    padding: 4px;
    border-radius: 5px;
}
.ThirdFluencyLevel {
    color: #9e9402;
    background-color: rgba(158, 148, 2, 0.1);
    padding: 4px;
    border-radius: 5px;
}

.Horizontal {
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}
.TopHeading {
    color: #151419;
    margin-top: 5px;
    font-size: 22px;
}

::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px #e6e6e6;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #dddddd;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #dddddd;
    cursor: pointer;
}

.cardShadow {
    box-shadow: 17px 24px 16px -26px rgba(0, 0, 0, 0.53);
    -webkit-box-shadow: 17px 24px 16px -26px rgba(0, 0, 0, 0.53);
    -moz-box-shadow: 17px 24px 16px -26px rgba(0, 0, 0, 0.53);
}

.HoverTeacher:hover:not(img) {
    background-color: rgb(21, 20, 25, 0.05);
    cursor: pointer;
}
.HoverTeacher {
    border-bottom: 1px solid rgb(219, 219, 219);
}

.BrowseTeachers {
    background-color: #029e02;
    padding: 5px;
    color: #f8f8f8;
    display: block;
    text-align: center;
    width: 50%;
    margin: auto;
    margin-bottom: 10px;
    text-decoration: none;
    /* color: white; */
    font-size: 20px;
    border: 1px solid #029e02;
}
.BrowseTeachers:hover {
    background-color: #02ad02;
}
</style>
