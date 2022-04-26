<template>
    <div>
        <div class="container-jumbotron">
            <MessageComponent v-if="modalState === true"/>
            <SingleMessageComponent v-if="singleModalState === true" />
        </div>
        <div class="container p-3">
            <div class="spinner" v-if="loading">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <div class="row" v-if="loaded">
                <div class="col-md-3 col-sm-3 col-lg-3 bg-white p-4 TeacherProfile mb-2">
                    <div class="container d-flex justify-content-center justify-items-center">
                        <img v-if="teacherDetails.teacher_image !== null" :src="'/images/'+teacherDetails.teacher_image" alt="teacher_image" class="rounded-circle" width="75" height="75">
                        <img v-else src="/images/avatar.png" alt="teacher_image" class="rounded-circle" width="75" height="75">
                    </div>
                    <p class="text-center">{{ teacherDetails.name}}</p>
                    <div class="container Details">
                        <p>Language <span style="color: #029e20">{{ teacherDetails.first_language}}</span></p>
                        <p>Hourly fee <span style="color: #029e20">${{ teacherDetails.hourly_pay}}/hour</span></p>
                        <p>Language <span style="color: #029e20">{{ teacherDetails.first_language}}</span></p>
                        <p v-if="teacherDetails.online === 1">Online <span style="font-size: 12px; color: #029e20"><i class="fa-solid fa-circle" ></i></span></p>
                        <p v-else>Online <span style="font-size: 12px"><i class="fa-solid fa-circle" ></i></span></p>
                    </div>
                    <div class="container d-flex justify-content-end">
                        <button class="MessageBtn" data-bs-toggle="modal" data-bs-target="#MessageModal">
                            <i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 bg-white mx-3 p-4 mb-2">
                    Teacher's calendar
                </div>
                <div class="col-md-2 col-sm-2 col-lg-2 bg-white p-4">
                    <p class="text-center LeftLink"><router-link to="/student/dashboard">Home</router-link></p>
                    <p class="text-center LeftLink"><router-link to="/student/all/booked/lessons">My Lessons</router-link></p>
                </div>
            </div>
        </div>

        <!-- The Modal -->
            <div class="modal fade" id="MessageModal">
                <div
                    class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                >
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <p class="modal-title">
                                <i class="fa-solid fa-message" style="color: #029e02"></i>
                                {{ teacherDetails.name }}
                            </p>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                id="close"
                            ></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="userMessage"
                                    v-model="message"
                                    name="message"
                                    placeholder="Write your message here..."
                                />
                                <button
                                    type="submit"
                                    class="SendBtn"
                                    @click="
                                        SendMessage(teacherDetails.id)
                                    "
                                >
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Modal footer -->
                    </div>
                </div>
            </div>
            <!-- end of modal -->
    </div>
</template>

<script>
import axios from 'axios';
import MessageComponent from '../../../Messages/MessageComponent.vue';
import SingleMessageComponent from '../../../Messages/SingleMessageComponent.vue';
import { mapState } from 'vuex';
export default {
  components: { MessageComponent, SingleMessageComponent },
    name: "SchedulePaidLesson",
    props: ["id"],
    data() {
        return {
            loading: false,
            loaded: false,
            teacherDetails:'',
            message: ''
        }
    },
    mounted() {
        this.getTeacherDetails()
    },
    methods: {
        // OpenMessageModal() {
        //     this.$store.commit("MessageModalPopup");
        // },
        getTeacherDetails(){
            this.loading = true
            axios.get("/student/getTeacherDetails/"+ this.id)
            .then((response)=>{
                this.teacherDetails = response.data;
                this.loaded = true
            })
            .finally(() => {
                this.loading = false
            })
        },

        SendMessage(teacherId) {
            const message = this.message.trim();
            if (message == "") {
                alert("Message empty");
                return;
            } else if (teacherId == "") {
                alert("select a teacher");
                return;
            } else {
                axios
                    .post("/student/message", { message, teacherId })
                    .then((response) => {
                        // this.$router.push("/student/messages");
                        this.$el.querySelector("#close").click();
                    })
                        this.message = "";
            }
        },
    },
    computed: {
        ...mapState({
            modalState: (state) => state.openModal,
            singleModalState: (state) => state.openSingleModal,
        })
    },
};
</script>

<style scoped>
.MessageBtn{
    border: 1px solid #029e02;
    border-radius: 50%;
    background: white;
    width: 40px;
    height: 40px;
}
.MessageBtn i{
    color: #029e02;
}
.MessageBtn:hover{
    background-color: #029e02;
}
.MessageBtn:hover i{
    color: white;
}
.TeacherProfile{
    height: 350px;
    overflow-y: auto;
}
.SendBtn {
    border: none;
    background-color: #029e02;
    color: white;
    padding: 3px 10px 5px;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}
.SendBtn:hover {
    border: none;
    color: white;
    background-color: #04ad04;
}
.LeftLink{
    background:#04ad04;
    padding: 2px 10px 5px;
    border-radius: 3px;
    margin: 5px auto;
}
.LeftLink a{
    color: white;
    text-decoration: none;
}
.LeftLink:hover {
    background-color: #029e02;
    color: white;
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
