<template>
    <div>
        <!--  Messaging component-->
        <div class="MessageContainer shadow">
            <div class="container">
                <p class="d-flex justify-content-center p-3 border-bottom">
                    Messages
                </p>
                <p class="CloseBtn">
                    <i
                        class="fa-solid fa-xmark"
                        @click="CloseSingleMessageContainer"
                    ></i>
                </p>
            </div>
            <div class="container Messages bg-white" id="MessageContainer">
                <ul class="Chats">
                    <div v-if="TeacherStudentChats.length == ''">
                        <div class="spinner" v-if="loading == true">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                        <li
                            v-if="TeacherStudentChats"
                            class="d-flex justify-content-center mt-5"
                        >
                            No messages yet
                        </li>
                    </div>
                    <div v-else>
                        <div class="spinner" v-if="!TeacherStudentChats ">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                        <div v-if="TeacherStudentChats.length">
                            <li
                                v-for="(message, index) in TeacherStudentChats"
                                :key="index"
                                :class="
                                    message.to !== AuthUser.id
                                        ? 'SenderMessage'
                                        : 'ReceivedMessage'
                                "
                            >
                                <p>
                                    {{ message.message }}
                                </p>
                                <p
                                    :class="
                                        message.to !== AuthUser.id
                                            ? 'SendersMessageTime'
                                            : 'ReceiversMessageTime'
                                    "
                                >
                                    {{ dateTime(message.created_at) }}
                                </p>
                            </li>
                        </div>
                    </div>
                </ul>
            </div>
            <div class="input-group" style="position: absolute; bottom: 0">
                <input
                    type="text"
                    class="form-control"
                    id="userMessage"
                    v-model="userMessage"
                    name="userMessage"
                    placeholder="Write your message here..."
                />
                <button type="submit" class="SendBtn" @click="SendMessage()">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
            <!-- teacher.id -->
        </div>
        <!-- end of messaging componet -->
        <!-- ; playSound('/audios/sent.mp3') -->
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import { mapState } from "vuex";
export default {
    name: "SingleMessageComponent",
    data() {
        return {
            userMessage: ''
        };
    },
    mounted() {
        const container = this.$el.querySelector("#MessageContainer");
        container.scrollTop = container.scrollHeight;
        // this.getMessageContacts();
    },
    methods: {
        //  playSound(url) {
        //     const audio = new Audio(url);
        //     audio.play();
        // },
        SendMessage() {
            const trimmedMessage = this.userMessage.trim();
            if (trimmedMessage == "") {
                alert("Can not send empty message");
                return;
            } 
            this.TeacherStudentChats.push({
                message: trimmedMessage,
                created_at: new Date(),
            });
            const data = {
                message: trimmedMessage,
                teacherId: this.teacherId,
            };
            setTimeout(() => {
                           const container = this.$el.querySelector("#MessageContainer")
                            container.scrollTop = container.scrollHeight
                        }, 500);
            axios.post("/student/message", data);
            this.userMessage = "";
        },
        CloseSingleMessageContainer() {
            this.$store.commit("SingleMessageModalClose");
        },
        dateTime(value) {
            return moment(value).format("MMMM Do, H:mm");
            // moment(value).startOf().fromNow()
        },
    },
    computed: {
        ...mapState({
            TeacherStudentChats: (state) => state.TeacherStudentChats,
            AuthUser: (state) => state.loggedUser,
            teacherId: (state) => state.teacherId,
        }),
    },
};
</script>

<style scoped>
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    .MessageContainer {
    z-index: 2;
    position: fixed;
    width: 100%;
    bottom: 0px;
    right: 0;
    height: 500px;
    background-color: white;
}
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
.MessageContainer {
    z-index: 2;
    position: fixed;
    width: 100%;
    bottom: 0px;
    right: 0;
    height: 500px;
    background-color: white;
}
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
.MessageContainer {
    z-index: 2;
    position: fixed;
    width: 54%;
    bottom: 0px;
    right: 0;
    height: 500px;
    background-color: white;
}
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
.MessageContainer {
    z-index: 2;
    position: fixed;
    width: 27%;
    bottom: 0px;
    right: 0;
    height: 500px;
    background-color: white;
}
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
.MessageContainer {
    z-index: 2;
    position: fixed;
    width: 27%;
    bottom: 0px;
    right: 0;
    height: 500px;
    background-color: white;
}
}
.Chats li{
list-style: none;
}
.ReceiversMessageTime {
    font-size: 12px;
    color: #979797;
    margin-top: -10px;
}
.SendersMessageTime {
    font-size: 12px;
    color: #8b8f8b;
    margin-top: -10px;
}
.Avatar {
    border-radius: 50%;
    padding: 2px;
}
.ReceivedMessage {
    background-color: #F8F9FA;
    padding: 8px;
    width: 240px;
    margin-top: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    position: relative;
    /* box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.2); */
    /* float: left; */
    clear: right;
}
/* .ReceivedMessage::after {
    position: absolute;
    content: "";
    width: 0px;
    height: 0px;
    border-top: 15px solid #F8F9FA;
    border-right: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid transparent;
    top: 60px;
    left: -15px;
    transform: rotate(-45deg);
    /* z-index: -1; */
/* } */ 
/* .SenderMessage::after {
    position: absolute;
    content: "";
    width: 0px;
    height: 0px;
    border-top: 15px solid #d1fdd1;
    border-right: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid transparent;
    top: 60px;
    left: -15px;
    transform: rotate(-45deg);
} */
.SenderMessage {
    background: #eafaea;
    padding: 8px;
    width: 240px;
    position: relative;
    margin-top: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    float: right;
    clear: right;
}
/* .MessageContainer {
    z-index: 4;
    position: fixed;
    width: 27%;
    background-color: white;
    bottom: 0px;
    right: 20px;
    height: 500px;
} */
.Messages {
    height: 380px;
    overflow-y: auto;
    /* border-right: 1px solid #d1d1d1;
    border-top: 1px solid #d1d1d1;
    border-left: 1px solid #d1d1d1; */
    border-radius: 3px;
}

.fa-message {
    color: #029e02;
}
textarea {
    resize: none;
}
#userMessage:focus {
    box-shadow: none;
    outline: none;
    border: 1px solid #029e02;
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
}
.CloseBtn .fa-xmark {
    /* background: #d6d5d5; */
    padding: 8px;
    border-radius: 3px;
    position: absolute;
    top: 10px;
    right: 10px;
    transition: 0.5s;
}
.CloseBtn .fa-xmark:hover {
    background: #e2e1e1;
    cursor: pointer;
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

::-webkit-scrollbar {
    width: 7px;
}

/* Track */
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px #ebebeb;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #dddddd;
}

/* Handle on hover */
/* ::-webkit-scrollbar-thumb:hover {
    background: #fec107;
    cursor: pointer;
} */
</style>
