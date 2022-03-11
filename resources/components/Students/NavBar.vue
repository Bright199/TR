<template>
    <div>
        <div class="container-jumbotron TopBar1">
            <div class="row">
                <div class="col">
                    <ul class="NavLinks">
                        <li style="margin-left: 20px">
                            <a href="/student/home"
                                ><i class="fa-solid fa-house"></i>&nbsp;Home</a
                            >
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="NavLinks2">
                        <li class="userdropdown">
                            <!-- <a href="" class="Logout "></a> -->
                            <router-link to="/student/messages">
                                <span class="UserName"
                                    ><i class="fa-solid fa-message"></i>&nbsp;
                                    <span class="unReadMessage">5</span></span
                                >
                            </router-link>
                            <ul class="userdropdown-content">
                                <li>
                                    <router-link to="/student/messages"
                                        >From: Teacher's name</router-link
                                    >
                                </li>
                                <hr />
                            </ul>
                        </li>
                        <li class="userdropdown">
                            <!-- <a href="" class="Logout "></a> -->
                            <router-link to="/student/teachers">
                                <span class="UserName"
                                    ><i class="fa-solid fa-chalkboard-user"></i>&nbsp;
                                    Teachers</span
                                >
                            </router-link>
                        </li>

                        <li class="userdropdown">
                            <router-link to="/student/favorite">
                                <span class="UserName"
                                    ><i class="fa-solid fa-bookmark"></i>&nbsp;
                                    <span class="unReadFavorite">5</span></span
                                >
                            </router-link>
                            <ul class="userdropdown-content">
                                <li>
                                    <router-link to="/student/favorite"
                                        >Teacher's name</router-link
                                    >
                                </li>
                                <hr />
                            </ul>
                        </li>
                        <!-- {{ trimmedName }} -->
                        <li class="userdropdown">
                            <!-- <a href="" class="Logout "></a> -->
                            <span class="UserName">{{ MyUser.name }}</span>
                            <ul class="userdropdown-content">
                                <li>
                                    <p>
                                        Account&nbsp;<i
                                            class="fa-solid fa-gear"
                                            style="
                                                color: #151419;
                                                font-size: 20px;
                                            "
                                        ></i>
                                    </p>
                                </li>
                                <hr />
                                <li>
                                    <router-link to="/student/edit/profile"
                                        >View Profile</router-link
                                    >
                                </li>
                                <li>
                                    <router-link to="/student/ad/management"
                                        >My ads</router-link
                                    >
                                </li>
                                <li>
                                    <a href="/student/logout"
                                        >Logout
                                        <i
                                            class="fa-solid fa-right-from-bracket"
                                            style="
                                                color: #151419;
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

        <!-- <div class="container">
            {{ loggedUser }}
        </div> -->
    </div>
</template>
<script>
import { mapState, mapGetters } from "vuex";
export default {
    name: "NavBar",
    data() {
        return {
            UserName: "",
        };
    },
    
    computed: {
       
        ...mapState({
            MyUser: (state) => state.loggedUser,
        }),
    },
    // methods: {},
};
</script>
<style scoped>

.btn {
    border-radius: 0;
}
.TopBar1 {
    box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -webkit-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -moz-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    background-color: #fec107
}
.fa-solid {
    color: #151419;
}
.NavLinks2 {
    display: flex;
    padding: 10px;
    flex-direction: row;
    /* background-color: #fec107; */
    justify-content: flex-end;
}
.NavLinks2 li {
    list-style: none;
    margin-right: 25px;
    font-size: 20px;
}
.NavLinks2 li a {
    text-decoration: none;
    color: #151419;
}
.NavLinks {
    display: flex;
    padding: 10px;
    flex-direction: row;
    /* background-color: #fec107; */
    justify-content: flex-start;
}
.NavLinks li {
    list-style: none;
    margin-right: 25px;
    font-size: 20px;
}
.NavLinks li a {
    text-decoration: none;
    color: #151419;
}
.LinkItem {
    font-size: 18px;
    color: #151419;
    padding: 2px 10px;
}

.userdropdown {
    position: relative;
    /* display: inline-block; */
}

.userdropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 220px;
    box-shadow: 0px 4px 12px 0px rgba(0, 0, 0, 0.1);
    padding: 12px 16px;
    z-index: 1;
    right: -10px;
    /* top: 50px; */
}
.userdropdown-content a {
    color: #fec107;
    font-size: 18px;
}
.userdropdown-content a:hover {
    color: #fec107;
    /* font-size: 14px; */
}
.userdropdown:hover .userdropdown-content {
    display: block;
}

.UserName {
    color: #151419;
    text-transform: capitalize;
    font-weight: 600;
}
.UserName:hover {
    cursor: pointer;
}

.fa-bookmark{
    position: relative;
}
.unReadFavorite{
    background-color: red;
    display: flex;
    position: absolute;
    align-items: center;
    justify-content: center;
    border-radius:50%;
    width: 20px;
    height: 20px;
    color: white;
    font-size: 12px;
    top: -5px;
    right: -5px;
}

.fa-message{
    position: relative;
}
.unReadMessage{
    background-color: red;
    display: flex;
    position: absolute;
    align-items: center;
    justify-content: center;
    border-radius:50%;
    width: 20px;
    height: 20px;
    color: white;
    font-size: 12px;
    top: -5px;
    right: -5px;
}
</style>
