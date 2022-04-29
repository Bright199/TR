<template>
    <div>
      <div class="spinner" v-if="loading == true">
          <div class="dot1"></div>
          <div class="dot2"></div>
      </div>
      <!-- Registration container -->
      <div class="container-jumbotron" v-if="teacherDetails.registration_completed ===0">
        <div class="container-jumbotron" v-if="loaded">
          <Register :teacherDetails = "teacherDetails"/>
        </div>
      </div>
      <!-- end of registration -->

      <!-- Your account is under verification -->
      <div class="container-jumbotron" v-else-if="teacherDetails.registration_completed === 1 
      && teacherDetails.account_verified ===0">
         <div class="container-jumbotron bg-white p-2 shadow-sm" v-if="loaded">
            <DashboardNavBar/>
          </div>
        <h2>Your account is under verification</h2>
      </div>

      <!-- end of Your account -->

      <!-- Verified account -->

      <!-- Verified account -->
        <div class="container-jumbotron" v-else>
           <div class="container-jumbotron bg-white p-2 shadow-sm" v-if="loaded">
            <DashboardNavBar/>
          <h2>Verified</h2>
          </div>
        </div>
      <!-- verified account-->
      <!-- {{teacherDetails}} -->
    </div>
</template>

<script>
import axios from "axios";
import DashboardNavBar from './DashboardNavBar.vue';
import Register from './Register/Register.vue';
export default {
  components: { DashboardNavBar, Register },
    name: "TeacherDashboard",
    data() {
        return {
            teacherDetails: "",
            loading: false,
            loaded: false,
        };
    },
    mounted() {
        this.getTeacherDetails();
    },
    methods: {
        getTeacherDetails() {
            this.loading = true;
            axios.get("/teacher/getTeacherDetails").then((response) => {
                this.teacherDetails = response.data;
                this.loaded = true;
            }).finally(()=>{
              this.loading = false
            });
        },
    },
};
</script>

<style></style>
