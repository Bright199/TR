<template>
    <div>
        <!-- <div class="container-jumbotron p-2 " style="background-color:#029e02 "></div> -->
        <DashboardNavBar />
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                    <p class="d-flex justify-content-center" style="font-size:20px;margin-bottom:0px">
                        Find a teacher in few minutes by hiring our teachers or
                        by creating an ad &nbsp;
                    </p><a class="d-flex justify-content-center" href="/student/create/ad" style="margin-top:0px">post an ad</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="container-jumbotron">
                <div class="row">
                    <div class="col-md-3 LeftBarStudent">
                        <LeftBar />
                    </div>
                    <div class="col-md-9 ml-5">
                        <RightBar />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import NavBar from "./NavBar.vue";
import RightBar from "./RightBar.vue";
import LeftBar from "./LeftBar.vue";
import { mapState, mapMutations } from "vuex";
import DashboardNavBar from "./DashboardNavBar.vue";
import axios from "axios";
export default {
    name: "StudentDashboard",
    components: { NavBar, RightBar, LeftBar, DashboardNavBar },
    data() {
        return {
            trimmedName: {},
        };
    },
    mounted() {
        let thisValue = this;
        axios
            .get("/student/getAuthUser", {
                headers: {
                    "Content-Type": "application/json",
                },
            })
            .then(function (response) {
                thisValue.$store.commit("userDetails", response.data);
                thisValue.trimmedName = response.data;
                // console.log(response.data)
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    computed: mapState({
        loggedUser: (state) => state.loggedUser,
    }),
    // methods: {},
};
</script>
