<template>
    <div class="card">
        <div class="container-fluid">
            <button v-if="permission.payment_create" type="button" @click="addPaymentReceivedModal" class="btn btn-primary contct-b pull-left"><i class="fa fa-life-bouy"></i> Add Payment Received</button>
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <!-- <select v-model="search.agent"   id="inputState" class="form-control" style="margin-right:10px" >
                    <option  value="" >Select Agent</option>
                    <option v-if="allContact.type == 2"  v-for="(allContact,index) in allContacts" :key="index" :value="allContact.id">{{allContact.name}}</option>
                </select> -->
                <select v-model="search.customer_id"   id="inputState" class="form-control" style="margin-right:10px" >
                    <option  value="" >Select Customer</option>
                    <option v-if="allContact.type == 1"  v-for="(allContact,index) in allContacts" :key="index" :value="allContact.id">{{allContact.name}}</option>
                </select>
                <select v-model="search.purpose"  class="form-control" style="margin-right:10px">
                    <option value="" >Select Account Type</option>
                    <option v-if="index == 0" disabled style="font-weight:800" v-for="(accountType,index) in getAccountType" :key="index+1000">{{accountType.name.toUpperCase()}}</option>
                    <option v-if="purpose.account_type_id == 15"  v-for="(purpose,index) in purposes" :key="index+2000" :value="purpose.id">{{purpose.name}}</option>
                    <option v-if="index == 1" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                    <option v-if="purpose.account_type_id == 16"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option> -->
                </select>
                <button @click.prevent="searchPR" class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">PN</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Note</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(paymentreceive,index) in paymentreceives.data" :key="index">
                        <td>{{indexf(index)}}</td>
                        <td>{{paymentreceive.date}}</td>
                        <td>{{paymentreceive.pr_number}}</td>
                        <td>{{paymentreceive.customer}}</td>
                        <td>{{paymentreceive.customer_note}}</td>
                        <td>{{paymentreceive.amount}}</td>
                        <td>
                            <i v-if="permission.payment_update || permission.payment_update_all" @click="editPaymentReceiveModal(paymentreceive,index)" class="icon-note icons actn"> </i>
                            <i @click="viewPaymentReceiveModal(paymentreceive)" class="icon-eye icons   actn"> </i>
                            <i v-if="permission.payment_delete || permission.payment_delete_all" @click="deletePayment(index,paymentreceive.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="Object.assign({},paymentreceives)"  @pagination-change-page="getResults" :limit="6"></pagination>
            </nav>
        </div>
        <PaymentReceivedAdd ref="add_payment_received_modal"></PaymentReceivedAdd>
        <PaymentReceivedEdit ref="edit_payment_received_modal"></PaymentReceivedEdit>
        <PaymentReceivedView ref="view_payment_received_modal"></PaymentReceivedView>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import Loader from '../common/Loader'
import pagination from 'laravel-vue-pagination'

import PaymentReceivedAdd from './PaymentReceivedAdd'
import PaymentReceivedEdit from './PaymentReceivedEdit'
import PaymentReceivedView from './PaymentReceivedView'

import { mapState,mapGetters } from "vuex"
import { ALL_PURPOSE,DELETE_PAYMENT_RECEIVE,ALL_USER_ROLE2,SEARCH_INVOICE,ADD_PAYMENT_RECEIVE,ALL_PAYMENT_RECEIVE} from '../../store/action.type';
export default {
    data(){
        return {
            loading:false,
            permission:'',
            search:{
                agent:'',
                customer_id:'',
                purpose:''
            },
            index2:0,
        }
    },
    methods:{
        indexf(index){
            return this.index2+index;
        },
        searchPR(){
            this.getResults();
        },
        getResults(page =1){
            this.loading = true;
            var data = this.search
            if(data != ''){
                this.$store.dispatch('ALL_PAYMENT_RECEIVE',{page,data})
                .then(response=>{
                    this.loading=false;
                    this.index2=response.data.meta.from;
                })
                .catch(error=>{
                    this.loading=false;        
                });
            }
            else{
                this.loading=false;
            }
        },
        addPaymentReceivedModal(){
            this.$refs.add_payment_received_modal.openModal()
        },
        editPaymentReceiveModal(payment,index){
            this.$refs.edit_payment_received_modal.openModal(payment,index)
        },
        viewPaymentReceiveModal(payment){
            this.$refs.view_payment_received_modal.openModal(payment)
        },
        deletePayment(index,id){
            var self = this
            this.$iziToast.question({
                timeout: 10000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                message: 'Are you sure To Delete?',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function (instance, toast) {
                        self.$store.dispatch('DELETE_PAYMENT_RECEIVE',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Invoice Delated Successsfully"})
                            
                        })
                        .catch(error=>{
                            self.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
                        });
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
            
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }],
                ]
            });
        },
        necessaryThings(){
            this.$store.dispatch('ALL_PURPOSE')
            this.$store.dispatch('ALL_CONTACT')
            var id = 4;
            this.$store.dispatch('ALL_ACCOUNT_TYPE2',id)
        },
        getPermission(){
            this.$store.dispatch('ALL_USER_ROLE2')
            .then(response=>{
                this.permission = response.data.permission
            })
        }

    },
    mounted(){
        this.getResults()
        this.getPermission()
        this.necessaryThings();
    },
    computed: {
        ...mapGetters(["getAccountType","invoices","invoices2","purposes","allContacts","paymentreceives"]),
    },
    components: {
        PaymentReceivedAdd,
        PaymentReceivedEdit,
        PaymentReceivedView,
        Loader,
        pagination
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
