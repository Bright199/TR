<template>
    <div>
        <div class="container-jumbotron TopBar1">
            <Header />
        </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h2>Ad creation dashboard</h2>
                    <p>
                        Find a teacher quicker by creating an ad at $2.99 Only
                    </p>
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
                                    placeholder="Enter ad title"
                                    name="adtitle"
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
                        ></textarea>
                        <!-- <QuillEditor theme="snow" toolbar="essential" v-model:content="adBody" contentType="html" .../> -->
                        <div class="mt-3">
                            <select v-model="language" class="form-select">
                                <option>Language Category</option>
                                <option>French</option>
                                <option>Spanish</option>
                                <option>Arabic</option>
                            </select>
                        </div>
                        <br />
                        <p>What's your budget range. For example ($10-$20)</p>
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
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3 mt-3">
                                    <select
                                        v-model="currency"
                                        class="form-select"
                                    >
                                        <option>USD</option>
                                        <option>EUR</option>
                                        <option>TL</option>
                                        <option>CAD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <p>I'm a</p>
                            <select v-model="gender" class="form-select">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button
                                type="submit"
                                class="btn btn-warning"
                                @click="submitAd"
                            >
                                Post ad
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
import Header from "../Edits/Header.vue";
import axios from "axios";
export default {
    name: "StudentAd",
    components: { Header },
    // QuillEditor
    data() {
        return {
            adtitle: "",
            description: "",
            language: "",
            minamount: "",
            maxamount: "",
            currency: "USD",
            gender: "Male",

            AuthUserDetails: "",
        };
    },
    methods: {
        submitAd() {
            if (
                this.AuthUserDetails.user_image === null &&
                this.AuthUserDetails.country === null
            ) {
                alert("Ad a profile image and country by editing your profile");
                return;
            } else {
                const data = {
                    title: this.adtitle,
                    description: this.description,
                    minamount: this.minamount,
                    maxamount: this.maxamount,
                    currency: this.currency,
                    gender: this.gender,
                };
            }
        },
    },
    mounted() {
        let thisValue = this;
        axios
            .get("/student/getAuthUser")
            .then(function (response) {
                thisValue.$store.commit("userDetails", response.data);
                thisValue.AuthUserDetails = response.data;
                // console.log(response.data)
            })
            .catch(function (error) {
                console.log(error);
            });
    },
};
</script>

<style scoped>
.btn {
    border-radius: 0;
}
.TopBar1 {
    box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -webkit-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -moz-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
}
.EditCard {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
}

.fa-solid {
    color: #fec107;
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
