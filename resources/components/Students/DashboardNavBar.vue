<template>
    <div class="container-jumbotron TopBar1">
        <div class="row">
            <div class="col-md-4">
                <ul class="NavLinks">
                    <li style="margin-left: 20px">
                        <router-link to="/student/dashboard">
                            <i class="fa-solid fa-house"></i>&nbsp;Dashboard
                        </router-link>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="NavLinks2">
                            <li>
                                <button
                                    @click.prevent="buyHours"
                                    class="buyBtn"
                                >
                                    Buy hours
                                </button>
                            </li>
                            <li>You have: {{ 0 }} hours</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="NavLinks2">
                            <li
                                class="messageuserdropdown"
                                v-if="receivedMessages.length"
                            >
                                <router-link to="#" @click="OpenMessageModal">
                                    <span class="UserName"
                                        ><img src="/images/message.png" alt="" width="30">&nbsp;
                                        <span
                                            class="unReadMessage"
                                            v-if="
                                                (loaded =
                                                    true &&
                                                    unreadMessageCount > 0)
                                            "
                                            >{{ unreadMessageCount }}</span
                                        ></span
                                    >
                                </router-link>
                            </li>
                            <li class="userdropdown" v-else>
                                <router-link to="#" @click="OpenMessageModal">
                                    <span class="UserName"
                                        >
                                       <img src="/images/message.png" alt="" width="30"> &nbsp;
                                    </span>
                                </router-link>

                                <ul class="userdropdown-content">
                                    <li
                                        style="font-size: 14px"
                                        class="d-flex justify-content-center align-items-center align-content-center"
                                    >
                                        No message yet
                                    </li>
                                </ul>
                            </li>
                            <li class="userdropdown">
                                <router-link to="/student/teachers">
                                    <span class="UserName"
                                        ><img src="/images/teacher.png" alt="teacher" width="30">&nbsp;
                                    </span>
                                </router-link>
                            </li>
                            <li
                                class="messageuserdropdown"
                                v-if="FavoriteCount > 0"
                            >
                                <router-link to="/student/favorite">
                                    <span class="UserName"
                                        ><img src="/images/bookmark.png" alt="bookmark" width="30">&nbsp;
                                        <span
                                            class="unReadMessage"
                                            v-if="
                                                (loaded =
                                                    true && FavoriteCount > 0)
                                            "
                                            >{{ FavoriteCount }}</span
                                        ></span
                                    >
                                </router-link>
                            </li>
                            <li class="userdropdown" v-else>
                                <router-link to="#">
                                    <span class="UserName"
                                        ><img src="/images/bookmark.png" alt="bookmark" width="30">&nbsp;
                                    </span>
                                </router-link>

                                <ul class="userdropdown-content">
                                    <li
                                        style="font-size: 14px"
                                        class="d-flex justify-content-center"
                                    >
                                        No favorites yet
                                    </li>
                                </ul>
                            </li>
                            <li class="userdropdown" style="margin-top: 10px" v-if="MyUser !== '' ">
                                <img
                                    :src="
                                        '/storage/student/images/' +
                                        MyUser.user_image
                                    "
                                    alt=""
                                    v-if="MyUser.user_image !== null"
                                    style="
                                        border-radius: 50%;
                                        width: 35px;
                                        height: 35px;
                                    "
                                />
                                <ProfileAvatar
                                    :username="MyUser.name"
                                    v-else
                                    size="s"
                                    textColor="white"
                                    :border="false"
                                    class="text2"
                                />
                                <!-- <img
                                    src="/images/avatar.png"
                                    alt="profile_picture"
                                    v-else-if="loaded"
                                     style="border-radius: 50%; width: 35px; height: 35px;"
                                /> -->
                                <ul
                                    class="userdropdown-content"
                                    style="padding: 7px"
                                >
                                    <li>
                                        <router-link to="/student/edit/profile"
                                            >Profile
                                            <img
                                                src="/images/profile.png"
                                                width="25"
                                                alt=""
                                                style="color: #029e02"
                                            />
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link to="/student/ad/management"
                                            >My ads
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link
                                            to="/student/all/booked/lessons"
                                            >My lessons
                                        </router-link>
                                    </li>
                                    <li>
                                        <a href="/student/logout"
                                            >Logout
                                            <i
                                                class="fa-solid fa-right-from-bracket"
                                                style="
                                                    color: #183153;
                                                    font-size: 20px;
                                                "
                                            ></i
                                        ></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { mapState, mapGetters } from "vuex";
