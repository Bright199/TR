<template>
    <div class="bg-light">
        <!-- <div class="container-jumbotron p-2 " style="background-color:#029e02 "></div> -->
        <div class="container-jumbotron">
            <DashboardNavBar />
            <MessageComponent v-if="modalState === true" />
            <SingleMessageComponent v-if="singleModalState === true" />
        </div>
        <!-- @open-message-modal="OpenModal" -->
        <!-- v-if="OpenMessagesModal? $emit('OpenModal'):''" -->
        <div class="container-jumbotron mb-3 p-4" style="background: #183153">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="d-flex justify-content-center text-white">
                                Find a teacher in few minutes by hiring our
                                teachers or by creating an ad
                            </p>
                        </div>
                        <div class="col-md-4">
                            <a class="adLink" href="/student/create/ad" 
                                >Create job advert</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="container-jumbotron">
                <div class="row">
                    <div class="col-md-3 LeftBarStudent">
                        <LeftBar />
                    </div>
                    <div class="col-md-9">
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
import MessageComponent from "./Messages/MessageComponent.vue";
import SingleMessageComponent from "./Messages/SingleMessageComponent.vue";
export default {
    name: "StudentDashboard",
    emits: ["OpenMessageModal"],
    components: {
        NavBar,
        RightBar,
        LeftBar,
        DashboardNavBar,
        MessageComponent,
        SingleMessageComponent,
    },
    data() {
        return {
            trimmedName: {},
            message: "",
        };
    },
    methods: {},
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
    computed: {
        ...mapState({
            modalState: (state) => state.openModal,
            singleModalState: (state) => state.openSingleModal,
            loggedUser: (state) => state.loggedUser,
        }),
    },
};
</script>
<style scoped>
.adLink {
    color: white;
    text-decoration: none;
    background: #029e02;
    padding: 0 12px 3px;
    border-radius: 3px;
}
.adLink:hover {
    color: white;
    background: #03b103;
}
</style>
