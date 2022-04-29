<template>
    <div>
      <div class="container-jumbotron p-2 shadow-sm bg-white">
        <RegisterNav/>
      </div>
      <div class="container p-4 mt-3">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 p-4 bg-white">
            <div class="container border-bottom p-3">

              <h4>Welcome aboard 
                <span style="color: #029e20; font-style: italic;">{{teacherDetails.name }} </span> 
                <i class="fa-solid fa-face-grin" style="color: #fed907"></i>. </h4>
                <p>We are one big family joining people all over the world with various languages.</p>
            </div>

            <div class="container">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 p-3">
                    <p><span><i class="fa-solid fa-magnifying-glass-dollar"></i></span> Earning good money on <span style="color: #029e20">TREnglish</span> is 100% guaranteed.</p>
                    <p><span><i class="fa-solid fa-magnifying-glass-dollar"></i></span> You can earn as much as you like.</p>
                    <p><span><i class="fa-solid fa-magnifying-glass-dollar"></i></span> You don't have to worry about how to start teaching here because we will guide you through.</p>
                </div>
                <div class="col-md-2"></div>
              </div>
            </div>

            <div class="container border-top">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 p-3">
                    <h2>REGISTER AS A TEACHER.</h2>
                    <div class="container d-flex justify-content-center">
                    <router-link to="/teacher/registration/form" class="RegistrationLink">Register</router-link>
                    </div>
                </div>
                <div class="col-md-2"></div>
              </div>
            </div>

          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
</template>

<script>
import RegisterNav from './RegisterNav.vue';
export default {
  components: { RegisterNav },
    name: "Register",
    props: ["teacherDetails"],
    data() {
      return {
        
      }
    },

};
</script>

<style scoped>
.RegistrationLink{
  text-decoration: none;
  padding: 2px 15px 5px;
  border: 1px solid #029e02;
  border-radius: 3px;
  background: #029e02;
  color: white;
  width: 50%;
  text-align: center;
  font-size: 16px;
}
.RegistrationLink:hover{
  background-color: #04b304;
}

</style>
