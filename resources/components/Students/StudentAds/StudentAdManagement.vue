<template>
    <div>
         <div class="container-jumbotron TopBar1">
            <NavBar />
        </div>
        <div class="container">
            <div class="container" v-if="!MyAds.length">
                <div class="row mt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h2>There are no ads for you yet. Make one by following the link below</h2>
                <router-link to="/student/create/ad">Create ad</router-link>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <div v-else>
                <div  v-for="(ad, index) in MyAds" :key="index">
                <div class="row">
                    <div class="container">
                        <h3><p style="font-size:23px;font-weight: 550; color:green">{{ad.title}}</p></h3>
                    </div>
                    <div class="col border adUserImage">
                        <img :src="'/storage/student/images/'+AuthUserDetails.user_image" alt="" width="150" height="150">
                    </div>
                    <div class="col">
                        <p>{{ad.description}}</p>
                    </div>
                    <div class="col">
                        <button class="btn btn-success">Edit ad</button><br>
                        <button class="btn btn-danger">Delete ad</button>
                    </div>
                </div>
            </div>
            </div>
            
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import { mapState, mapMutations} from 'vuex';
import NavBar from '../NavBar.vue'
export default {
    name:'StudentAdManagement',
    components:{NavBar},
    data() {
        return{
            MyAds:''
        }
    },
    computed:mapState({
        AuthUserDetails: (state)=> state.loggedUser
    }),
    mounted() {

        const mypointer = this;
        axios
            .get("/student/getAuthUser",{
                        headers: {
                            "Content-Type": "application/json",
                        },
                    })
            .then(function (response) {
                mypointer.$store.commit("userDetails", response.data);
                mypointer.AuthUserName = response.data.name;
            })
            .catch(function (error) {
                console.log(error);
            });
        axios.get('/student/ads')
        .then(function (response){
            if(response.data !== null){
                mypointer.MyAds = response.data
            }
        })
    }
}
</script>