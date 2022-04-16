<template>
    <div class="bg-light">
        <DashboardNavBar />
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                    <p
                        class="d-flex justify-content-center"
                        style="font-size: 20px; margin-bottom: 0px"
                    >
                        Find a teacher in few minutes by hiring our teachers or
                        by creating an ad &nbsp;
                    </p>
                    <a
                        class="d-flex justify-content-center"
                        href="/student/create/ad"
                        style="margin-top: 0px"
                        >post an ad</a
                    >
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-3 LeftBar shadow-sm bg-white p-0">
                    <div
                        class="container-jumbotron d-flex justify-content-center border-bottom p-2"
                    >
                        <img src="/images/contacts.png" alt="" width="80" />
                    </div>
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
                                :class="
                                    chatIsActive == contact.teacher_id
                                        ? 'ActiveChat'
                                        : ''
                                "
                                :key="index"
                                @click="getUserChats(contact.teacher_id)"
                            >
                                <div class="row">
                                    <div class="col-md-3">
                                        <img
                                            v-if="
                                                contact.teacher_image === null
                                            "
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
                                                '/images/' +
                                                contact.teacher_image
                                            "
                                            alt=""
                                            width="60"
                                            height="60"
                                            class="Avatar"
                                            style="margin-top: 5px"
                                        />
                                    </div>
                                    <div class="col-md-9 mt-2">
                                        <p class="Name">
                                            {{ contact.teacher_name }}
                                        </p>
                                        <!-- <p
                                            style="
                                                margin-top: 0px;
                                                font-size: 12px;
                                            "
                                        >
                                            {{ contact.teacher_email }}
                                        </p> -->
                                    </div>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
                <!-- <div class="col-md-1"></div> -->
                <div class="col-md-7 RightBar p-0" style="margin-left: 14px">
                    <!-- <div
                        class="container-jumbotron d-flex justify-content-center p-3"
                    >
                        <p>Messages</p>
                    </div> -->
                    <div
                        class="container MessageContainer shadow-sm bg-white"
                        id="MessageContainer"
                    >
                        <ul class="MessageInnerContainer">
                            <div v-if="messages.length">
                                <li
                                    v-for="(message, index) in messages"
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
                                            message.teacher_to !== AuthUser.id
                                                ? 'SendersMessageTime'
                                                : 'ReceiversMessageTime'
                                        "
                                    >
                                        {{ dateTime(message.created_at) }}
                                    </p>
                                </li>
                            </div>
                            <div v-else class="d-flex justify-content-center">
                                <p
                                    class="mt-5"
                                    v-if="conversationsLoaded == true"
                                >
                                    Select a chat to start a conversation
                                </p>
                                <div class="spinner" v-if="loading2 == true">
                                    <div class="dot1"></div>
                                    <div class="dot2"></div>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="container p-0 mt-1">
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Message..."
                                name="userMessage"
                                v-model="userMessage"
                            />
                            <button
                                class="btn SendBtn"
                                type="submit"
                                @click="SendMessage"
                            >
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { mapState, mapMutations } from "vuex";
import moment from "moment";
import DashboardNavBar from "../DashboardNavBar.vue";
export default {
    name: "Messages",
    components: { DashboardNavBar },
    data() {
        return {
            messages: [],
            userMessage: "",
            contacts: "",
            loading: false,
            loading2: false,
            chatIsActive: 0,
            userId: 0,
            AuthUserName: "",
            loaded: false,
            conversationsLoaded: true,
        };
    },
    methods: {
        dateTime(value) {
            return (
                moment(value).format('MMMM Do, H:mm')
                // moment(value).startOf().fromNow()
            );
        },
        getUserChats(teacherId) {
            this.conversationsLoaded = false;
            this.chatIsActive = teacherId;
            this.userId = teacherId;
            this.loading2 = true;
            // const thisValue = this;

            axios
                .get(`/student/conversations/${this.userId}`)
                .then((response) => {
                    this.messages = response.data;
                    setTimeout(() => {
                        const container =
                            this.$el.querySelector("#MessageContainer");
                        container.scrollTop = container.scrollHeight;
                    }, 500);
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading2 = false;
                });
        },
        getMessageContacts() {
            const thisValue = this;
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
        SendMessage() {
            const trimmedMessage = this.userMessage.trim();
            if (trimmedMessage == "") {
                alert("Can not send empty message");
                return;
            } else if (this.chatIsActive === 0) {
                alert("Select teacher to send message");
                return;
            }
            this.messages.push({
                message: trimmedMessage,
                created_at: new Date(),
            });
            const data = {
                message: trimmedMessage,
                teacherId: this.chatIsActive,
            };
            setTimeout(() => {
                const container = this.$el.querySelector("#MessageContainer");
                container.scrollTop = container.scrollHeight;
            }, 500);
            axios.post("/student/message", data);
            this.userMessage = "";
        },

        // getAuthUser(){
        //     axios
        //     .get("/student/getAuthUser")
        //     .then((response) => {
        //         this.AuthUserEmail = response.data.email;
        //     })
        //     .catch((error) => {
        //         console.log(error);
        //     });
        // }
    },
    mounted() {
        this.getMessageContacts();
        // this.getAuthUser()
    },
    computed: {
        ...mapState({
            AuthUser: (state) => state.loggedUser,
        }),
    },
};
</script>
<style scoped>
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
.ActiveChat {
    background-color: #f7f7f7;
}
.ChatList:hover {
    cursor: pointer;
}
.Name {
    color: #029e02;
    margin-bottom: 0px;
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
.btn:focus,
input:focus {
    outline: none;
    box-shadow: none;
    border: 1px solid #029e02;
}
.btn:hover {
    background-color: #03aa03;
}
.SendBtn {
    background: #029e02;
    color: white;
}
.ReceivedMessage {
    background: #f7f7f7;
    padding: 8px;
    width: 270px;
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
    border-top: 15px solid #f7f7f7;
    border-right: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid transparent;
    top: 60px;
    left: -15px;
    transform: rotate(-45deg);
} */
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
    width: 270px;
    position: relative;
    margin-top: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    float: right;
    clear: right;
    /* box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.2); */
}
.MessageContainer {
    overflow-y: auto;
    height: 350px;
    border-bottom: 1px solid rgb(247, 247, 247);
}
.MessageInnerContainer li {
    list-style: none;
}
.ChatList {
    margin-top: 6px;
    border-bottom: 1px solid rgb(226, 226, 226);
    padding: 4px;
    list-style: none;
}
.Chats {
    padding: 0;
}
.Avatar {
    border-radius: 50%;
    padding: 2px;
}
.LeftBar {
    height: 450px;
    overflow-y: auto;
    overflow-x: hidden;
}
.RightBar {
    height: 450px;
}
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
::-webkit-scrollbar-thumb:hover {
    background: #fec107;
    cursor: pointer;
}
</style>
