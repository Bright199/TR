<template>
    <div>
        <DashboardNavBar />
        <div class="container mt-3">
            <div class="spinner" v-if="loading == true">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <div class="row" v-if="loaded == true">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <img
                                v-if="teacherDetails.teacher_image"
                                :src="'/images/' + teacherDetails.teacher_image"
                                alt=""
                                width="200"
                            />
                            <img
                                v-else
                                src="/images/avatar.png"
                                alt=""
                                width="200"
                            />
                        </div>
                        <div class="col-md-9 border p-5 shadow-sm">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3>
                                        {{ teacherDetails.name }} &nbsp;<i
                                            class="fa-solid fa-shield-blank"
                                            style="
                                                color: #029e02;
                                                font-size: 18px;
                                            "
                                        ></i>
                                    </h3>
                                </div>
                                <div class="col-md-4 d-flex justify-content-end">
                                    <p
                                        v-if="
                                            StudentFavoritesIds.indexOf(
                                                teacherDetails.id
                                            ) === -1
                                        "
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        :title="
                                            addedToFavorite == true
                                                ? 'Save to My Lists'
                                                : 'Added to My Lists'
                                        "
                                        class="d-flex justify-content-end"
                                        @click="
                                            addToFavorite(teacherDetails.id)
                                        "
                                    >
                                        <i
                                            :class="
                                                addedToFavorite == true
                                                    ? 'fa-regular'
                                                    : 'fa-solid'
                                            "
                                            class="fa-heart"
                                            :style="
                                                addedToFavorite == true
                                                    ? ''
                                                    : 'color:#fe0609'
                                            "
                                        ></i>
                                        <!-- <i class="fa-regular fa-heart"></i> -->
                                    </p>
                                    <p
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        :title="
                                            addedToFavorite == true
                                                ? 'Added to My Lists'
                                                : 'Save to My Lists'
                                        "
                                        class="d-flex justify-content-end"
                                        v-else
                                        @click="
                                            removeFromFavorite(
                                                teacherDetails.id
                                            )
                                        "
                                    >
                                        <i
                                            :class="
                                                addedToFavorite == true
                                                    ? 'fa-solid'
                                                    : 'fa-regular'
                                            "
                                            class="fa-heart"
                                            :style="
                                                addedToFavorite == true
                                                    ? 'color:#fe0609'
                                                    : ''
                                            "
                                        ></i>
                                        <!-- <i class="fa-solid fa-heart"></i> -->
                                    </p>
                                </div>
                            </div>

                            <p>{{ teacherDetails.description }}</p>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div
                                        class="col-md-9 d-flex justify-content-end"
                                    >
                                        <p>
                                            Speaks
                                            {{ teacherDetails.first_language }}
                                            <span
                                                class="MainFluencyLevel"
                                                style="font-weight: 500"
                                                >{{
                                                    teacherDetails.first_language_proficiency
                                                }}
                                                </span
                                            >
                                            {{ teacherDetails.second_language }}
                                            <span
                                                class="SecondFluencyLevel"
                                                style="font-weight: 500"
                                                >{{
                                                    teacherDetails.second_language_proficiency
                                                }}</span
                                            >
                                            {{ teacherDetails.third_language }}
                                            <span
                                                class="ThirdFluencyLevel"
                                                style="font-weight: 500"
                                                >{{
                                                    teacherDetails.third_language_proficiency
                                                }}</span
                                            >
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <p v-if="teacherDetails.our_tearcher == 1">
                                Works for
                                <span style="font-weight: 500; color: #029e02"
                                    >TREnglish
                                </span>
                            </p>
                            <p v-else-if="loaded == true">
                                Works as
                                <span style="font-weight: 500; color: #029e02"
                                    >Freelance teacher
                                </span>
                            </p>
                            <!-- @endif -->
                            <p style="font-weight: 700; font-size: 16px">
                                <i class="fa-solid fa-dollar-sign"></i
                                >{{ teacherDetails.hourly_pay }} USD /hour
                            </p>
                            <p>
                                Joined on
                                {{ dateTime(teacherDetails.created_at) }}
                            </p>
                            <p>{{ teacherDetails.nationality }}</p>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <!-- Button to Open the Modal -->
                    <a
                        href="#"
                        class="hireBtn"
                        data-bs-toggle="modal"
                        data-bs-target="#MessageModal"
                    >
                        Hire
                    </a>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="MessageModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <p class="modal-title">
                            <i class="fa-solid fa-message"></i>
                            {{ teacherDetails.name }}
                        </p>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            id="close"
                        ></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <textarea
                            class="form-control"
                            rows="5"
                            id="userMessage"
                            v-model="message"
                            name="message"
                            placeholder="Message..."
                        ></textarea>
                    </div>

                    <!-- Modal footer -->

                    <div class="container d-flex justify-content-center">
                        <button
                            class="SendBtn"
                            id="SendBtn"
                            @click="SendMessage(teacherDetails.id)"
                        >
                            Send message
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
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
import { mapState, mapMutations } from "vuex";
import moment from "moment";
import DashboardNavBar from "./DashboardNavBar.vue";
export default {
    name: "SingleFreelanceTeacher",
    props: ["id"],
    components: {
        DashboardNavBar,
    },
    data() {
        return {
            teacherDetails: "",
            loaded: false,
            loading: false,
            message: "",
            StudentFavoritesIds: "",
            addedToFavorite: true,
        };
    },
    methods: {
        getFavorites() {
            axios.get("/student/getFavoriteTeacherIds").then((response) => {
                this.StudentFavoritesIds = response.data;
            });
        },
        removeFromFavorite(teacherId) {
            if (this.addedToFavorite == true) {
                this.addedToFavorite = false;
                this.$store.commit("subtrFavoriteCount", 1);
            } else {
                this.$store.commit("addFavoriteCount", 1);
                this.addedToFavorite = true;
            }
            axios.post("/student/removeFromFavorite", { id: teacherId });
        },
        addToFavorite(teacherId) {
            if (this.addedToFavorite == true) {
                this.addedToFavorite = false;
                this.$store.commit("addFavoriteCount", 1);
            } else {
                this.addedToFavorite = true;
                this.$store.commit("subtrFavoriteCount", 1);
            }
            axios
                .post("/student/addToFavorite", { id: teacherId })
                .then((response) => {
                    this.StudentFavoritesIds.push({ teacherId });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        SendMessage(teacherId) {
            const message = this.message.trim();
            if (message == "") {
                alert("Message empty");
                return;
            } else if (teacherId == "") {
                alert("select a teacher");
                return;
            } else {
                axios
                    .post("/student/message", { message, teacherId })
                    .then((response) => {
                        this.$router.push("/student/messages");
                        this.$el.querySelector("#close").click();
                    })
                    .finally(() => {
                        this.message = "";
                    });
            }
        },
        dateTime(value) {
            return moment(value).format("MMM Do YY");
        },
        getTeacherDetails() {
            this.loading = true;
            axios
                .get(`/student/teacher/details/${this.id}`)
                .then((response) => {
                    this.teacherDetails = response.data;
                    this.loaded = true;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
    mounted() {
        this.getTeacherDetails();
        this.getFavorites();
    },

    computed: {},
};
</script>

<style scoped>
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
.fa-heart {
    font-size: 25px;
}
.fa-heart:hover {
    animation: beat 1.2s ease-in-out infinite;
    font-size: 25px;
    cursor: pointer;
}
@keyframes beat {
    0% {
        font-size: 23px;
    }
    100% {
        font-size: 22px;
    }
}
.btn {
    outline: none;
     box-shadow: none;
}
.SendBtn {
    width: 50%;
    border: none;
    background-color: #029e02;
    color: white;
    margin-bottom: 14px;
    font-size: 16px;
    padding: 2px;
}
.SendBtn:hover {
    background-color: #04ad04;
}
.hireBtn {
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
.hireBtn:hover {
    background-color: #02ad02;
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
textarea {
    resize: vertical;
}
#userMessage:focus {
    box-shadow: none;
    outline: none;
    border: 1px solid #029e02;
}
</style>
