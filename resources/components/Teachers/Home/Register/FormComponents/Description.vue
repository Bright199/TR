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
                    <li class="activeCrumb">
                        Description
                    </li>
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
                  Tell students who you are. Students read your personal details to know you better.
              </h5>
              <p>Make use of this section to talk about your Achievements, Teaching techniques, Skills, Experience etc</p>
            </div>

            <div class="container-jumbotron p-4 border-top mt-3">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <!-- DESCRIPTION FORM -->

                  <!-- USER NAME -->
                  <label for="name"><span style="color: #029e02; 
                  font-weight: 550">NOTE</span> This name will be used to verify your identification documents.</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control userName" :value="teacherDetails.name" disabled>
                    <button type="button" @click="editName" class="editName"><i class="fa-solid fa-pen-to-square"></i></button>
                  </div>
                  <!--END USER NAME -->

                    <!-- Description -->
                  <div class="mb-3">
                    <label for="personal_description" class="form-label"><h6>Describe yourself (100 - 300 characters). <span class="text-danger" 
                    style="font-weight: 550; font-size: 20px">*</span></h6></label>
                    <textarea class="form-control" id="personal_description" rows="4" placeholder="Example-I am an English Confidence Coach. I have a wide range of experience teaching english... "></textarea>
                  </div>
                  <!-- End of description -->

                  <!-- Language to teach -->
                  <div class="row g-2 mb-3">
                      <h6>Language to teach.<span class="text-danger" 
                    style="font-weight: 550; font-size: 20px">*</span></h6>
                      <div class="col-md">
                          <select
                              class="form-select"
                              v-model="first_language"
                              @change="SelectFirstLanguage"
                          >
                              <option disabled value="First language">Select language</option>
                              <option>Arabic</option>
                              <option>Bengali</option>
                              <option>Chinese</option>
                              <option>English</option>
                              <option>French</option>
                              <option>German</option>
                              <option>Greek</option>
                              <option>Hebrew</option>
                              <option>Hindi</option>
                              <option>Indonesian</option>
                              <option>Italian</option>
                              <option>Japanese</option>
                              <option>Polish</option>
                              <option>Portugese</option>
                              <option>Romanian</option>
                              <option>Russian</option>
                              <option>Spanish</option>
                              <option>Turkish</option>
                          </select>
                      </div>  
                      <div class="col-md">
                        <select class="form-select" 
                         v-model="first_language_proficiency"
                          @change="SelectFirstLanguageProficiency"
                        >
                          <option disabled value="First language proficiency">Select proficiency</option>
                          <option value="Beginner">Beginner</option>
                          <option value="Elementary">Elementary</option>
                          <option value="Intermediate">Intermediate</option>
                          <option value="Upper Intermediate">Upper Intermediate</option>
                          <option value="Advanced">Advanced</option>
                          <option value="Native Speaker">Native</option>
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
                      <div class="row g-2 mb-3">
                        <h6>Other languages</h6>
                        <p style="margin-top: 0; margin-bottom:0">You can include other languages you know to build more trust with your students.</p>
                        <div class="col-md">
                          <select
                              class="form-select"
                              v-model="second_language"
                              @change="SelectSecondLanguage"
                          >
                              <option disabled value="Second language">Select language</option>
                              <option>Arabic</option>
                              <option>Bengali</option>
                              <option>Chinese</option>
                              <option>English</option>
                              <option>French</option>
                              <option>German</option>
                              <option>Greek</option>
                              <option>Hebrew</option>
                              <option>Hindi</option>
                              <option>Indonesian</option>
                              <option>Italian</option>
                              <option>Japanese</option>
                              <option>Polish</option>
                              <option>Portugese</option>
                              <option>Romanian</option>
                              <option>Russian</option>
                              <option>Spanish</option>
                              <option>Turkish</option>
                          </select>
                        </div>
                        <div class="col-md">
                        <select class="form-select" 
                         v-model="second_language_proficiency"
                          @change="SelectSecondLanguageProficiency"
                        >
                          <option disabled value="Second language proficiency">Select proficiency</option>
                          <option value="Beginner">Beginner</option>
                          <option value="Elementary">Elementary</option>
                          <option value="Intermediate">Intermediate</option>
                          <option value="Upper Intermediate">Upper Intermediate</option>
                          <option value="Advanced">Advanced</option>
                          <option value="Native Speaker">Native</option>
                        </select>
                      </div>
                      </div>
                    <!-- END OF OTHER LANGUAGES -->
                </div>
                <div class="col-md-2"></div>
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
            loading: false,
            loaded: false,
            teacherDetails: '',

            first_language: 'First language',
            first_language_proficiency: 'First language proficiency',
            second_language: 'Second language',
            second_language_proficiency: 'Second language proficiency',
        };
    },
    mounted() {
        this.getTeacherDetails()
    },
    methods: {
      editName(){
        this.$el.querySelector(".userName").disabled = false
        this.$el.querySelector(".userName").focus()
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
.form-select:focus{ 
    outline: none;
    box-shadow: none;
    border: 1px solid #029e02;
}

/* button */
.editName{
  border: none;
  background: #029e02;
  color: white;
  padding: 0px 15px 1px;
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
  transition: 0.3s
}
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
