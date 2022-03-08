<template>
    <div>
        <DashboardNavBar />
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4 LeftBar p-0">
                    <div
                        class="container-jumbotron d-flex justify-content-center border p-3"
                    >
                        <h3>Conversations</h3>
                    </div>
                    <ul class="Chats">
                        <div v-if="contacts.length == ''">
                            <li>No contacts</li>
                        </div>
                        <div v-else>
                            <li v-for="(contact, index) in contacts" class="ChatList ActiveChat" :key="index">
                                <div class="row">
                                    <div class="col-md-3 ">
                                        <img
                                            :src="'/images/'+contact.teacher_image"
                                            alt=""
                                            width="70"
                                            class="Avatar"
                                        />
                                    </div>
                                    <div class="col-md-8 mt-2">
                                        <p class="Name">{{contact.name}}</p>
                                        <p style="line-height: 0.2px">
                                           {{contact.email}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
                <!-- <div class="col-md-1"></div> -->
                <div class="col-md-7 RightBar p-0" style="margin-left: 14px">
                    <div
                        class="container-jumbotron d-flex justify-content-center p-3"
                    >
                        <h3>Messages</h3>
                    </div>
                    <div class="container MessageContainer">
                        <ul class="MessageInnerContainer">
                            <!-- <li class="ReceivedMessage">
                                <p>Receiver's message</p>
                                <p class="ReceiversMessageTime">
                                    {{ new Date() }}
                                </p>
                            </li>
                            <li class="SenderMessage">
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur
                                    adipisicing elit. Amet, quo! dolor, sit amet
                                    consectetur adipisicing elit. Amet, quo!
                                </p>
                                <p class="SendersMessageTime">
                                    {{ new Date() }}
                                </p>
                            </li> -->

                            <div v-if="messages.length">
                                <li
                                    v-for="(message, index) in messages"
                                    :key="index"
                                >
                                    {{ message }}
                                </li>
                            </div>
                            <div v-else>
                                <h5>Start a conversation</h5>
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
                                Send message
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
import DashboardNavBar from "../DashboardNavBar.vue";
export default {
    name: "Messages",
    components: { DashboardNavBar },
    data() {
        return {
            messages: [],
            userMessage: "",
            contacts: "",
        };
    },
    methods: {
        SendMessage() {
            const trimmedMessage = this.userMessage.trim();
            if (trimmedMessage == "") {
                alert("cannot send empty entry");
                return;
            }
            this.messages.push(this.userMessage);
            // alert(this.userMessage)
        },
    },
    mounted() {
        const thisValue = this;
        axios
            .get("/student/message/contacts")
            .then(function (response) {
                thisValue.contacts = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    },
};
</script>
<style scoped>
.ActiveChat {
    background-color: #f7f7f7;
}
.ChatList:hover {
    cursor: pointer;
}
.Name {
    font-size: 18px;
    font-weight: 550;
    color: #029e02;
    margin-bottom: 6px;
}
.ReceiversMessageTime {
    font-size: 12px;
    color: #9e9e9e;
    margin-top: -10px;
}
.SendersMessageTime {
    font-size: 12px;
    color: #919191;
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
    background: #ffffff;
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
.ReceivedMessage::after {
    position: absolute;
    content: "";
    width: 0px;
    height: 0px;
    border-top: 15px solid #ffffff;
    border-right: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid transparent;
    top: 77px;
    left: -15px;
    transform: rotate(-45deg);
    /* z-index: -1; */
}
.SenderMessage::after {
    position: absolute;
    content: "";
    width: 0px;
    height: 0px;
    border-top: 15px solid rgba(254, 193, 7, 0.502);
    border-right: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 15px solid transparent;
    top: 77px;
    left: -15px;
    transform: rotate(-45deg);
}
.SenderMessage {
    background: rgba(254, 193, 7, 0.502);
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
    background-color: #f7f7f7;
    -moz-box-shadow: inset 0 0 5px rgb(150, 150, 150, 0.1);
    -webkit-box-shadow: inset 0 0 5px rgb(150, 150, 150, 0.1);
    box-shadow: inset 0 0 5px rgb(150, 150, 150, 0.1);
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
    border: 1px solid gray;
    border-radius: 50%;
    padding: 2px;
}
.LeftBar {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);

    height: 450px;
    overflow-y: auto;
    overflow-x: hidden;
}
.RightBar {
    box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 4px -1px 10px -3px rgba(0, 0, 0, 0.3);
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
