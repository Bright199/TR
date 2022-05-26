<template>
    <div>
        <div class="spinner" v-if="loading">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
        <div class="container-jumbotron bg-white rounded-2" v-if="loaded">
            <div
                class="container-jumbotron d-flex justify-content-center border-bottom"
            >
                <ul class="breadCrumbs">
                    <li class="prevCrumb">
                        About
                        <!-- <i class="fa-solid fa-chevron-right"></i>
                        &nbsp; -->
                    </li>
                    <li class="prevCrumb">Description</li>
                    <li class="activeCrumb">
                        <!-- <i class="fa-solid fa-chevron-right"></i>
                        &nbsp; -->
                        Qualification
                    </li>
                    <li class="nextCrumb">
                        <i class="fa-solid fa-chevron-right"></i> &nbsp;Video
                    </li>
                    <li>
                        <i class="fa-solid fa-chevron-right"></i>
                        &nbsp;Availability
                    </li>
                </ul>
            </div>

            <div class="container-jumbotron p-4">
                <div class="row mb-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 border-bottom">
                        <h5>
                            Earn a
                            <span style="color: #029e02; font-weight: 550">
                                verified badge</span
                            >
                            by submitting your certificates.
                        </h5>
                        <p>
                            This is completely optional! You can continue
                            teaching on TREnglish without submitting
                            certificates.
                        </p>
                        <p>
                            <span style="color: #029e20; font-weight: 600"
                                >NOTE!</span
                            >
                            These document files are not going to be displayed
                            nor stored in our database. They are just for
                            verification purpose only.
                        </p>
                    </div>
                    <div class="col-md-2"></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2"></div>
                    <div
                        class="col-md-8"
                        v-if="teacherDetails.has_lang_certificate === 1"
                    >
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h5 class="text-center">
                                    Your language certificate.
                                </h5>
                                <div class="teachingCertificatePreview">
                                    <img
                                        :src="
                                            '/storage/teacher/images/' +
                                            teacherDetails.lang_certificate_doc
                                        "
                                        alt="lang_certificate"
                                    />
                                </div>
                                <div
                                    class="container p-4 d-flex justify-content-center"
                                >
                                    <button
                                        @click="updateLangCertificate"
                                        class="updateLangCertificate"
                                    >
                                        <i
                                            class="fa-solid fa-pen-to-square"
                                        ></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="col-md-8" v-else>
                        <div class="container">
                            <ul v-if="showErrors">
                                <li
                                    v-for="(error, key, index) in showErrors"
                                    :key="index"
                                    class="text-danger"
                                >
                                    {{ error[0] }}
                                </li>
                            </ul>
                        </div>

                        <h6>Do you have language certificate?</h6>
                        <div class="form-check">
                            <label
                                class="form-check-label"
                                for="lang-certificate"
                                >Yes</label
                            >
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="lang-certificate"
                                name="option1"
                                value="something"
                                @change="
                                    langCertificateCheck = !langCertificateCheck
                                "
                            />
                        </div>
                        <div v-if="langCertificateCheck">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <p>
                                            Upload your language certificate.
                                            <span
                                                class="text-danger"
                                                style="
                                                    font-weight: 550;
                                                    font-size: 20px;
                                                "
                                                >*</span
                                            >
                                        </p>

                                        <label
                                            class="form-check-label langCertificate"
                                            for="lang-file"
                                            ><i
                                                class="fa-solid fa-cloud-arrow-up"
                                            ></i
                                            >&nbsp;CHOOSE CERTIFICATE</label
                                        >
                                        <input
                                            type="file"
                                            name="language_certificate_doc"
                                            id="lang-file"
                                            @change="uploadLangCertificate"
                                            accept="image/*"
                                            style="display: none"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        When did you get the certificate?<span
                                            class="text-danger"
                                            style="
                                                font-weight: 550;
                                                font-size: 20px;
                                            "
                                            >*</span
                                        >
                                    </p>
                                    <input
                                        type="date"
                                        name=""
                                        v-model="lang_certificate_year"
                                        id=""
                                        class="form-control"
                                    />
                                </div>

                                <div
                                    v-if="langPreview"
                                    class="border rounded-1 m-4"
                                    style="height: 150px; width: 150px"
                                >
                                    <img
                                        :src="langPreview"
                                        alt=""
                                        style="width: 100%; height: 100%"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>

            <div class="container-jumbotron p-4 border-top">
                <div class="row mb-3">
                    <div class="col-md-2"></div>
                    <div
                        class="col-md-8"
                        v-if="teacherDetails.has_teaching_certificate === 1"
                    >
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h5 class="text-center">
                                    Your teaching certificate.
                                </h5>
                                <div class="langCertificatePreview">
                                    <img
                                        :src="
                                            '/storage/teacher/images/' +
                                            teacherDetails.teaching_certificate_doc
                                        "
                                        alt="teaching_certificate"
                                    />
                                </div>
                                <div
                                    class="container p-4 d-flex justify-content-center"
                                >
                                    <button
                                        @click="updateTeachingCertificate"
                                        class="updateLangCertificate"
                                    >
                                        <i
                                            class="fa-solid fa-pen-to-square"
                                        ></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="col-md-8" v-else>
                        <h6>Do you have teaching certificate?</h6>
                        <div class="form-check">
                            <label
                                class="form-check-label"
                                for="teaching-certificate"
                                >Yes</label
                            >
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="teaching-certificate"
                                name="option1"
                                value="something"
                                @change="
                                    teachingCertificateChecked =
                                        !teachingCertificateChecked
                                "
                            />
                        </div>
                        <div v-if="teachingCertificateChecked">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        Upload your teaching certificate.<span
                                            class="text-danger"
                                            style="
                                                font-weight: 550;
                                                font-size: 20px;
                                            "
                                            >*</span
                                        >
                                    </p>
                                    <div class="form-check">
                                        <label
                                            class="form-check-label langCertificate"
                                            for="teaching-file"
                                            ><i
                                                class="fa-solid fa-cloud-arrow-up"
                                            ></i
                                            >&nbsp; CHOOSE CERTIFICATE</label
                                        >
                                        <input
                                            type="file"
                                            accept="image/*"
                                            name=""
                                            @change="uploadTeachingCertificate"
                                            id="teaching-file"
                                            style="display: none"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        When did you get the certificate?<span
                                            class="text-danger"
                                            style="
                                                font-weight: 550;
                                                font-size: 20px;
                                            "
                                            >*</span
                                        >
                                    </p>
                                    <input
                                        type="date"
                                        name="teaching_certificate_year"
                                        v-model="teaching_certificate_year"
                                        id="teaching_certificate_year"
                                        class="form-control"
                                    />
                                </div>
                                <div
                                    v-if="teachingPreview"
                                    class="border rounded-1 m-4"
                                    style="height: 150px; width: 150px"
                                >
                                    <img
                                        :src="teachingPreview"
                                        alt=""
                                        style="width: 100%; height: 100%"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>

            <div class="container-jumbotron p-4 border-top">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="d-grid gap-2">
                            <button class="EditBtn" @click="backToDescription">
                                <i class="fa-solid fa-angles-left"></i> BACK
                            </button>
                            <button
                                class="NextBtn"
                                @click="continueRegistration"
                            >
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
    name: "Qualification",
    data() {
        return {
            loading: false,
            loaded: false,
            showErrors: "",
            teacherDetails: "",
            lang_certificate_year: "",
            teaching_certificate_year: "",
            langCertificateCheck: false,
            teachingCertificateChecked: false,

            langPreview: "",
            teachingPreview: "",
            langFileImage: "",
            teachingFileImage: "",
            lPrv: "",
            tPrv: "",
        };
    },
    mounted() {
        this.getTeacherDetails();
    },
    methods: {
        updateLangCertificate() {
            // this.loading = true;
            // this.loaded = false;
            axios
                .post("/teacher/updateLangCertificate")
                .then(() => {
                     this.getTeacherDetails();
                })
                // .finally(() => {
                //     this.loading = false;
                //     this.loaded = true;
                // });
        },
        updateTeachingCertificate() {
            // this.loading = true;
            // this.loaded = false;
            axios
                .post("/teacher/updateTeachingCertificate")
                .then(() => {
                    this.getTeacherDetails();
                })
                // .finally(() => {
                //     this.loading = false;
                //     this.loaded = true;
                // });
        },
        uploadLangCertificate(e) {
            this.langFileImage = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.langFileImage);
            reader.onload = (e) => {
                this.langPreview = e.target.result;
            };
        },
        uploadTeachingCertificate(e) {
            this.teachingFileImage = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.teachingFileImage);
            reader.onload = (e) => {
                this.teachingPreview = e.target.result;
            };
        },
        backToDescription() {
            this.$store.commit({
                type: "setDescriptionComponent",
            });
        },
        continueRegistration() {
            if (this.langCertificateCheck && this.teachingCertificateChecked) {
                const data = new FormData();
                data.append("lang_certificate_doc", this.langFileImage);
                data.append(
                    "lang_certificate_year",
                    this.lang_certificate_year
                );
                data.append("teaching_certificate_doc", this.teachingFileImage);
                data.append(
                    "teaching_certificate_year",
                    this.teaching_certificate_year
                );
                data.append("has_docs", "teach_lang");

                axios
                    .post("/teacher/saveTeacherQualification", data)
                    .then(() => {
                        this.$store.commit({
                            type: "setVideoComponent",
                        });
                    })
                    .catch((error) => {
                        if (error.response.status == 422) {
                            this.showErrors = error.response.data.errors;
                        }
                    });
            } else if (this.langCertificateCheck) {
                const data = new FormData();
                data.append("lang_certificate_doc", this.langFileImage);
                data.append(
                    "lang_certificate_year",
                    this.lang_certificate_year
                );
                data.append("has_docs", "lang");
                axios
                    .post("/teacher/saveTeacherQualification", data)
                    .then(() => {
                        this.$store.commit({
                            type: "setVideoComponent",
                        });
                    })
                    .catch((error) => {
                        if (error.response.status == 422) {
                            this.showErrors = error.response.data.errors;
                        }
                    });
            } else if (this.teachingCertificateChecked) {
                const data = new FormData();
                data.append("teaching_certificate_doc", this.teachingFileImage);
                data.append(
                    "teaching_certificate_year",
                    this.teaching_certificate_year
                );
                data.append("has_docs", "teach");
                axios
                    .post("/teacher/saveTeacherQualification", data)
                    .then(() => {
                        this.$store.commit({
                            type: "setVideoComponent",
                        });
                    })
                    .catch((error) => {
                        if (error.response.status == 422) {
                            this.showErrors = error.response.data.errors;
                        }
                    });
            } else {
                this.$store.commit({
                    type: "setVideoComponent",
                });
            }
        },
        getTeacherDetails() {
            this.loading = true;
            axios
                .get("/teacher/getTeacherDetails")
                .then((response) => {
                    this.teacherDetails = response.data;
                    this.lPrv = response.data.lang_certificate_doc;
                    this.tPrv = response.data.teaching_certificate_doc;
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
.teachingCertificatePreview {
    width: 200px;
    height: 200px;
    margin: auto;
}
.langCertificatePreview {
    width: 200px;
    height: 200px;
    margin: auto;
}

.teachingCertificatePreview img {
    width: 100%;
    height: 100%;
    border: 2px solid #f8f9fa;
    padding: 5px;
}
.langCertificatePreview img {
    width: 100%;
    height: 100%;
    border: 2px solid #f8f9fa;
    padding: 5px;
}
.updateLangCertificate {
    background-color: #029e02;
    border: none;
    padding: 5px 15px;
    color: white;
    border-radius: 3px;
}
.langCertificate {
    border: 1px solid #029e02;
    padding: 5px 15px;
    background-color: #029e20;
    color: white;
    border-radius: 3px;
}
.langCertificate i {
    color: white;
}
.langCertificate:hover {
    cursor: pointer;
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
    border-radius: 5px;
    color: #029e20;
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
.NextBtn i {
    color: #183153;
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
.EditBtn i {
    color: #fed907;
}
.EditBtn:hover {
    background: #02aa02;
    font-size: 18px;
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