import moment from "moment";
import ProfileAvatar from "vue-profile-avatar";
export default {
    name: "DashboardNavBar",
    components: {
        ProfileAvatar,
    },
    data() {
        return {
            UserName: "",
            AuthUserName: "",
            receivedMessages: "",
            loaded: false,
            StudentFavorites: "",
        };
    },
    mounted() {
        this.getAuthUser();
        this.getReceivedMessages();
        this.getUnreadMessages();
        this.getFavorites();
    },

    methods: {
        buyHours() {
            this.$store.commit({
                type: "buyHours",
            });
        },
        OpenMessageModal() {
            this.$store.commit("MessageModalPopup");
        },
        markRead(messageRowId) {
            axios.post("/student/markMessageRead", { rowId: messageRowId });
        },
        dateTime(value) {
            return moment(value).startOf("hour").fromNow();
        },
        getUnreadMessages() {
            axios
                .get("/student/getUnreadMessages")
                .then((response) => {
                    this.$store.commit(
                        "unreadMessageCount",
                        response.data.length
                    );
                    if (response.data.length > 0) {
                        this.loaded = true;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getFavorites() {
            axios
                .get("/student/getFavorites")
                .then((response) => {
                    this.$store.commit(
                        "setFavoriteCount",
                        response.data.length
                    );
                    this.StudentFavorites = response.data;
                    if (response.data.length > 0) {
                        this.loaded = true;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getAuthUser() {
            axios
                .get("/student/getAuthUser")
                .then((response) => {
                    this.$store.commit("userDetails", response.data);
                    this.AuthUserName = response.data.name;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getReceivedMessages() {
            axios
                .get("/student/getReceivedMessages")
                .then((response) => {
                    this.receivedMessages = response.data;
                    // console.log(response.data[0].is_read)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },

    computed: {
        ...mapState({
            MyUser: (state) => state.loggedUser,
            FavoriteCount: (state) => state.FavoriteCount,
            unreadMessageCount: (state) => state.unreadMessageCount,
        }),
    },
};
</script>
<style scoped>
/* avatar */
.small {
    height: 35px;
    width: 35px;
}
.border {
    border: 1px solid black;
}
.text2 {
    font-size: 10px;
    font-family: var(--bs-body-font-family);
}
/* end avatar */
.buyBtn {
    padding: 0px 15px 2px;
    color: #183153;
    background: white;
    border-radius: 2px;
    border: 1px solid #029e02;
    /* transition: 0.9s; */
}
.buyBtn:hover {
    color: white;
    background: #029e02;
}
.timeSent {
    font-size: 12px;
    color: #151419;
    position: absolute;
    top: 15px;
    right: 20px;
}
.unReadMessageBg {
    background-color: #f7f7f7;
}
.unReadMessageBg:hover {
    background-color: #f8f8f8;
    cursor: pointer;
}
.btn {
    border-radius: 0;
}
.TopBar1 {
    box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -webkit-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -moz-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    /* background-color: #fed907; */
}
.fa-solid {
    color: #183153;
    font-size: 20px;
}

.NavLinks2 {
    display: flex;
    flex-flow: row wrap;
    justify-content: flex-end;
}
.NavLinks2 li {
    list-style: none;
    margin-right: 25px;
    font-size: 16px;
    margin-top: 15px;
}
.NavLinks2 li a {
    text-decoration: none;
    color: #183153;
}
.NavLinks {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}
.NavLinks li {
    list-style: none;
    margin-right: 25px;
    font-size: 16px;
    margin-top: 15px;
}
.NavLinks li a {
    text-decoration: none;
    color: #183153;
}

/* This is message drop down */

.messageuserdropdown {
    position: relative;
}

.messageuserdropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 270px;
    box-shadow: 0px 4px 12px 0px rgba(0, 0, 0, 0.1);
    padding: 0;
    z-index: 1;
    right: -10px;
    /* top: 50px; */
    height: 250px;
    overflow-y: auto;
}

.messageuserdropdown-content a {
    color: #fec107;
    font-size: 16px;
}
.messageuserdropdown-content li {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    /* border-top: 1px solid rgba(0, 0, 0, 0.1); */
    margin: 0px 0px 5px 0px;
}
.messageuserdropdown-content li:hover {
    background-color: rgba(245, 245, 245, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.1);
    cursor: pointer;
    box-shadow: 0px 2px 3px 0px rgba(133, 133, 133, 0.1);
}
.messageuserdropdown-content li p {
    margin-bottom: 5px;
}
.messageuserdropdown:hover .messageuserdropdown-content {
    display: block;
}

/* end of message dropdwown */

.userdropdown {
    position: relative;
    /* display: inline-block; */
}
.userdropdown li {
    margin-bottom: 4px;
    margin-left: 12px;
    margin-top: 4px;
}
.userdropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 220px;
    box-shadow: 0px 4px 12px 0px rgba(0, 0, 0, 0.1);
    /* padding: 12px 16px; */
    z-index: 1;
    right: -10px;
    /* top: 50px; */
}
.userdropdown-content a {
    color: #fec107;
    /* font-size: 18px; */
}
.userdropdown-content a:hover {
    color: #029e02;
    /* font-size: 14px; */
}
.userdropdown:hover .userdropdown-content {
    display: block;
}

.UserName {
    text-transform: capitalize;
    font-weight: 600;
}
.UserName:hover {
    cursor: pointer;
}
.fa-message {
    position: relative;
}
.unReadMessage {
    background-color: #fe0609;
    display: flex;
    position: absolute;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    color: white;
    font-size: 12px;
    top: -12px;
    right: -8px;
}
.fa-bookmark {
    position: relative;
}
.unReadFavorite {
    background-color: red;
    display: flex;
    position: absolute;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    color: white;
    font-size: 12px;
    top: -5px;
    right: -5px;
}
</style>
