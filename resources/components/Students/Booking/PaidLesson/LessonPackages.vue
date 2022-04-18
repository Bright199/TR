<template>
    <div>
        <div class="container-jumbotron bg-white">
            <Header />
        </div>
        <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <p class="text-center p-3">
                    Available packages for you
                    <span v-if="loading" style="color: #029e20; font-size: 12px"
                        >Loading...</span
                    >
                    <span
                        v-if="loaded"
                        style="font-size: 14px; color: #029e20"
                        >{{ User.name }}</span
                    >
                </p>
                <div class="row LessonPackages">
                    <div
                        class="col-md-3 mb-2 mt-3 shadow-lg LessonPackage LessonPackage-1"
                    >
                        <div class="container p-3 StarterContainer">
                            <p class="text-center text-white">STARTER</p>
                        </div>
                        <div class="container p-0" style="background: #f8f9fa">
                            <p
                                class="text-center"
                                style="font-size: 50px; margin-bottom: 2px"
                            >
                                5
                            </p>
                            <p
                                class="text-center"
                                style="font-size: 40px; margin-top: 2px"
                            >
                                Lessons
                            </p>
                        </div>
                        <p>You will save</p>
                    </div>
                    <div
                        class="col-md-3 mb-2 shadow-lg LessonPackage LessonPackage-2"
                    >
                        <div class="container p-3 ProContainer">
                            <p class="text-center text-white">PRO</p>
                        </div>
                        <div class="container p-0" style="background: #f8f9fa">
                            <p
                                class="text-center"
                                style="font-size: 50px; margin-bottom: 2px"
                            >
                                10
                            </p>
                            <p
                                class="text-center"
                                style="font-size: 40px; margin-top: 2px"
                            >
                                Lessons
                            </p>
                        </div>
                        <div class="container">
                            <p class="text-center">$ {{lessonDetails[1].PRO * teacherDetails.hourly_pay}} billed once</p>
                            <p class="text-center" style="color: #029e20">You save $2}}</p>
                        </div>
                    </div>
                    <div
                        class="col-md-3 mb-2 mt-3 shadow-lg LessonPackage LessonPackage-3"
                    >
                       <div class="container p-3 AdvancedContainer">
                            <p class="text-center text-white">ADVANCED</p>
                        </div>
                        <div class="container p-0" style="background: #f8f9fa">
                            <p
                                class="text-center"
                                style="font-size: 50px; margin-bottom: 2px"
                            >
                                20
                            </p>
                            <p
                                class="text-center"
                                style="font-size: 40px; margin-top: 2px"
                            >
                                Lessons
                            </p>
                        </div>
                    </div>
                    <div class="container">
                        <a href="#"> Buy a custom number of hours</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { mapState } from "vuex";
import Header from "../../Edits/Header.vue";
export default {
    name: "LessonPackages",
    components: { Header },
    props: ["id"],
    data() {
        return {
            User: "",
            loading: false,
            loaded: false,
            teacherDetails:'',
            lessonDetails: [
                {'STARTER': 5},
                {'PRO': 10},
                {'ADVANCED':20}
                
            ]
        };
    },
    mounted() {
        this.getUser();
        this.getTeacherDetails();
    },
    methods: {
        getUser() {
            this.loading = true;
            axios
                .get("/student/getAuthUser")
                .then((response) => {
                    this.User = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getTeacherDetails() {
            axios.get("/student/getSingleTeacher/"+ this.id)
            .then((result) => {
                this.teacherDetails = result.data;
            }).catch((err) => {
                
            });
        }
    },
    // computed: {
    //     ...mapState({
    //         User: (state) => state.loggedUser
    //     })
    // },
};
</script>

<style>
.LessonPackages {
    display: flex;
    justify-content: center;
}
.LessonPackage {
    display: flex;
    /* justify-content: center; */
    /* align-items: center; */
    flex-direction: column;
    align-items: center;
    padding: 0;
    border-radius: 8px;
    background: white;
    margin-right: 3px;
}
.LessonPackage-1 {
    max-height: 450px;
    min-height: 400px;
}
.StarterContainer {
    background: hsla(132, 78%, 25%, 1);

    background: linear-gradient(
        90deg,
        hsla(132, 78%, 25%, 1) 0%,
        hsla(132, 98%, 31%, 1) 100%
    );

    background: -moz-linear-gradient(
        90deg,
        hsla(132, 78%, 25%, 1) 0%,
        hsla(132, 98%, 31%, 1) 100%
    );

    background: -webkit-linear-gradient(
        90deg,
        hsla(132, 78%, 25%, 1) 0%,
        hsla(132, 98%, 31%, 1) 100%
    );
}
.StarterContainer p {
    font-size: 20px;
    margin-bottom: 2px;
}
.ProContainer {
    background: hsla(30, 80%, 48%, 1);

    background: linear-gradient(
        360deg,
        hsla(30, 80%, 48%, 1) 0%,
        hsla(30, 100%, 50%, 1) 100%
    );

    background: -moz-linear-gradient(
        360deg,
        hsla(30, 80%, 48%, 1) 0%,
        hsla(30, 100%, 50%, 1) 100%
    );

    background: -webkit-linear-gradient(
        360deg,
        hsla(30, 80%, 48%, 1) 0%,
        hsla(30, 100%, 50%, 1) 100%
    );
}
.ProContainer p {
    font-size: 20px;
    margin-bottom: 2px;
}

.AdvancedContainer {
    background: hsla(51, 80%, 43%, 1);

    background: linear-gradient(
        360deg,
        hsla(51, 80%, 43%, 1) 0%,
        hsla(51, 100%, 65%, 1) 100%
    );

    background: -moz-linear-gradient(
        360deg,
        hsla(51, 80%, 43%, 1) 0%,
        hsla(51, 100%, 65%, 1) 100%
    );

    background: -webkit-linear-gradient(
        360deg,
        hsla(51, 80%, 43%, 1) 0%,
        hsla(51, 100%, 65%, 1) 100%
    );
}
AdvancedContainer p {
    font-size: 20px;
    margin-bottom: 2px;
}
</style>
