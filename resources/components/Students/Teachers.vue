<template>
    <div>
        <DashboardNavBar />
        <MessageComponent v-if="modalState === true" />
        <SingleMessageComponent v-if="singleModalState === true" />
        <div class="container">
            <div class="row">
                <div class="col-md-3 me-3 mt-4 shadow-sm LeftBar">
                    <router-link
                        to="/student/teachers"
                        style="background-color: #029e02; color: white"
                        >Our teachers</router-link
                    >
                    <!-- <router-link to="/student/freelance/teachers"
                        >Freelance teachers</router-link
                    > -->
                </div>
                <div class="col-md-8 mb-4 mt-4 shadow-sm">
                    <TeacherDetails />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import DashboardNavBar from "./DashboardNavBar.vue";
import TeacherDetails from "./OurTeacherDetail/TeachersDetails.vue";
import SingleMessageComponent from "./Messages/SingleMessageComponent.vue";
import MessageComponent from "./Messages/MessageComponent.vue";
import { mapState, mapMutations } from "vuex";
export default {
    name: "Teachers",
    components: {
        DashboardNavBar,
        SingleMessageComponent,
        MessageComponent,
        TeacherDetails,
    },
    data() {
        return {
            teachers: {},
            loading2: false,
            loaded: false,
        };
    },
    mounted() {},
    methods: {},
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
.LeftBar {
    height: 250px;
}
.LeftBar a {
    /* background-color: #029e02; */
    padding: 5px;
    color: #151419;
    display: block;
    text-align: center;
    width: 80%;
    margin: auto;
    margin-bottom: 10px;
    text-decoration: none;
    /* color: white; */
    font-size: 20px;
    border: 1px solid #029e02;
}
.LeftBar a:hover {
    background-color: #029e02;
    color: white;
}

.LeftBar :first-child {
    margin-top: 15px;
}

.teacherDetails {
    border-bottom: 1px solid rgb(207, 205, 205);
    margin-left: 3px;
    padding: 15px;
}
.teacherDetails:hover {
    background-color: rgba(185, 185, 185, 0.1);
}
.teacherDetailsLink {
    color: #151419;
    text-decoration: none;
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
.TeachersContainer {
    height: 700px;
    overflow-y: auto;
    overflow-x: hidden;
}
</style>
