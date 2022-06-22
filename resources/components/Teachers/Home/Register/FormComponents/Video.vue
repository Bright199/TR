<template>
    <div class="container-jumbotron">
        <div v-if="loading">
            <p class="text-center">Uploading your introduction video</p>
            <p class="text-center">This may take some few seconds or minutes!</p>
        </div>
        <div class="spinner" v-if="loading">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
        <div class="container-jumbotron bg-white rounded-2" v-if="loaded">
            <div class="container-jumbotron d-flex justify-content-center border-bottom">
                <ul class="breadCrumbs">
                    <li class="prevCrumb">
                        About
                        <!-- <i class="fa-solid fa-chevron-right"></i>
                        &nbsp; -->
                    </li>
                    <li class="prevCrumb">Description</li>
                    <li class="prevCrumb">
                        <!-- <i class="fa-solid fa-chevron-right"></i>
                        &nbsp; -->
                        Qualification
                    </li>
                    <li class="activeCrumb">
                        <!-- <i class="fa-solid fa-chevron-right"></i> &nbsp; -->
                        Video
                    </li>
                    <li class="nextCrumb">
                        <i class="fa-solid fa-chevron-right"></i>
                        &nbsp;Availability
                    </li>
                </ul>
            </div>

            <div class="container-jumbotron p-4">
                <div class="row mb-3">
                    <div class="col-md-6 p-3">
                        <h3>
                            Upload introduction video
                            <span class="text-danger" style="font-weight: 550; font-size: 20px">*</span>
                        </h3>
                        <p>
                            Introduce yourself to your prospective students.
                            This will happen you stand out among other teachers.
                        </p>
                        <div class="container">

                            <div class="ratio ratio-16x9 mt-3" v-if="displayVideoUrl !== ''">
                                <video width="320" height="240" controls
                                    :src="'/storage/teacher/videos/' + displayVideoUrl">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="ratio ratio-16x9 mt-3" v-else>
                                <video width="320" height="240" controls class="introVideoPreview">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <label for="intro-video" class="introVideo mt-3"><i
                                    class="fa-solid fa-cloud-arrow-up"></i>CHOOSE
                                VIDEO</label>
                            <input type="file" name="" id="intro-video" @change='uploadIntroVideo'
                                accept="video/mp4,video/x-m4v,video/*" />

                            <div class="container p-3">
                                <ul v-if="showErrors" style="list-style:none;">
                                    <li class='text-danger' v-for="(error, key, index) in showErrors" :key="index">
                                        {{ error[0] }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-3">
                        <h4>Video introduction guidelines.</h4>
                        <p>
                            Watch the demo intro video below to get some ideas.
                        </p>
                        <div class="videContainer">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/iPujtw2eVyk"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 p-3">
                        <h4>Content of your video.</h4>
                        <p>
                            Note that your video should not be more than
                            <span style="color: #029e20; font-weight: 550">2 minutes</span>
                        </p>
                        <h6>Introduce yourself (15-20 seconds)</h6>

                        <ul>
                            <li>Your first name.</li>
                            <li>
                                Where you are from and where you are currently.
                            </li>
                            <li>What languages do you speak.</li>
                        </ul>
                    </div>
                    <div class="col-md-6 p-3">
                        <h6>Focus on teaching (30-50 seconds)</h6>
                        <ul>
                            <li>Talk about your skills and qualifications.</li>
                            <li>What do you teach?</li>
                        </ul>
                        <h6>Ending (15-25 seconds)</h6>
                        <ul>
                            <li>
                                Encourage your potential students to book a
                                lesson with you!
                            </li>
                            <li>Thank them for watching your video.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container-jumbotron p-4 border-top">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="d-grid gap-2">
                            <button class="EditBtn" @click="backToQualification">
                                <i class="fa-solid fa-angles-left"></i> BACK
                            </button>
                            <button class="NextBtn" @click="setHandler">
                                SAVE & CONTINUE
                                <i class="fa-solid fa-angles-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
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
export default {
    name: "Video",
    data() {
        return {
            loading: false,
            loaded: false,
            teacherDetails: "",
            videoFile: '',
            displayVideoUrl: '',
            showErrors: ''
        };
    },
    mounted() {
        this.getTeacherDetails();
    },
    methods: {
        setHandler() {
            if (this.displayVideoUrl === '' || this.displayVideoUrl ===null) {
                this.continueRegistration()
            } else {
                this.$store.commit({
                    type: "setAvailabilityComponent",
                });
            }
        },
        uploadIntroVideo(e) {
            this.displayVideoUrl = ''
            setTimeout(() => {
                const videoFile = e.target.files[0]
                this.videoFile = videoFile
                const videoUrl = URL.createObjectURL(videoFile);
                document.querySelector('.introVideoPreview').src = videoUrl
            }, 500);
        },
        backToQualification() {
            this.$store.commit({
                type: "setQualificationComponent",
            });
        },
        continueRegistration() {
            if (this.videoFile === '') {
                alert('You must upload an introduction video')
                return
            }
            this.loading = true
            this.loaded = false
            const data = new FormData();
            data.append('intro_video', this.videoFile)
            axios.post('/teacher/uploadIntroVideo', data)
                .then(() => {
                    this.loaded = true
                    this.videoFile = ''
                    this.$store.commit({
                        type: "setAvailabilityComponent",
                    });
                })
                .catch((error) => {
                    this.loaded = true
                    if (error.response.status == 422) {
                        this.showErrors = error.response.data.errors
                    }
                    this.videoFile = ''
                })
                .finally(() => {
                    this.loading = false
                })
        },
        getTeacherDetails() {
            this.loading = true;
            axios
                .get("/teacher/getTeacherDetails")
                .then((response) => {
                    this.displayVideoUrl = response.data.intro_video_url
                    this.teacherDetails = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>

<style scoped>
.videContainer {
    display: flex;
    justify-content: center;
    align-items: center;
}

#intro-video {
    display: none;
}

.introVideo {
    padding: 5px 15px 4px;
    border: 1px solid #029e20;
    border-radius: 5px;
    background: #029e20;
    color: white;
}

.introVideo:hover {
    cursor: pointer;
}

.introVideo i {
    color: white;
}

.toolTip {
    font-size: 14px;
}

.toolTip:hover {
    cursor: pointer;
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.form-select:focus {
    outline: none;
    box-shadow: none;
    border: 1px solid #029e02;
}

/* button */
.fa-cloud-arrow-up {
    color: #029e02;
    margin-right: 5px;
}

.editName:hover {
    background: #03b403;
}

.prevCrumb {
    opacity: 0.3;
}

.NextBtn {
    padding: 7px 15px 9px;
    font-size: 17px;
    font-weight: 500;
    border: 1px solid #029e02;
    background: white;
    transition: 0.3s;
    color: #029e02;
    border-radius: 5px;
}

.NextBtn i {
    color: #183153;
}

.NextBtn:hover {
    background: #029e02;
    color: white;
    font-size: 18px;
}

.NextBtn:hover i {
    color: #fed907;
    font-size: 15px;
}

.EditBtn {
    padding: 7px 15px 9px;
    font-size: 17px;
    font-weight: 500;
    background: #029e02;
    transition: 0.3s;
    border: none;
    color: white;
    border-radius: 5px;
}

.EditBtn:hover {
    background: #02aa02;
    color: white;
    font-size: 18px;
}

.EditBtn i {
    color: #fed907;
}

.EditBtn:hover i {
    color: #fed907;
    font-size: 15px;
}

/*  */

.activeCrumb {
    color: #029e02;
    font-weight: 550;
}

.nextCrumb {
    font-weight: 550;
}

.fa-chevron-right {
    font-size: 12px;
}

.activeCrumb:hover {
    cursor: pointer;
}

.breadCrumbs {
    display: flex;
    flex-wrap: wrap;
    padding: 0;
    align-content: center;
}

.breadCrumbs li {
    list-style: none;
    padding: 13px 12px 2px;
}

@media only screen and (max-width: 768px) {
    .breadCrumbs {
        display: flex;
        flex-direction: column;
        padding: 0;
        align-content: center;
    }
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
</style>
