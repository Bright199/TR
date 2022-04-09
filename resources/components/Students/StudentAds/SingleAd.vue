<template>
    <div>
        <div class="container p-3">
            <div class="row">
                <div class="spinner" v-if="loading">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6 p-3 bg-white shadow-sm" v-if="adDetails.length && loaded">
                    <div class="container p-2" style="background: #183153">
                        <p style="color: white">
                            Preview cost of ad
                            <span
                                style="
                                    color: white;
                                    background: #029e20;
                                    padding: 0px 10px 1px;
                                "
                                >${{ adDetails[0].ad_fee }} USD</span
                            >
                        </p>
                    </div>
                    <div class="container p-2">
                        <p v-if="adDetails[0].published === 0">
                            Status:
                            <span style="color: #183153">Unpublished</span>
                        </p>
                        <p v-else-if="adDetails[0].published === 1">
                            Status:
                            <span style="color: blue">Waiting approval</span>
                        </p>
                        <p v-else-if="adDetails[0].published === 2">
                            Status: <span style="color: #029e20">Active</span>
                        </p>
                        <p>
                            Title:
                            <span style="color: #029e02">{{
                                adDetails[0].title
                            }}</span>
                        </p>
                        <p>{{ adDetails[0].description }}</p>
                        <p>
                            Language:
                            <span style="color: #029e02">{{
                                adDetails[0].language_category
                            }}</span>
                        </p>
                        <p>
                            Looking for:
                            <span style="color: #029e02">{{
                                adDetails[0].student_gender
                            }}</span>
                        </p>
                        <p>
                            Budget:
                            <span style="font-weight: bold">
                                ${{ adDetails[0].minimum_budget }} USD - ${{
                                    adDetails[0].maximum_budget
                                }}
                                USD</span
                            >
                        </p>
                    </div>
                    <div class="container border-top" v-if="adDetails[0].published === 0">
                        <p>
                            You can publish this ad by paying for it to make
                            teachers contact you
                        </p>
                        <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-3"></div>
                          <div class="col-md-6">
                            <a
                            :href="'/student/SingleAdPayment'+adDetails[0].id"
                            style="
                                color: white;
                                background: #029e20;
                                padding: 0px 15px 3px;
                                border-radius: 3px;
                                text-decoration: none;
                                float: right
                            "
                            >Pay to post</a
                        >
                          </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="container" v-if="loaded">
                        <p>
                            Create your first ad and make teachers contact you.
                        </p>
                        <a
                            href="/student/create/ad"
                            style="color: #029e02; text-decoration: none"
                            >Create job advert</a
                        >
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "SingleAd",
    props: ["id"],
    data() {
        return {
            adDetails: [],
            loading: false,
            loaded: false,
        };
    },
    methods: {
        getAdDetails() {
            this.loading = true;
            axios
                .get("/student/getSingleAd" + this.id)
                .then((response) => {
                    this.adDetails = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
    mounted() {
        this.getAdDetails();
    },
};
</script>

<style>
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
