<template>
    <div>
        <div class="container-jumbotron TopBar1">
            <DashboardNavBar />
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h2>Ad creation dashboard</h2>
                    <p class="border-bottom">
                        Find a teacher quicker by creating an ad at
                        <span style="color: #029e02">$2.99 Only</span>
                    </p>
                    <div class="row">
                        <div
                            class="col-md-2 d-flex justify-content-center align-content-center"
                        >
                            <img src="/images/attention.png" alt="attention" />
                        </div>
                        <div class="col-md-9 d-flex justify-content-start">
                            <p>
                                In order to create an a job ad you are required
                                to add your profile image and country in the
                                profile section. You can do this by clicking on
                                your name in the navigation bar and going to the
                                profile section.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 shadow p-4">
                    <form @submit.prevent="submitAd" autocomplete="off">
                        <div class="form-floating mb-3 mt-3">
                            <div class="mb-3 mt-3">
                                <label for="adtitle" class="form-label"
                                    >Title:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="adtitle"
                                    v-model="adtitle"
                                    autofocus
                                    placeholder="Enter ad title"
                                    name="adtitle"
                                />
                                <div v-if="errors.adtitle.length">
                                    <p style="color: red; font-weight: 550">
                                        {{ errors.adtitle }}
                                    </p>
                                </div>
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
                        <div v-if="errors.description.length">
                            <p style="color: red; font-weight: 550">
                                {{ errors.description }}
                            </p>
                        </div>
                        <!-- <QuillEditor theme="snow" toolbar="essential" v-model:content="adBody" contentType="html" .../> -->
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
                            What's your budget range. For example ($3 USD - $5
                            USD)
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
                                    <div v-if="errors.minamount.length">
                                        <p style="color: red; font-weight: 550">
                                            {{ errors.minamount }}
                                        </p>
                                    </div>
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
                                    <div v-if="errors.maxamount.length">
                                        <p style="color: red; font-weight: 550">
                                            {{ errors.maxamount }}
                                        </p>
                                    </div>
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
                                @click="submitAd"
                            >
                                Proceed to payment
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</template>
<script>
import DashboardNavBar from "../DashboardNavBar.vue";
import axios from "axios";
export default {
    name: "StudentAd",
    components: { DashboardNavBar },
    // QuillEditor
    data() {
        return {
            adtitle: "",
            description: "",
            language: "English",
            minamount: "",
            maxamount: "",
            currency: "USD",
            gender: "Male teacher",

            AuthUserDetails: "",
            errors: {
                adtitle: "",
                description: "",
                minamount: "",
                maxamount: "",
            },
        };
    },
    methods: {
        submitAd(e) {
            e.preventDefault();
            if (
                this.AuthUserDetails.user_image === null &&
                this.AuthUserDetails.country === null
            ) {
                alert("Ad a profile image and country by editing your profile");
                return;
            } else {
                if (this.adtitle.trim() === "") {
                    this.errors.adtitle = "This field is required!";
                    setInterval(() => {
                        this.errors.adtitle = "";
                    }, 5000);
                } else if (this.description.trim() === "") {
                    this.errors.description = "This field is required!";
                    setInterval(() => {
                        this.errors.description = "";
                    }, 5000);
                } else if (this.minamount === "") {
                    this.errors.minamount = "This field is required!";
                    setInterval(() => {
                        this.errors.minamount = "";
                    }, 5000);
                } else if (this.maxamount === "") {
                    this.errors.maxamount = "This field is required!";
                    setInterval(() => {
                        this.errors.maxamount = "";
                    }, 5000);
                } else {
                    if (this.maxamount <= this.minamount) {
                        this.errors.maxamount =
                            "Maximum budget can't be the same or less that minimum budget!";
                        setInterval(() => {
                            this.errors.maxamount = "";
                        }, 6000);
                    } else {
                        this.errors.maxamount = "";
                        this.errors.minamount = "";
                        this.errors.description = "";
                        this.errors.adtitle = "";
                        const data = {
                            title: this.adtitle,
                            description: this.description,
                            minamount: this.minamount,
                            maxamount: this.maxamount,
                            currency: this.currency,
                            gender: this.gender,
                            language: this.language,
                        };
                        axios.post("/student/ad/save", data).then(() => {
                            this.adtitle = "";
                            this.description = "";
                            this.minamount = "";
                            this.maxamount = "";
                            // this.$router.push('/student/ad/management')
                            this.$router.push('/student/ad/management') 
                        });
                    }
                }
            }
        },
    },
    mounted() {
        axios.get("/student/getAuthUser").then((response) => {
            this.$store.commit("userDetails", response.data);
            this.AuthUserDetails = response.data;
        });
    },
};
</script>

<style scoped>
.PaymentBtn {
    background-color: #029e02;
    color: white;
}
.PaymentBtn:hover {
    background-color: #04ad04;
    color: white;
}
.btn {
    border-radius: 0;
}

.EditCard {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
}

.fa-solid {
    color: #151419;
}
.NavLinks2 {
    display: flex;
    padding: 10px;
    flex-direction: row;
    /* background-color: #fec107; */
    justify-content: flex-end;
}
.NavLinks2 li {
    list-style: none;
    margin-right: 25px;
    font-size: 20px;
}
.NavLinks2 li a {
    text-decoration: none;
    color: #151419;
}
.NavLinks {
    display: flex;
    padding: 10px;
    flex-direction: row;
    /* background-color: #fec107; */
    justify-content: flex-start;
}
.NavLinks li {
    list-style: none;
    margin-right: 25px;
    font-size: 20px;
}
.NavLinks li a {
    text-decoration: none;
    color: #151419;
}
.LinkItem {
    font-size: 18px;
    color: #151419;
    padding: 2px 10px;
}

.userdropdown {
    position: relative;
    /* display: inline-block; */
}

.userdropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 220px;
    box-shadow: 0px 4px 12px 0px rgba(0, 0, 0, 0.1);
    padding: 12px 16px;
    z-index: 1;
    right: -10px;
    /* top: 50px; */
}
.userdropdown-content a {
    color: #fec107;
    font-size: 18px;
}
.userdropdown-content a:hover {
    color: #fec107;
    /* font-size: 14px; */
}
.userdropdown:hover .userdropdown-content {
    display: block;
}

.UserName {
    color: #151419;
    text-transform: capitalize;
    font-weight: 600;
}
.UserName:hover {
    cursor: pointer;
}
.EditBtn {
    background-color: #029e02;
    color: white;
    font-weight: 600;
    outline: none;
    box-shadow: none;
}
.EditBtn:focus {
    outline: none;
    box-shadow: none;
}
.OutLineRemove:focus {
    outline: none;
    box-shadow: none;
}
input:focus,
select:focus {
    outline: none;
    box-shadow: none;
}
.OutLineRemove {
    background-color: #fec107;
}
.OutLineRemove:hover {
    background-color: #ffcb2efb;
}
.EditBtn:hover {
    background-color: #03b103;
    color: white;
}
.btn:focus,
textarea:focus,
.InputBox:focus {
    outline: none;
    box-shadow: none;
}

.DeleteUser:hover {
    cursor: pointer;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
