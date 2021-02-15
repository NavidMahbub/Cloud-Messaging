<template>
    <div class="card">
        <div class="container-fluid">
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">PN</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Reference</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(paymentreceive,index) in payments" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{paymentreceive.date}}</td>
                        <td>{{paymentreceive.pr_number}}</td>
                        <td>{{paymentreceive.customer}}</td>
                        <td>{{paymentreceive.reference}}</td>
                        <td>{{paymentreceive.amount}}</td>
                        <td>
                            <i @click="viewPaymentReceiveModal(paymentreceive)" class="icon-eye icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <PaymentReceivedView ref="view_payment_received_modal"></PaymentReceivedView>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import Loader from '../common/Loader'
import PaymentReceivedView from './PaymentReceivedView'
import axios from 'axios'
import { mapState,mapGetters } from "vuex"
import {ALL_USER_ROLE2} from '../../store/action.type'
export default {
    data(){
        return {
            loading:false,
            permission:'',
            payments:[],
        }
    },
    methods:{
        
        getResults(inv_id){
            this.loading = true;
            return new Promise((resolve, reject) => {
            axios
                .get('/api/installment-payments/'+inv_id)
                .then(response => {
                    this.payments = response.data
                    this.loading=false
                    resolve(response)
                })
                .catch(function(error) {
                    reject(error)
                });
            });
        },
        viewPaymentReceiveModal(payment){
            this.$refs.view_payment_received_modal.openModal(payment)
        },
        
        getPermission(){
            this.$store.dispatch('ALL_USER_ROLE2')
            .then(response=>{
                this.permission = response.data.permission
            })
        }

    },
    mounted(){
        this.getResults(this.$route.params.invid)
        this.getPermission()
    },
    computed: {
    },
    components: {
        PaymentReceivedView,
        Loader
    }
}
</script>


<style>
 .actn{
     margin-left: 10px;
     cursor: pointer;
 }
 .contct{
     padding-bottom: 10px;
     padding-top: 10px
 }
 .contct-b{
     margin-bottom: 10px;
     margin-top: 10px
 }
 .load{
     margin-left: 50%;
 }
</style>
