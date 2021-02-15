<template>
    <b-modal title="Payment Made" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="addPayment">
            <div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label ">Select Vendor</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select @change="UnpaidBill(payment.customer_id)" v-validate="'required'"  name="Customer" v-model="payment.customer_id"  class="form-control" >
                                <option value="" >Select Client</option>
                                <option   :value="contact.id"  v-for="(contact,index) in clients" :key="index">{{contact.name}}</option>
                            </select>
                            <span v-if="clients.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Customer')" style="color:red">* {{ errors.first('Customer') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label"> Amount</label>
                    <div  class="col-sm-4">
                        <input type="number" v-on:keyup="amountf(payment.amount)" v-model="payment.amount" class="form-control"  >
                        <p>Total Due : {{total_due_tem}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-4">
                        <input v-validate="'required'" name="Date" v-model="payment.date" type="date" class="form-control" id="inputPassword3" placeholder="Date">
                        <p  v-show="errors.has('Date')" style="color:red">* {{ errors.first('Date') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Payment Mode</label>
                    <div class="col-sm-4">
                        <select v-model="payment.payment_mode_id"  class="form-control" >
                            <option value="">Select Payment Mode</option>
                            <option value="1">Cash</option>
                            <option value="2">Bank Cheque</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    
                    <label  class="col-sm-2 col-form-label">Reference#</label>
                    <div class="col-sm-4">
                        <input v-model="payment.reference" class="form-control"  >
                    </div>
                </div>
                <!-- <table class="table table-sm" v-if="payment.invoices.length>0">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Due Amount</th>
                            <th scope="col">Note</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(invoice,index) in payment.invoices" :key="index">
                            <td>{{invoice.date}}</td>
                            <td>{{invoice.invoice_number}}</td>
                            <td>{{invoice.total}}</td>
                            <td>{{invoice.due_amount}}</td>
                            <td><input type="text" v-model="invoice.note" class="form-control"></td>
                            <td><input disabled type="number" v-on:keyup="invoiceamount(index,invoice.amount)" v-model="invoice.amount" class="form-control"></td>
                        </tr>
                    </tbody>
                </table> -->
                <!-- <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                    <div  class="col-sm-10">
                        <div style="border-top:2px solid #888;margin-top:3px;">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Excess Amount</label>
                            <p class="pull-right"  style="padding-left:10px;margin-top:2px;">{{excessAmount}}</p>
                        </div>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" v-model="payment.note" cols="20" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                <input v-if="!addLoader" type="submit" value="Submit" class="btn btn-primary pull-right"/>
                <button v-if="addLoader" class="btn btn-primary pull-right" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Submitting...
                </button>
                <button v-if="!addLoader"  @click.prevent="close" class="btn btn-success pull-right" style="margin-right:5px;">Close</button>
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
import Vue from 'vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate)
import axios from 'axios'
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE2,ALL_CONTACT,ADD_PAYMENT_RECEIVE} from "../../../store/action.type"
import { mapState,mapGetters } from "vuex"
import { VueEditor } from 'vue2-editor'
export default {
    props:['payment','index'],
    data(){
        return{
            clients:[],
            agents:[],
            projects:[],
            largeModal:false,
            addLoader:false,
            unpaidBillLoading:false,
            total_due:0,
            tem_amount:0,
            total_due_tem:0,
        }
    },
    methods:{
        // invoiceamount(index,amount){
        //     alert(amount);
        //     if(amount<=this.payment.invoices[index].due_amount){
        //         this.payment.invoices[index].amount=amount;
        //     }
        // },
        amountf(amount){
            if(amount==''){
                amount=0;
            }
            if(parseInt(amount)>=0){
            if(amount<=this.total_due){ 
                this.total_due_tem = parseInt(this.total_due)-parseInt(amount);
                var temp_amount = amount;
            }else{
                this.total_due_tem = 0;
                this.payment.amount = this.total_due;
            }
            }else{
                alert('please input number')
            }
        },
        UnpaidBill(id){
            this.total_due_tem = 0;
            this.total_due = 0;
            this.payment.invoices = []
            this.unpaidBillLoading=true;
            axios
            .get("/api/unpaid/bills/"+id)
            .then(response => {
                this.total_due = response.data;
                this.total_due_tem = response.data;
                this.unpaidBillLoading=false;
            })
            .catch(function(error) {
                 this.unpaidBillLoading=false;      
            });
        },
       
        openModal(id){
            this.total_due_tem = 0;
            this.largeModal = true
            this.UnpaidBill(id);
        },
        addPayment(){
            this.payment.due = this.total_due_tem;
            this.$validator.validateAll().then( result =>{
                if(result){
                    this.addLoader = true
                    
                    this.$store.dispatch('ADD_PAYMENT_MADE',this.payment)
                    .then(response=>{
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Payment Made Added Successsfully"})
                    })
                    .catch(error=>{
                        this.addLoader = false; 
                        this.$iziToast.error({position:'topRight',title:'Error',message:error.response.data.error})       
                    });
                }
            })
        },
        close(){
            this.largeModal = false
        },
        contactClients(){
            return new Promise((resolve, reject) => {
                var type = 1
                axios.get("api/specific/contacts/"+type)
                .then(response => {
                    this.clients = response.data
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                });
            });
        },
        contactAgents(){
            return new Promise((resolve, reject) => {
                var type = 2
                axios.get("api/specific/contacts/"+type)
                .then(response => {
                    this.agents = response.data
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                });
            });
        },
        allProjects(){
            return new Promise((resolve, reject) => {
                axios.get("api/project-all")
                .then(response => {
                    console.log(response)
                    this.projects = response.data
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                });
            });
        },
        necessaryThings(){
            this.$store.dispatch('ALL_PURPOSE')
            this.contactClients()
            this.contactAgents()
            this.allProjects()
            var id = 4;
            this.$store.dispatch('ALL_ACCOUNT_TYPE2',id)
        }
    },
    mounted(){
        this.necessaryThings()
    },
    computed:{
        ...mapGetters(["getAccountType","purposes","allContacts","unpaidInvoices"]),
       
        excessAmount(){
            let amount = 0
            this.payment.invoices.forEach(invoice=>{
                amount = amount + invoice.amount 
            })
            let ramount = this.payment.amount-amount;
            if(ramount>0){
                return this.payment.amount-amount;
            }else{
                return 0;
            }
        }
    },
    components:{
        VueEditor
    }
}
</script>

<style>
#preview {
        height: 120px;
        width: 70%;
    }
    #preview img{
        height: 100%;
        width: 100%;
    }
</style>
