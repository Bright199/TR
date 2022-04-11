<template>
    <div>
        <div class="container p-4">
            <div class="row">
                <div class="col-md-3 Links me-3 p-2 shadow-sm bg-white">
                    <router-link to="/student/dashboard"
                        ><i class="fa-solid fa-arrow-left"></i
                        >&nbsp; Dashboard</router-link
                    >
                    <router-link to="/student/all/booked/lessons"
                        ><i class="fa-solid fa-arrow-left"></i
                        >&nbsp; My lessons</router-link
                    >
                </div>
                <div class="col-md-6 bg-white p-0">
                    <div class="container p-3" style="background: #183153">
                        <h4>
                            <span style="color: white">Payment details</span>
                        </h4>
                    </div>
                    <div class="spinner" v-if="loading == true">
                        <div class="dot1"></div>
                        <div class="dot2"></div>
                    </div>
                    <div class="container p-4" v-if="loaded">
                        <table
                            class="table table-sm borderless table-striped p-0"
                        >
                            <tbody>
                                <tr>
                                    <td>Payer's name</td>
                                    <td
                                        style="
                                            font-weight: 500;
                                            text-align: end;
                                        "
                                    >
                                        <span>{{
                                            paymentDetails.payer_name +
                                            " " +
                                            paymentDetails.payer_surname
                                        }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payer's ID</td>
                                    <td
                                        style="
                                            font-weight: 500;
                                            text-align: end;
                                        "
                                    >
                                        <span>{{
                                            paymentDetails.payer_id
                                        }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email addres</td>
                                    <td
                                        style="
                                            font-weight: 500;
                                            text-align: end;
                                        "
                                    >
                                        <span>{{
                                            paymentDetails.email_address
                                        }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Amount paid</td>
                                    <td
                                        style="
                                            font-weight: 500;
                                            text-align: end;
                                        "
                                    >
                                        $<span>{{
                                            paymentDetails.amount
                                        }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Currency code</td>
                                    <td
                                        style="
                                            font-weight: 500;
                                            text-align: end;
                                        "
                                    >
                                        {{ paymentDetails.currency_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Paid on</td>
                                    <td style="text-align: end">
                                        <span>{{
                                            dateTime(paymentDetails.created_at)
                                        }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <p
                                    class="d-flex justify-content-end"
                                    style="color: #029e02"
                                >
                                    Paid using
                                </p>
                            </div>
                            <div class="col-md-6">
                                <img
                                    src="/images/paypal.png"
                                    alt=""
                                    width="50"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
export default {
    name: "DemoPaymentSummary",
    props: ["id"],
    data() {
        return {
            paymentDetails: "",
            loading: false,
            loaded: false,
        };
    },
    mounted() {
        this.getBookedPaymentDetails();
    },
    methods: {
        getBookedPaymentDetails() {
            this.loading = true;
            axios
                .get("/student/demo/payment/info/" + this.id)
                .then((response) => {
                    this.paymentDetails = response.data;
                    this.loaded = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        dateTime(value) {
            return moment(value).format("MMMM Do, H:mm");
        },
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
.Links a{
    text-decoration: none;
    background-color: #029e02;
    color: white;
    padding: 0px 15px 5px;
    margin: 4px;

}

.Links{
    display: flex;
    align-items: center;
    flex-direction: column;
}
</style>
