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
                    <li class="prevCrumb">About 
                      <!-- <i class="fa-solid fa-chevron-right"></i>
                        &nbsp; -->
                        </li>
                    <li class="prevCrumb">
                        Description
                    </li>
                    <li  class="activeCrumb">
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
          
              <div class="container-jumbotron p-4 ">
                <div class="row mb-3">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <h5>Earn a <span style="color: #029e02; font-weight: 550"> verified badge</span> by submitting your certificates.</h5>
                    <p>This is completely optional! You can continue teaching on TREnglish without submitting certificates.</p>
                      <p><span style="color: #029e20; font-weight: 600">NOTE!</span> These document files are not going to be displayed nor stored in our database. They are just for verification purpose only.</p>

                    <h6>Do you have language certificate?</h6>
                    <div class="form-check">
                      <label class="form-check-label" for="lang-certificate">Yes</label>
                      <input class="form-check-input" type="checkbox" id="lang-certificate" name="option1" value="something" >
                     </div>
                     <div class="row">
                        <div class="col-md">
                          <h6>Name of certificate.<span class="text-danger" 
                          style="font-weight: 550; font-size: 20px">*</span></h6>
                          <input type="text" class="form-control" placeholder="Enter name of certificate" name="email">
                        </div>
                        <div class="col-md">
                          <h6>When did you get the certificate?<span class="text-danger" 
                          style="font-weight: 550; font-size: 20px">*</span></h6>
                          <input type="date" name="" id="" class="form-control">
                        </div>
                      </div>
                      <input type="file" name="" id="">
                  </div>
                  <div class="col-md-2"></div>
                </div>
              </div>

              <div class="container-jumbotron p-4 border-top">
                <div class="row mb-3">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <h6>Do you have teaching certificate?</h6>
                    <div class="form-check">
                      <label class="form-check-label" for="teaching-certificate">Yes</label>
                      <input class="form-check-input" type="checkbox" id="teaching-certificate" name="option1" value="something" >
                     </div>
                     <div class="row">
                        <div class="col-md">
                          <h6>Name of certificate.<span class="text-danger" 
                          style="font-weight: 550; font-size: 20px">*</span></h6>
                          <input type="text" class="form-control" placeholder="Enter name of certificate" name="email">
                        </div>
                        <div class="col-md">
                          <h6>When did you get the certificate?<span class="text-danger" 
                          style="font-weight: 550; font-size: 20px">*</span></h6>
                          <input type="date" name="" id="" class="form-control">
                        </div>
                      </div>
                      <input type="file" name="" id="">
                  </div>
                  <div class="col-md-2"></div>
                </div>
              </div>


                <div class="container-jumbotron p-4 border-top">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="d-grid gap-2">
                                <button class="EditBtn" @click="backToDescription"><i class="fa-solid fa-arrow-left"></i> BACK</button>
                                <button class="NextBtn" @click="continueRegistration">SAVE & CONTINUE <i class="fa-solid fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

import axios from "axios";
export default {
    name: "Qualification",
    data() {
        return {
            loading: false,
            loaded: false,
            teacherDetails: '',
            
        };
    },
    mounted() {
        this.getTeacherDetails()
    },
    methods: {
        backToDescription(){
            this.$store.commit({
                type: "setDescriptionComponent"
            })
        },
        continueRegistration(){
            this.$store.commit({
                type:"setVideoComponent"
            })
        },
        getTeacherDetails() {
            this.loading = true
            axios.get('/teacher/getTeacherDetails')
            .then((response)=>{
                this.teacherDetails = response.data;
                this.loaded = true
            }).finally(()=>{
                this.loading = false;
            })
        },
    },
};
</script>

<style scoped>
.toolTip{
    font-size: 14px;
}
.toolTip:hover{
    cursor: pointer;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
.form-select:focus{ 
    outline: none;
    box-shadow: none;
    border: 1px solid #029e02;
}

/* button */

.editName:hover{
  background: #03b403;
}
.prevCrumb{
  opacity: 0.3;
}
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
