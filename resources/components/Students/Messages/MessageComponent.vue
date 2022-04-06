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
                        @click="CloseMessageContainer"
                    ></i>
                </p>
            </div>
            <div class="container Messages bg-white">
                <ul class="Chats">
                    <div v-if="contacts.length == ''">
                        <div class="spinner" v-if="loading == true">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                        <li
                            v-if="loaded == true"
                            class="d-flex justify-content-center mt-5"
                        >
                            No contacts
                        </li>
                    </div>
                    <div v-else>
                        <div class="spinner" v-if="loading == true">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                        <li
                            v-for="(contact, index) in contacts"
                            class="ChatList"
                            :key="index"
                            @click="
                                getUserChats(contact.teacher_id);
                                resetUnreadMessages(
                                    contact.unread,
                                    contact.teacher_id
                                );playSound('/audios/notification.mp3');
                            "
                        >
                                <!--  -->
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <img
                                        v-if="contact.teacher_image === null"
                                        src="/images/avatar.png"
                                        alt=""
                                        width="60"
                                        height="60"
                                        class="Avatar"
                                        style="
                                            margin-top: 5px;
                                            margin-right: 0px;
                                        "
                                    />
                                    <img
                                        v-else
                                        :src="
                                            '/images/' + contact.teacher_image
                                        "
                                        alt=""
                                        width="60"
                                        height="60"
                                        class="Avatar"
                                        style="margin-top: 5px"
                                    />
                                </div>
                                <div class="col-md-9 col-sm-9 mt-2">
                                    <p class="Name">
                                        {{ contact.teacher_name }}
                                    </p>
                                    <span class="timeSent">{{
                                        dateTime(contact.message_date)
                                    }}</span>
                                    <span
                                        class="UnreadCounter"
                                        v-if="contact.unread"
                                    >
                                        {{ contact.unread }}
                                    </span>
                                    <p
                                        class="Message"
                                        v-if="contact.message.length > 22"
                                    >
                                        {{
                                            contact.message.slice(0, 22) +
                                            " " +
                                            "..."
                                        }}
                                    </p>
                                    <p class="Message" v-else>
                                        {{ contact.message }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </div>
                </ul>
            </div>
            <!-- <div class="input-group">
                <input
                    type="text"
                    class="form-control"
                    id="userMessage"
                    v-model="message"
                    name="message"
                    placeholder="Write your message here..."
                />
                <button type="submit" class="SendBtn" @click="SendMessage()">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div> -->
            <!-- teacher.id -->
        </div>
        <!-- end of messaging componet -->
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import { mapState } from "vuex";
export default {
    name: "MessageComponent",
    emits: ["displayModal"],
    data() {
        return {
            message: "",
            loading: false,
            loaded: false,
            contacts: "",
        };
    },
    mounted() {
        this.getMessageContacts();
    },
    methods: {
        // markRead(messageRowId){
        //     axios
        //         .post("/student/markMessageRead",{rowId: messageRowId})

        // },
        resetUnreadMessages(unreadcount, teacherId) {
            axios.post("/student/markMessageRead", { teacherId: teacherId });
            this.$store.commit("reduceUnreadMessagesCount", unreadcount);
        },
        playSound(url) {
            const audio = new Audio(url);
            audio.play();
        },
        getUserChats(teacherId) {
            axios
                .get(`/student/conversations/${teacherId}`)
                .then((response) => {
                    this.$store.commit("TeacherStudentChats", response.data);
                    this.$store.commit("teacherId", teacherId);
                });
        },
        dateTime(v) {
            return moment(v).format('LT');
        },
        CloseMessageContainer() {
            this.$store.commit("MessageModalClose");
        },
        getMessageContacts() {
            this.loading = true;
            axios
                .get("/student/message/contacts")
                .then((response) => {
                    this.contacts = response.data;
                    if (response.data.length === 0) {
                        this.loaded = true;
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
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
    margin-left: 20px;
    height: 500px;
    background-color: white;
}
.MessageContainer p, img {
   padding-left: 15px;
}
.MessageContainer img {
   margin-left: 25px;
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
.MessageContainer p {
   padding-left: 15px;
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
.MessageContainer p {
   padding-left: 15px;
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
.MessageContainer p {
   padding-left: 15px;
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
.MessageContainer p {
   padding-left: 15px;
}
}
.Name {
    margin-bottom: 1px;
}
.timeSent {
    position: absolute;
    top: 15px;
    right: 10px;
    font-size: 12px;
}
.UnreadCounter {
    position: absolute;
    top: 35px;
    right: 10px;
    background-color: #fe0609;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    color: white;
    font-size: 12px;
}
.Avatar {
    border-radius: 50%;
    padding: 2px;
}
.Chats {
    padding: 0;
}
.ChatList:hover {
    cursor: pointer;
    background-color: #f8f9fa;
}
.ChatList {
    margin-top: 6px;
    padding: 4px;
    list-style: none;
    position: relative;
}

/* .MessageContainer {
    z-index: 2;
    position: fixed;
    width: 27%;
    bottom: 0px;
    right: 20px;
    height: 500px;
    background-color: white;
} */
.Messages {
    height: 410px;
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
    background: #f8f9fa;
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
</style>
