<template>
    <div>
        <div class="container-jumbotron TopBar1">
            <Header />
        </div>

        <div class="container">
            <div class="row mt-4">
                <!-- <div class="col-md-4"></div> -->
                <div class="col-md-8 EditCard p-4">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-3 p-2 border">
                            <img v-if="AuthUser.user_image === null"
                                src="/images/Green2.png"
                                alt=""
                                style="width: 100%"
                            />
                            <img v-else-if="AuthUser.user_image !== null"
                                :src="'/student/images/'+AuthUser.user_image"
                                alt=""
                                style="width: 100%"
                            />
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 p-2">
                            <p>
                                <span class="UserName">{{
                                    AuthUser.name
                                }}</span>
                            </p>
                            <p>
                                Joined TREnglish on
                                <span
                                    style="font-weight: 700; color: #03b103"
                                    >{{
                                        new Date(DateJoined).getDate() +
                                        "/" +
                                        (new Date(DateJoined).getMonth() + 1) +
                                        "/" +
                                        new Date(DateJoined).getFullYear()
                                    }}</span
                                >
                            </p>
                            <p>{{ AuthUser.email }}</p>
                            <p>
                                Logged in as
                                <span style="font-weight: 700; color: #03b103"
                                    >Student</span
                                >
                            </p>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 p-2">
                            <button
                                class="btn OutLineRemove"
                                data-bs-toggle="modal"
                                data-bs-target="#myModal"
                            >
                                Edit Profile</button
                            ><br />
                            <p
                                class="DeleteUser"
                                data-bs-toggle="modal"
                                data-bs-target="#DeleteModal"
                            >
                                Delete my account
                            </p>
                        </div>
                    </div>
                    <br />
                </div>
                <div class="col-md-4"></div>
            </div>
            <!-- Button to Open the Modal -->
            <!-- <button
                type="button"
                class="btn btn-primary"
                
            >
                Open modal
            </button> -->

            <!-- The Edit Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Editing Profile</h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                            ></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form
                                @submit.prevent="EditUser"
                                enctype="multipart/form-data"
                                method="post"
                            >
                                <div class="mb-3 mt-3">
                                    <label for="username" class="form-label"
                                        >Name:</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control InputBox"
                                        id="username"
                                        name="username"
                                        v-model="AuthUserName"
                                    />
                                </div>
                                <div class="mt-3">
                                    <select
                                        name="country"
                                        v-model="CountryOfOrigin"
                                        class="form-select"
                                    >
                                        <option
                                            v-for="(
                                                country, index
                                            ) in countriesInfo"
                                            :key="index"
                                        >
                                            {{ country.name }}
                                        </option>
                                    </select>
                                </div>
                                <br />
                                <!-- <div class="d-flex justify-content-center">
                                    <ImageCrop />
                                </div> -->
                                <div>
                                    <div
                                        class="container d-flex justify-content-center"
                                        v-if="userImagPreview"
                                    >
                                        <img
                                            :src="userImagPreview"
                                            alt=""
                                            width="150"
                                            height="150"
                                        />
                                    </div>

                                    <label
                                        for="imageProfile"
                                        class="btn btn-light"
                                        ><i class="fa-solid fa-upload"></i
                                        >&nbsp; Upload Image</label
                                    >
                                    <input
                                        type="file"
                                        name="imageProfile"
                                        id="imageProfile"
                                        @change="uploadUserImage"
                                        style="display: none"
                                        accept="image/*"
                                    />
                                </div>
                                <!-- {{countriesInfo}} -->
                                <p class="text-danger" v-if="error !== ''">
                                    {{ error }}
                                </p>

                                <div class="modal-footer">
                                    <button
                                        type="submit"
                                        class="btn btn-warning"
                                        @click="EditUser"
                                    >
                                        Save changes
                                    </button>
                                    <button
                                        ref="DismisBtn"
                                        type="button"
                                        class="btn btn-danger"
                                        data-bs-dismiss="modal"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- The Edit Modal -->
            <div class="modal fade" id="DeleteModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Are you sure you want to delete your account?
                            </h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                            ></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <button
                                ref="DismisBtn"
                                type="button"
                                class="btn btn-warning"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>

                            <button
                                class="btn btn-danger"
                                @click="DeleteUser"
                                style="margin-left: 10px"
                            >
                                Delete account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState, mapMutations } from "vuex";
import Header from "./Edits/Header.vue";
import axios from "axios";
import ImageCrop from "./ImageCrop.vue";
export default {
    name: "EditStudentProfile",
    components: { Header, ImageCrop },
    data() {
        return {
            AuthUserName: "",
            error: "",
            countriesInfo: [],
            CountryOfOrigin: "Afghanistan",

            userImag: "",
            userImagPreview: "",
        };
    },
    mounted() {
        let thisValue = this;
        axios
            .get("/student/getAuthUser")
            .then(function (response) {
                thisValue.$store.commit("userDetails", response.data);
                thisValue.AuthUserName = response.data.name;
            })
            .catch(function (error) {
                console.log(error);
            });

        // Countries
        axios
            .get("https://countriesnow.space/api/v0.1/countries/flag/images")
            .then(function (response) {
                thisValue.countriesInfo = response.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    computed: mapState({
        AuthUser: (state) => state.loggedUser,
        DateJoined: (state) => state.loggedUser.created_at,
    }),
    methods: {
        uploadUserImage(e) {
            this.userImag = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(this.userImag);
            reader.onload = (e) => {
                this.userImagPreview = e.target.result;
            };
        },
        DeleteUser() {
            let thisValue = this;
            const data = {
                user_id: this.AuthUser.id,
            };
            axios
                .post("/student/delete/account")
                .then(function () {
                    {
                        alert("Account deleted successfully");
                        thisValue.$router.push("/student/login");
                    }
                })
                .catch(function (error) {
                    alert("we failed to process your request. Try again later");
                });
        },
        EditUser() {
            if (this.AuthUserName === "") {
                this.error = "Name can not be empty!";
                setInterval(() => {
                    this.error = "";
                }, 40000);
                return;
            }
            if (this.userImag !== "") {
                const userDetails = new FormData();
                userDetails.append("imageProfile", this.userImag);
                userDetails.append("country", this.CountryOfOrigin);
                userDetails.append("username", this.AuthUserName);

                const mypointer = this;
                axios
                    .post("/student/edit", userDetails, {
                        headers: {
                            "Content-Type": "application/json",
                        },
                    })
                    .then(function (response) {
                        const elem = mypointer.$refs.DismisBtn
                        elem.click();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                const userDetails = new FormData();
                userDetails.append("country", this.CountryOfOrigin);
                userDetails.append("username", this.AuthUserName);

                const mypointer = this;
                axios
                    .post("/student/edit", userDetails, {
                        headers: {
                            "Content-Type": "application/json",
                        },
                    })
                    .then(function (response) {
                        const elem = mypointer.$refs.DismisBtn
                        elem.click();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
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
.InputBox:focus {
    outline: none;
    box-shadow: none;
}

.DeleteUser:hover {
    cursor: pointer;
}
</style>
