<template>
    <div>
        <div class="container-jumbotron TopBar1">
            <DashboardNavBar />
            <BookPaidLesson v-if="showBookPaidLessonComponent ===true" />      
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
                            <td>
                                <i
                                    class="fa-solid fa-pen-to-square"
                                    data-bs-toggle="modal"
                                    data-bs-target="#myModal"
                                    @click="editAd(ad.id)"
                                ></i>
                            </td>
                            <td>
                                <i
                                    class="fa-solid fa-trash"
                                    style="color: #d11a2a"
                                    data-bs-toggle="modal"
                                    data-bs-target="#myModal2"
                                    @click="removeAd(ad.id)"
                                ></i>
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
                        <a href="/student/create/ad" class="createAd">Create ad</a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
        <!-- delete ad -->
        <div class="modal fade" id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: #183153">
                        <p class="modal-title" style="color: white;">Continue deleting this ad?</p>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            style="background: white; color: #029e02"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <button class="btn" @click="deleteAd()" style="background:#029e02; color: white;">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end delete -->
        <!-- Edit Moadel -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="background: #183153">
                        <p class="modal-title">
                            <span
                                style="
                                    color: white;
                                    background: #029e20;
                                    padding: 0px 7px 5px;
                                    border-radius: 3px;
                                "
                                >Editing job ad</span
                            >
                        </p>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            style="background: white; color: #029e02"
                        ></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div v-if="validationErrors">
                            <ul>
                                <li
                                    style="color: red; font-weight: 550"
                                    v-for="(
                                        error, key, index
                                    ) in validationErrors"
                                    :key="index"
                                >
                                    {{ error[0] }}
                                </li>
                            </ul>
                        </div>
                        <form @submit.prevent="submitAd" autocomplete="off">
                            <div class="form-floating mb-3 mt-3">
                                <div class="mb-3 mt-3">
                                    <label for="title" class="form-label"
                                        >Title:</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="title"
                                        v-model="title"
                                        autofocus
                                        placeholder="Enter ad title"
                                        name="title"
                                    />
                                </div>
                            </div>
                            <label for="ad_description">Ad description:</label>
                            <textarea
                                class="form-control"
                                rows="5"
                                id="ad_description"
                                v-model="description"
                                name="ad_description"
                                placeholder="Say something about your ad..."
                            ></textarea>
                            <!-- <div v-if="errors.description.length">
                            <p style="color: red; font-weight: 550">
                                {{ errors.description }}
                            </p>
                        </div> -->
                            <div class="mt-3">
                                <select v-model="language" class="form-select">
                                    <option>English</option>
                                    <option>Spanish</option>
                                    <option>French</option>
                                    <option>Arabic</option>
                                </select>
                            </div>
                            <br />
                            <p>
                                What's your budget range. For example ($3 USD -
                                $5 USD)
                            </p>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 mt-3">
                                        <input
                                            type="number"
                                            class="form-control"
                                            v-model="minamount"
                                            name="minamount"
                                            placeholder="Minimum budget"
                                        />
                                        <!-- <div v-if="errors.minamount.length">
                                        <p style="color: red; font-weight: 550">
                                            {{ errors.minamount }}
                                        </p>
                                    </div> -->
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3 mt-3">
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="maxamount"
                                            v-model="maxamount"
                                            placeholder="Maximum budget"
                                        />
                                        <!-- <div v-if="errors.maxamount.length">
                                        <p style="color: red; font-weight: 550">
                                            {{ errors.maxamount }}
                                        </p>
                                    </div> -->
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3 mt-3">
                                        <select
                                            v-model="currency"
                                            class="form-select"
                                        >
                                            <option>USD</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <p>I'm looking for:</p>
                                <select v-model="gender" class="form-select">
                                    <option>Male teacher</option>
                                    <option>Female teacher</option>
                                    <option>Any teacher</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button
                                    type="submit"
                                    class="btn PaymentBtn"
                                    @click="submitAd(selectedAdId)"
                                >
                                    Save changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of modal -->
    </div>
</template>
<script>
import axios from "axios";
import { mapState, mapMutations } from "vuex";
import DashboardNavBar from "../DashboardNavBar.vue";
import BookPaidLesson from '../Booking/BookPaidLesson.vue';
export default {
    name: "StudentAdManagement",
    components: { DashboardNavBar, BookPaidLesson },
    data() {
        return {
            studentAds: "",
            loading: false,
            loaded: false,
            loading2: false,
            loaded2: false,
            count: 1,
            singleAdInfo: "",
            selectedAdId: 0,

            //
            title: "",
            description: "",
            language: "English",
            minamount: "",
            maxamount: "",
            currency: "USD",
            gender: "",
            validationErrors: "",
            //
        };
    },
    methods: {
        deleteAd(){
            axios.post("/student/deleteAd", {adID: this.selectedAdId})
            .then(()=>{
                location.reload(true);
            })
        },

        removeAd(id){
            this.selectedAdId = id
        },
        submitAd(adID) {
            const data = {
                title: this.title,
                ad_description: this.description,
                language: this.language,
                minamount: this.minamount,
                maxamount: this.maxamount,
                gender: this.gender,
                adID: adID,
            };
            axios
                .post("/student/EditAd", data)
                .then(() => {
                    location.reload(true);
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.validationErrors = error.response.data.errors;
                        // console.log(error.response.data.errors);
                    }
                });
        },
        editAd(id) {
            this.selectedAdId = id;
            axios
                .get("/student/getSingleAd" + id)
                .then((response) => {
                    this.title = response.data[0].title;
                    this.description = response.data[0].description;
                    this.language = response.data[0].language_category;
                    this.minamount = response.data[0].minimum_budget;
                    this.maxamount = response.data[0].maximum_budget;
                    this.gender = response.data[0].student_gender;
                    // this.loaded2 = true;
                })
                .finally(() => {
                    this.loading2 = false;
                });
        },
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
        showBookPaidLessonComponent: (state) => state.showBookPaidLessonComponent
    }),
    mounted() {
        this.getStudentAds();
    },
};
</script>
<style scoped>
.btn:focus {
    outline: none;
}
.fa-solid {
    color: #183153;
}
.fa-solid:hover {
    cursor: pointer;
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

tr:nth-child(even) {
    background-color: #f8f9fa;
}
.MainContainer {
    height: 400px;
    overflow-y: auto;
}
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.PaymentBtn {
    background-color: #029e02;
    color: white;
}
.PaymentBtn:focus {
    outline: none;
    box-shadow: 0;
}
.createAd{
    text-decoration: none;
    padding: 2px 10px 5px;
    border: 1px solid #029e02;
    color: #183153;
}
.createAd:hover{
    background: #029e02;
    color:white
}
</style>
