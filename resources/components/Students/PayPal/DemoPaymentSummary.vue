<template>
    <div class="bg-light">
        <div class="container p-4" style="background-color: #029e02">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 bg-white">
                    <h3 class="d-flex justify-content-center p-3 ">Payment details</h3>
                    <div class="container p-4">
                        <table class="table table-sm borderless table-striped p-0">

                                <tbody>
                                    <tr>
                                        <td>Payer's name</td>
                                        <td style="font-weight:500;text-align:end">
                                            <span>{{ paymentDetails.payer_name + " " + paymentDetails.payer_surname }}</span></td>
                                       
                                    </tr>
                                    <tr>
                                        <td>Payer's ID</td>
                                        <td style="font-weight:500;text-align:end">
                                            <span>{{ paymentDetails.payer_id }}</span></td>
                                       
                                    </tr>
                                    <tr>
                                        <td>Email addres</td>
                                        <td style="font-weight:500;text-align:end">
                                            <span>{{ paymentDetails.email_address }}</span></td>
                                       
                                    </tr>
                                    <tr>
                                        <td>Amount paid</td>
                                        <td style="font-weight:500;text-align:end">
                                            $<span>{{ paymentDetails.amount }}</span></td>
                                       
                                    </tr>
                                    <tr>
                                        <td>Currency code</td>
                                        <td style="font-weight:500;text-align:end">{{paymentDetails.currency_code}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Paid on</td>
                                        <td style="text-align:end"><span>{{dateTime(paymentDetails.created_at)}}</span></td>
                                    </tr>


                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="d-flex justify-content-end">Paid using</h5>
                                </div>
                                <div class="col-md-6">
                                    <img src="/images/paypal.png" alt="" width="50">
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
import moment from 'moment';
export default {
    name: "DemoPaymentSummary",
    props: ["id"],
    data() {
        return {
            paymentDetails: "",
        };
    },
    mounted() {
        this.getBookedPaymentDetails();
    },
    methods: {
        getBookedPaymentDetails() {
            axios
                .get("/student/demo/payment/info/" + this.id)
                .then((response) => {
                    this.paymentDetails = response.data;
                });
        }, 
        dateTime(value){
         return  moment(value).format('MMMM Do, H:mm')
        }
    },
    
};
</script>

<style scoped>

</style>
