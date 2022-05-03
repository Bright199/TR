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
                    <li class="activeCrumb">About</li>
                    <li class="nextCrumb">
                        <i class="fa-solid fa-chevron-right"></i>
                        &nbsp;Description
                    </li>
                    <li>
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
            <div class="row p-4" v-if="profilePicCheck ===false">
                <div class="col-md-6">
                    <div class="container p-3">
                        <h3>Profile Photo</h3>
                        <h5>
                            Your profile photo draws students to your profile.
                        </h5>
                        <p>
                            Profiles with good photo have a chance to get
                            student more quicker.
                        </p>
                    </div>

                    <div class="container">
                        <label for="profileImage" id="profileImageLabel"
                            ><i class="fa-solid fa-cloud-arrow-up"></i> &nbsp;
                            UPLOAD PHOTO</label
                        >
                        <p class="mt-1">Maximum 5MB.</p>
                        <p v-if="fileError === true" style="color: #ff3333">
                            Your profile photo is more than 5MB.
                        </p>
                        <input
                            type="file"
                            name="profileImage"
                            id="profileImage"
                            @change="uploadProfileImage"
                            accept="image/*"
                        />
                    </div>

                    <div class="container mt-3">
                        <div class="imageContainer">
                            <div class="innerImageContainer">
                                <img
                                    :src="profilePreview"
                                    alt="profile_image"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-3">
                    <h4>Some guides for a perfect photo.</h4>
                    <div class="container p-2">
                        <ul class="guideLineImages">
                            <li>
                                <img
                                    src="/images/avatar7.png"
                                    alt=""
                                    width="90"
                                />
                            </li>
                            <li>
                                <img
                                    src="/images/avatar6.png"
                                    alt=""
                                    width="90"
                                />
                            </li>
                            <li>
                                <img
                                    src="/images/avatar1.png"
                                    alt=""
                                    width="90"
                                />
                            </li>
                        </ul>
                    </div>

                    <div class="container p-3">
                        <p>
                            <span
                                ><i
                                    class="fa-solid fa-arrow-pointer"
                                    style="color: #029e02"
                                ></i
                            ></span>
                            Smile and face the camera. Your smile sells it at
                            all.
                        </p>
                        <p>
                            <span
                                ><i
                                    class="fa-solid fa-arrow-pointer"
                                    style="color: #029e02"
                                ></i
                            ></span>
                            Frame yourself. Your face should fill most of the
                            image. Not too far, not too close.
                        </p>
                        <p>
                            <span
                                ><i
                                    class="fa-solid fa-arrow-pointer"
                                    style="color: #029e02"
                                ></i
                            ></span>
                            Use a simple background. Use a simple or flat
                            colored background
                        </p>
                        <p>
                            <span
                                ><i
                                    class="fa-solid fa-arrow-pointer"
                                    style="color: #029e02"
                                ></i
                            ></span>
                            No logo, contact information or any writing should
                            appear on your image.
                        </p>
                        <p>
                            <span
                                ><i
                                    class="fa-solid fa-arrow-pointer"
                                    style="color: #029e02"
                                ></i
                            ></span>
                            Use soft, natural light and avoid harsh flashes.
                        </p>
                        <p>
                            <span
                                ><i
                                    class="fa-solid fa-arrow-pointer"
                                    style="color: #029e02"
                                ></i
                            ></span>
                            Be the only person in the picture.
                        </p>
                    </div>
                </div>
                <div
                class="container-jumbotron border-top p-3 d-flex justify-content-end"
            >
                <button class="NextBtn" @click="saveProfileImage">Save and continue</button>
            </div>
            </div>
            <div v-else>
                <div class="container p-3">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 p-2">
                            <img :src="profilePreview" 
                            alt="profile_image" style="width: 100%; height: 100%">
                            <!-- <img :src="'/storage/teacher/images/'+teacherDetails.teacher_image" 
                            alt="profile_image" style="width: 100%; height: 100%"> -->
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="container p-4">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 p-2">
                            <div class="d-grid gap-2">
                                <button class="EditBtn" @click="editProfilePicture">CHANGE PROFILE PICTURE</button>
                                <button class="NextBtn" @click="continueRegistration">CONTINUE REGISTRATION</button>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                
            </div>

            
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "About",
    data() {
        return {
            profileImage: "",
            profilePreview: "/images/avatar3.png",
            imageSize: "",
            fileError: false,
            loading: false,
            loaded: false,
            profilePicCheck: false,
            teacherDetails: '',
        };
    },
    mounted() {
        this.getTeacherDetails()
    },
    methods: {
        continueRegistration(){
            this.$store.commit({
                type: "setDescriptionComponent"
            })
        },
        editProfilePicture(){
            this.profilePreview = '/images/avatar3.png'
            this.profilePicCheck = false
            axios.post('/teacher/deleteTeacherProfilePicture')
            // .finally(() => {
            // })
        },
        getTeacherDetails() {
            this.loading = true
            axios.get('/teacher/getTeacherDetails')
            .then((response)=>{
                this.teacherDetails = response.data;
                if(response.data.teacher_image === '' || response.data.teacher_image === null){
                    this.profilePreview = '/images/avatar3.png'
                    }else{
                    this.profilePreview = '/storage/teacher/images/'+response.data.teacher_image
                    this.profilePicCheck = true
                }
                this.loaded = true
            }).finally(()=>{
                this.loading = false;
            })
        },
        uploadProfileImage(e) {
            const profileImageSize = e.target.files[0].size / 1024 / 1024;
            this.imageSize = profileImageSize.toFixed(2) + "MB";
            if (profileImageSize > 5) {
                this.fileError = true;
                setTimeout(() => {
                    this.fileError = false;
                }, 5000);
            } else {
                this.profileImage = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(this.profileImage);
                reader.onload = (e) => {
                    this.profilePreview = e.target.result;
                };
            }
        },
        saveProfileImage() {
            if (this.profileImage !== "") {
              this.loading = true
              this.loaded = false
                const data = new FormData();
                data.append("profileImage", this.profileImage);
                axios.post("/teacher/saveProfileImage", data, {
                    headers: {
                        "Content-Type": "application/json",
                    },
                }).then((response)=>{
                this.profilePicCheck = true
                this.loaded = true
                })
                .finally(() => {
                  this.loading = false
                });
            } else {
                alert("Profile photo is empty. Photo required!");
            }
        },
    },
};
</script>

