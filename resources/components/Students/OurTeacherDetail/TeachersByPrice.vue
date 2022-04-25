<template>
    <div>
       
        <!--  -->
        <div class="m-0 pb-4 OuterContainer">
            <div class="container-jumbotron ps-4">
                <p v-if="teacherLength > 0">
                    <span
                        style="
                            font-size: 25px;
                            font-weight: 550;
                            margin-top: 8px;
                        "
                        >Top results &nbsp;</span
                    >
                    <span v-if="teachers.to"
                        >Showing {{ teachers.to }} of {{ teachers.total }} our
                        teachers</span
                    >
                </p>
            </div>
            <div class="row m-0" v-if="teacherLength > 0">
                <div
                    class="col-md-12 col-lg-12 col-sm-12 HoverTeacher"
                    v-for="teacher in teachers.data"
                    :key="teacher.id"
                >
                    <!-- The Modal -->
                    <div class="modal fade" id="MessageModal">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <p class="modal-title">
                                        <i class="fa-solid fa-message"></i>
                                        {{ teacher.name }}
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

                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="userMessage"
                                            v-model="message"
                                            name="message"
                                            placeholder="Write your message here..."
                                        />
                                        <button
                                            type="submit"
                                            class="SendBtn"
                                            @click="SendMessage(teacher.id)"
                                        >
                                            <i
                                                class="fa-solid fa-paper-plane"
                                               
                                            ></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <div class="row pt-3">
                        <div class="col-md-3 mb-2">
                            <img
                                v-if="teacher.teacher_image !== null"
                                :src="'/images/' + teacher.teacher_image"
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
                            <p style="font-size: 23px; font-weight: 550">
                                {{ teacher.name }}
                                <i class="fa-solid fa-flag-checkered"></i>
                            </p>
                            <!-- <span style="font-size:bolder">Malawi </span> -->
                            <p>
                                <i class="fa-solid fa-chalkboard-user"></i
                                >&nbsp;Teaches English
                            </p>
                            <p>
                                Speaks: <span>{{ teacher.first_language }}</span
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
                                    {{ teacher.description.slice(0, 150) }}
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
                                <div class="col-md-4" style="font-size: 20px">
                                    <!-- <p>
                                        5 <br /><span style="font-size: 13px"
                                            >reviews</span
                                        >
                                    </p> -->
                                </div>
                                <div class="col-md-8" style="font-size: 20px">
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
                                        v-else-if="teacher.currency == 'EUR'"
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
                                        v-else-if="teacher.currency == 'GBP'"
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
                                        v-if="
                                            StudentFavoritesIds.indexOf(
                                                teacher.id
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
                                        @click="addToFavorite(teacher.id)"
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
                                        @click="removeFromFavorite(teacher.id)"
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
                            <br /><br />
                            <!-- Button to Open the Modal -->
                            <a
                                href="#"
                                class="btn d-block FilterBtn"
                                data-bs-toggle="modal"
                                data-bs-target="#MessageModal"
                            >
                                Message
                            </a>
                            <!-- <router-link :to="'/student/single/teacher/'+teacher.id" class="btn d-block FilterBtn">Details</router-link> -->
                            <!-- <a href="" >Details</a -->
                            <br />
                            <a
                                v-if="teacher.is_booked_by_student ===0 || teacher.is_booked_by_student === ''"
                                :href="
                                    '/student/book/demo/lesson/' + teacher.id
                                "
                                class="btn d-block btn-warning mb-3 RemoveOutline"
                                >Book trial lesson</a
                            >
                            <a
                                v-else
                                :href="
                                    '/student/book/paid/lesson/' + teacher.id
                                "
                                class="btn d-block btn-warning mb-3 RemoveOutline"
                                >Buy Hours</a
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
                    <h3 class="text-center">
                       <span>No results found for:</span>
                    </h3>
                    <h5 class="text-center">Teachers between <span style="color: #029e02" >${{minPrice}} - ${{maxPrice}}</span> price range</h5>
                    <h5 class="text-center" v-if="TeacherCountry !== 'Select country'">Teachers from <span style="color: #029e02">{{TeacherCountry}}</span> </h5>
                    <h5 class="text-center" v-if="TeacherLanguage !== 'Select language'"><span style="color: #029e02">{{TeacherLanguage}}</span> speaking teachers.</h5>
                    <p class="text-center">
                        Check again soon for teachers in this section. There are always best teachers here on TREnglish.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <Pagination
                :data="teachers"
                align="right"
                @pagination-change-page="getTeachersByPrice"
            />
        </div>
        <!-- {{teachers}} -->
        <!--  -->
    </div>
</template>
<script>
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

import LaravelVuePagination from "laravel-vue-pagination";
import axios from "axios";
import { mapState } from 'vuex';
export default {
    name: "TeachersByPrice",
    components: { Pagination: LaravelVuePagination },
    data() {
        return {
            teachers: {},
            loaded: false,
            loading2: false,
            teacherLength: 0,
            showShortDescription: true,
            StudentFavoritesIds: "",
            // FavoriteCount: "",
            addedToFavorite: true,
            message: "",
        };
    },
    mounted() {
        this.getTeachersByPrice();
        this.getFavorites();
    },
    methods: {
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
        getTeachersByPrice(page = 1) {
            window.scrollTo(0, 0);
            this.loading2 = true;
            var data = {
              minPrice: this.minPrice,
              maxPrice: this.maxPrice,
              TeacherCountry: this.TeacherCountry,
              TeacherLanguage: this.TeacherLanguage,
            }
            axios
                .post("/student/getTeachersByPrice?page=" + page,data)
                .then((response) => {
                    this.teachers = response.data;
                    if (response.data.data.length > 0) {
                        this.teacherLength = response.data.data.length;
                    } else {
                        this.loaded = true;
                    }
                })
                .finally(() => {
                    this.loading2 = false;
                });
        },
        readMore() {
            this.showShortDescription = false;
        },
        readLess() {
            this.showShortDescription = true;
        },
    },
    computed: {
      ...mapState({
        minPrice: (state) => state.priceRange.minPrice,
        maxPrice: (state) => state.priceRange.maxPrice,
        TeacherCountry: (state) => state.TeacherCountry,
        TeacherLanguage: (state) => state.TeacherLanguage
      })
    },
};
</script>
<style scoped>
.fa-message{
    color: #029e02
}
textarea {
    resize: none;
}
#userMessage:focus {
    box-shadow: none;
    outline: none;
    border: 1px solid #029e02;
}
.SendBtn {
    border: none;
    background-color: #029e02;
    color:white;
    padding: 3px 10px 5px;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}
.SendBtn:hover {
    border: none;
    color: white;
   
}


.SendBtn:hover {
    background-color: #04ad04;
}
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
body {
    color: #183153;
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

.OuterContainer {
    height: 700px;
    overflow-y: auto;
}
</style>
