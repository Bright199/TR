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
                    <li class="prevCrumb">About</li>
                    <li class="activeCrumb">Description</li>
                    <li class="nextCrumb">
                        <i class="fa-solid fa-chevron-right"></i>
                        &nbsp;Qualification
                    </li>
                    <li>
                        <i class="fa-solid fa-chevron-right"></i> &nbsp;Video
                    </li>
                    <li>
                        <i class="fa-solid fa-chevron-right"></i>
                        &nbsp;Availability
                    </li>
                </ul>
            </div>
            <div class="container p-4">
                <h3>Describe Yourself!</h3>
                <h5>
                    Tell students who you are. Students read your personal
                    details to know you better.
                </h5>
                <p>
                    Make use of this section to talk about your Achievements,
                    Teaching techniques, Skills, Experience etc
                </p>
            </div>
            <form @submit.prevent>
                <div class="container-jumbotron p-4 border-top mt-3">
                    <div v-if="showErrors">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <p >Correct the following errors.</p>
                                <ul>
                                    <li
                                        v-for="(
                                            error, key, index
                                        ) in showErrors"
                                        :key="index"
                                        class="text-danger"
                                    >
                                        {{ error[0] }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <!-- DESCRIPTION FORM -->

                            <!-- USER NAME -->
                            <label for="name"
                                ><span style="color: #029e02; font-weight: 550"
                                    >NOTE</span
                                >
                                This name will be used to verify your
                                identification documents.</label
                            >
                            <div class="input-group mb-3">
                                <input
                                    type="text"
                                    class="form-control userName"
                                    disabled
                                    name="teacher_name"
                                    v-model="teacher_name"
                                />
                                <button
                                    type="button"
                                    @click="editName"
                                    class="editName"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </div>
                            <!--END USER NAME -->

                            <!-- Description -->
                            <div class="mb-3">
                                <label
                                    for="personal_description"
                                    class="form-label"
                                    ><h6>
                                        Describe yourself (100 - 1000
                                        characters).
                                        <span
                                            class="text-danger"
                                            style="
                                                font-weight: 550;
                                                font-size: 20px;
                                            "
                                            >*</span
                                        >
                                    </h6></label
                                >
                                <textarea
                                    class="form-control"
                                    id="personal_description"
                                    rows="12"
                                    name="personal_details"
                                    v-model="personal_description"
                                    placeholder="Example-I am an English Confidence Coach. I have a wide range of experience teaching english... "
                                ></textarea>
                            </div>
                            <!-- End of description -->

                            <!-- Language to teach -->
                            <div class="row g-2 mb-3">
                                <h6>
                                    Language you want to teach.<span
                                        class="text-danger"
                                        style="
                                            font-weight: 550;
                                            font-size: 20px;
                                        "
                                        >*</span
                                    >
                                </h6>
                                <div class="col-md">
                                    <select
                                        class="form-select"
                                        v-model="first_language"
                                        name="first_language"
                                        id="first_language"
                                        @change="SelectFirstLanguage"
                                    >
                                        <option disabled value="First language">
                                            Select language
                                        </option>
                                        <option
                                            v-for="(
                                                first_language, index
                                            ) in languages"
                                            :key="index"
                                            :value="first_language"
                                        >
                                            {{ first_language }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <select
                                        class="form-select"
                                        v-model="first_language_proficiency"
                                        name="first_language_proficiency"
                                        id="first_language_proficiency"
                                        @change="SelectFirstLanguageProficiency"
                                    >
                                        <option
                                            disabled
                                            value="First language proficiency"
                                        >
                                            Select proficiency
                                        </option>
                                        <option
                                            v-for="(
                                                first_language_proficiency,
                                                index
                                            ) in proficiency_levels"
                                            :key="index"
                                            :value="first_language_proficiency"
                                        >
                                            {{ first_language_proficiency }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- End of language to teach -->

                            <!-- End of Description form -->
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <div class="container-jumbotron p-4 border-top">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <!-- OTHER LANGUAGES -->

                            <h6>
                                Other languages (<span style="color: #029e02"
                                    >Optional</span
                                >)
                            </h6>
                            <p style="margin-top: 0; margin-bottom: 0">
                                You can include other languages you know to
                                build more trust with your students.
                            </p>
                            <br />
                            <div class="form-group form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="secondLanguage"
                                    name="secondLanguage"
                                    @change="secondLanguage"
                                />
                                <label
                                    class="form-check-label"
                                    for="secondLanguage"
                                    >Do you speak
                                    <span style="text-color: #029e20"
                                        >second language</span
                                    >
                                    (check if yes)?</label
                                >
                            </div>
                            <div
                                class="row g-2 mb-3"
                                v-if="secondLanguageChecked"
                            >
                                <div class="col-md">
                                    <select
                                        class="form-select"
                                        v-model="second_language"
                                        name="second_language"
                                        id="second_language"
                                        @change="SelectSecondLanguage"
                                    >
                                        <option
                                            disabled
                                            value="Second language"
                                        >
                                            Second language
                                        </option>
                                        <option
                                            v-for="(
                                                second_language, index
                                            ) in languages"
                                            :key="index"
                                            :value="second_language"
                                        >
                                            {{ second_language }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <select
                                        class="form-select"
                                        v-model="second_language_proficiency"
                                        id="second_language_proficiency"
                                        name="second_language_proficiency"
                                        @change="
                                            SelectSecondLanguageProficiency
                                        "
                                    >
                                        <option
                                            disabled
                                            value="Second language proficiency"
                                        >
                                            Proficiency
                                        </option>
                                        <option
                                            v-for="(
                                                proficiency_level, index
                                            ) in proficiency_levels"
                                            :key="index"
                                            :value="proficiency_level"
                                        >
                                            {{ proficiency_level }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- END OF OTHER LANGUAGES -->
                            <!-- OTHER LANGUAGES -->
                            <div class="form-group form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="thirdLanguageCheck"
                                    name="thirdLanguage"
                                    @change="thirdLanguage"
                                />
                                <label
                                    class="form-check-label"
                                    for="thirdLanguageCheck"
                                    >Do you have
                                    <span style="text-color: #029e20"
                                        >third language</span
                                    >
                                    (check if yes)?</label
                                >
                            </div>
                            <div
                                class="row g-2 mb-3 thirdLanguageContainer"
                                v-if="thirdLanguageChecked"
                            >
                                <div class="col-md">
                                    <select
                                        class="form-select"
                                        v-model="third_language"
                                        name="third_language"
                                        id="third_language"
                                        @change="SelectThirdLanguage"
                                    >
                                        <option disabled value="Third language">
                                            Third language
                                        </option>
                                        <option
                                            v-for="(
                                                third_language, index
                                            ) in languages"
                                            :key="index"
                                            :value="third_language"
                                        >
                                            {{ third_language }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <select
                                        class="form-select"
                                        v-model="third_language_proficiency"
                                        id="third_language_proficiency"
                                        name="third_language_proficiency"
                                        @change="SelectThirdLanguageProficiency"
                                    >
                                        <option
                                            disabled
                                            value="Third language proficiency"
                                        >
                                            Proficiency
                                        </option>
                                        <option
                                            v-for="(
                                                third_language_proficiency,
                                                index
                                            ) in proficiency_levels"
                                            :key="index"
                                            :value="third_language_proficiency"
                                        >
                                            {{ third_language_proficiency }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- END OF OTHER LANGUAGES -->
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <!-- NATIONALITY & HOURLY PAY -->
                <div class="container-jumbotron p-4 border-top">
                    <div class="row mb-3">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h5>
                                Your nationality.<span
                                    class="text-danger"
                                    style="font-weight: 550; font-size: 20px"
                                    >*</span
                                >
                            </h5>
                            <select
                                class="form-select"
                                @change="selectNationality"
                                v-model="nationality"
                                name="nationality"
                            >
                                <option disabled value="Select country">
                                    Select country
                                </option>
                                <option
                                    v-for="(nationality, index) in countries"
                                    :key="index"
                                    id="nationality"
                                    :value="{
                                        nationality: nationality.name,
                                        flag: nationality.flag,
                                    }"
                                >
                                    {{ nationality.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2"></div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h5>
                                What is your hourly fee?
                                <span
                                    class="text-danger"
                                    style="font-weight: 550; font-size: 20px"
                                    >*</span
                                >
                                <span
                                    class="toolTip"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="How much do you charge for each hour of lesson?"
                                    ><i class="fa-solid fa-circle-question"></i
                                ></span>
                            </h5>
                            <div class="input-group mb-3">
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="hourly_pay"
                                    name="hourly_pay"
                                    placeholder="Enter your hourly fee"
                                />
                                <span
                                    class="input-group-text"
                                    id="basic-addon2"
                                    style="background: #029e02; color: white"
                                    >USD</span
                                >
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <!-- NATIONALITY & HOURLY PAY -->

                <div class="container-jumbotron p-4 border-top">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="d-grid gap-2">
                                <button
                                    class="EditBtn"
                                    @click="backToProfilePic"
                                >
                                    <i class="fa-solid fa-angles-left"></i> BACK
                                </button>
                                <button
                                    type="button"
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
            </form>
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
    name: "Description",
    data() {
        return {
            loading: false,
            loaded: false,
            teacherDetails: "",
            countries: "",
            languages: [
                "Arabic",
                "Bengali",
                "Catalan",
                "Croatian",
                "Czech",
                "Danish",
                "Dutch",
                "English",
                "French",
                "German",
                "Greek",
                "Hebrew",
                "Hindi",
                "Hungarian",
                "Indonesian",
                "Italian",
                "Japanese",
                "Latin",
                "Norwegian",
                "Persian",
                "Polish",
                "Portugese",
                "Romanian",
                "Russian",
                "Serbian",
                "Spanish",
                "Swahili",
                "Swedish",
                "Thai",
                "Turkish",
                "Ukranian",
            ],
            proficiency_levels: [
                "Beginner",
                "Elementary",
                "Intermediate",
                "Upper Intermediate",
                "Advanced",
                "Native",
            ],
            showErrors: "",
            teacher_name: "",
            thirdLanguageChecked: false,
            secondLanguageChecked: false,
            nationality: "Select country",
            personal_description: "",
            hourly_pay: "",
            first_language: "",
            first_language_proficiency: "",
            second_language: "",
            second_language_proficiency: "",
            third_language: "",
            third_language_proficiency: "",
        };
    },
    mounted() {
        this.getTeacherDetails();
        this.getCountryApi();
    },
    methods: {
        secondLanguage() {
            if (this.thirdLanguageChecked === false) {
                this.secondLanguageChecked = !this.secondLanguageChecked;
            } else {
                this.thirdLanguageChecked = !this.thirdLanguageChecked;
                document.querySelector("#thirdLanguageCheck").checked = false;
                this.secondLanguageChecked = !this.secondLanguageChecked;
            }
        },
        thirdLanguage() {
            if (this.secondLanguageChecked === false) {
                alert("Must choose second langauge before third langauge");
                document.querySelector("#thirdLanguageCheck").checked = false;
            } else {
                this.thirdLanguageChecked = !this.thirdLanguageChecked;
            }
        },
        backToProfilePic() {
            this.$store.commit({
                type: "setAboutComponent",
            });
        },
        continueRegistration() {
            if (this.secondLanguageChecked && this.thirdLanguageChecked) {
                const data = {
                    nationality: this.nationality.nationality,
                    teacher_name: this.teacher_name,
                    flag: this.nationality.flag,
                    first_language: this.first_language,
                    first_language_proficiency: this.first_language_proficiency,
                    second_language: this.second_language,
                    second_language_proficiency:
                        this.second_language_proficiency,
                    third_language: this.third_language,
                    third_language_proficiency: this.third_language_proficiency,
                    personal_description: this.personal_description,
                    hourly_pay: this.hourly_pay,
                    extra_language: "Two",
                };
                axios
                    .post("/teacher/saveTeacherDescription", data)
                    .then(() => {
                        this.$store.commit({
                            type: "setQualificationComponent",
                        });
                    })
                    .catch((error) => {
                        if (error.response.status == 422) {
                            this.showErrors = error.response.data.errors;
                        }
                    });
            } else if (this.secondLanguageChecked) {
                const data = {
                    nationality: this.nationality.nationality,
                    flag: this.nationality.flag,
                    teacher_name: this.teacher_name,
                    first_language: this.first_language,
                    first_language_proficiency: this.first_language_proficiency,
                    second_language: this.second_language,
                    second_language_proficiency:
                        this.second_language_proficiency,
                    personal_description: this.personal_description,
                    hourly_pay: this.hourly_pay,
                    extra_language: "One",
                };
                axios
                    .post("/teacher/saveTeacherDescription", data)
                    .then(() => {
                        this.$store.commit({
                            type: "setQualificationComponent",
                        });
                    })
                    .catch((error) => {
                        if (error.response.status == 422) {
                            this.showErrors = error.response.data.errors;
                        }
                    });
            } else {
                const data = {
                    nationality: this.nationality.nationality,
                    teacher_name: this.teacher_name,
                    flag: this.nationality.flag,
                    first_language: this.first_language,
                    first_language_proficiency: this.first_language_proficiency,
                    personal_description: this.personal_description,
                    hourly_pay: this.hourly_pay,
                    extra_language: "",
                };
                axios
                    .post("/teacher/saveTeacherDescription", data)
                    .then(() => {
                        this.$store.commit({
                            type: "setQualificationComponent",
                        });
                    })
                    .catch((error) => {
                        if (error.response.status == 422) {
                            this.showErrors = error.response.data.errors;
                        }
                    });
            }
        },
        selectNationality() {},
        getCountryApi() {
            axios
                .get(
                    "https://countriesnow.space/api/v0.1/countries/flag/images"
                )
                .then((response) => {
                    this.countries = response.data.data;
                });
        },
        editName() {
            this.$el.querySelector(".userName").disabled = false;
            this.$el.querySelector(".userName").focus();
        },
        getTeacherDetails() {
            this.loading = true;
            axios
                .get("/teacher/getTeacherDetails")
                .then((response) => {
                    this.teacherDetails = response.data;
                    this.teacher_name = response.data.name;
                    this.personal_description = response.data.description;
                    this.first_language = response.data.first_language;
                    this.first_language_proficiency =
                        response.data.first_language_proficiency;
                    this.second_language = response.data.second_language;
                    this.second_language_proficiency =
                        response.data.second_language_proficiency;
                    this.third_language = response.data.third_language;
                    this.third_language_proficiency =
                        response.data.third_language_proficiency;
                    this.hourly_pay = response.data.hourly_pay;
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
.editName {
    border: none;
    background: #029e02;
    color: white;
    padding: 0px 15px 1px;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
    transition: 0.3s;
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
    border-radius: 5px;
    transition: 0.3s;
    color: #029e02;
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
.EditBtn:hover {
    background: #02aa02;
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
