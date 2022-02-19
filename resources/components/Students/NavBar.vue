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
                        <li>
                            <a href=""
                                ><i class="fa-solid fa-message"></i
                                >&nbsp;Messages</a
                            >
                        </li>
                        <li>
                            <a href=""
                                ><i class="fa-solid fa-bookmark"></i>&nbsp;My
                                favorite</a
                            >
                        </li>
                        <li class="userdropdown">
                            <!-- <a href="" class="Logout "></a> -->
                            <span class="UserName">{{ trimmedName }}</span>
                            <ul class="userdropdown-content">
                                <li>
                                    <h3>Account</h3>
                                </li>
                                <li>
                                    <a href="">My profile</a>
                                </li>
                                <li>
                                    <a href="/student/logout">Logout</a>
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
import { mapState, mapMutations } from "vuex";
export default {
    name: "NavBar",
    props: ["user"],
    data() {
        return {
            trimmedName: "",
        };
    },
    mounted() {
        this.$store.commit("userDetails", this.user);
        this.trimmedName = this.user.name.split(" ", 1).join(" ");
    },
    computed: mapState({
        count: (state) => state.count,
        loggedUser: (state) => state.loggedUser,
    }),
    methods: {},
};
</script>
<style scoped>
/* @media only screen and (min-width: 600px) {
 .TopBar1{
     display:none
 }
}


@media only screen and (min-width: 992px) {
 .TopBar2{
    background-color: #fec107
 }
} */
.TopBar1 {
    background: #f1edd8;
    background: linear-gradient(90deg, #f1edd8 0%, #f6f2e9 80%);
    background: -webkit-linear-gradient(90deg, #f1edd8 0%, #f6f2e9 80%);
    background: -moz-linear-gradient(90deg, #f1edd8 0%, #f6f2e9 80%);

    box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -webkit-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
    -moz-box-shadow: -1px 10px 15px -8px rgba(28, 26, 26, 0.3);
}
.fa-solid {
    color: #fec107;
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
    background-color: #f6f2e9;
    min-width: 220px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
    color: #029e02;
    text-transform: capitalize;
    font-weight: 600;
}
.UserName:hover {
    cursor: pointer;
}
</style>