<style scoped>
/* button */
.NextBtn {
    padding: 7px 15px 9px;
    font-size: 17px;
    font-weight: 500;
    border: 1px solid #029e02;
    background: white;
    transition: 0.3s;
}
.NextBtn:hover {
    background: #029e02;
    color: white;
}
.EditBtn {
    padding: 7px 15px 9px;
    font-size: 17px;
    font-weight: 500;
    background: #029e02;
    transition: 0.3s;
    border: none;
    color: white;
}
.EditBtn:hover {
    background: #02aa02;
}
/*  */
/* IMAGE UPLOAD */
.guideLineImages {
    padding: 0;
    display: flex;
    flex-flow: row wrap;
    gap: 15px;
    align-items: flex-start;
}
.guideLineImages li {
    list-style: none;
}
.innerImageContainer {
    width: 180px;
    height: 180px;
    background: white;
}
.innerImageContainer img {
  height:100%;
  object-fit: contain;
  width:100%;
}
#profileImage {
    display: none;
}

#profileImageLabel {
    border: 1px solid #029e02;
    padding: 2px 15px 3px;
    border-radius: 3px;
    transition: 0.3s;
}
#profileImageLabel i {
    color: #029e02;
}
#profileImageLabel:hover i {
    color: white;
}
#profileImageLabel:hover {
    background-color: #029e02;
    color: white;
    cursor: pointer;
}
/* END OF IMAGE */

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
