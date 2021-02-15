<template>
    <b-modal title="Payment Receive" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="updatePayment">
            <div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label ">Select Customer</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select disabled v-validate="'required'"  name="Customer" v-model="list.customer_id"  class="form-control" >
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
                        <input type="number" v-on:keyup="amountf(list.amount)" v-model="list.amount" class="form-control"  >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-4">
                        <input v-validate="'required'" name="Date" v-model="list.date" type="date" class="form-control" id="inputPassword3" placeholder="Date">
                        <p  v-show="errors.has('Date')" style="color:red">* {{ errors.first('Date') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Payment Mode</label>
                    <div class="col-sm-4">
                        <select v-model="list.payment_mode_id"  class="form-control" >
                            <option value="">Select Payment Mode</option>
                            <option value="1">Cash</option>
                            <option value="2">Bank Cheque</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    
                    <label  class="col-sm-2 col-form-label">Reference#</label>
                    <div class="col-sm-4">
                        <input v-model="list.reference" class="form-control"  >
                    </div>
                </div>
                <!-- <table class="table table-sm" v-if="list.invoices.length>0">
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
                        <tr v-for="(invoice,index) in list.invoices" :key="index">
                            <td>{{invoice.date}}</td>
                            <td>{{invoice.invoice_number}}</td>
                            <td>{{invoice.total}}</td>
                            <td>{{invoice.due_amount}}</td>
                            <td><input type="text" v-model="invoice.note" class="form-control"></td>
                            <td><input disabled type="number" v-on:keyup="invoiceamount(index,invoice.amount)" v-model="invoice.amount" class="form-control"></td>
                        </tr>
                    </tbody>
                </table> -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                    <div  class="col-sm-10">
                        <div style="border-top:2px solid #888;margin-top:3px;">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Excess Amount</label>
                            <p class="pull-right"  style="padding-left:10px;margin-top:2px;">{{excessAmount}}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" v-model="list.customer_note" cols="20" rows="5"></textarea>
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
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE2,ALL_CONTACT,UPDATE_PAYMENT_RECEIVE} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
import { VueEditor } from 'vue2-editor'
export default {
    data(){
        return{
            clients:[],
            agents:[],
            projects:[],
            largeModal:false,
            addLoader:false,
            unpaidInvoiceLoading:false,
            index:'',
            list:{
                payment_id:'',
                date:'',
                customer_id:'',
                amount:'',
                reference:'',
                customer_note:'',
                payment_mode_id:'',
                invoices:[],
            }
        }
    },
    methods:{
        openModal(payment,index){
            this.largeModal = true
            this.index = index
            this.list.payment_id = payment.id
            this.list.date = payment.date
            this.list.customer_id = payment.customer_id
            this.list.amount = payment.amount
            this.list.reference = payment.reference
            this.list.customer_note = payment.customer_note
            this.list.payment_mode_id = payment.payment_mode
            this.list.invoices = payment.invoices
            // this.list.invoices = payment.invoices
            //this.UnpaidInvoice()
            
        },
        amountf(amount){
            if(isNaN(amount)!=true){
            var temp_amount = amount;
            this.list.invoices.forEach(invoice=>{
                if(parseInt(temp_amount)<=parseInt(invoice.due_amount)){
                    invoice.amount = temp_amount;
                    temp_amount = 0;
                }else{
                    invoice.amount = invoice.due_amount;
                    let temamount = parseInt(temp_amount-invoice.due_amount);
                    if(temamount<0){
                        temp_amount = 0;
                    }else{
                        temp_amount = temamount;
                    }
                }
            });
            }else{

                alert('please input number')
            }
        },
        UnpaidInvoice(){
            var id = this.list.customer_id
            this.list.invoices = []
            this.unpaidInvoiceLoading=true;
            this.$store.dispatch('UNPAID_INVOICE',id)
            .then(response=>{
                console.log(response)
                var thisf = this;
                var invoicedata = response.data;
                invoicedata.forEach(invoice=>{
                    let obj = {
                        date:invoice.date,
                        invoice_number:invoice.invoice_number,
                        invoice_id:invoice.id,
                        total:invoice.total,
                        due_amount:invoice.due_amount,
                        adjustment:'',
                        note:'',
                        amount:'',
                    };
                    thisf.list.invoices.push(obj);
                    thisf.amountf(thisf.list.amount)
                })
                this.unpaidInvoiceLoading=false;
            })
            .catch(error=>{
                this.unpaidInvoiceLoading=false;       
            });
        },
        updatePayment(){
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.list
                    var index = this.index
                    this.addLoader = true
                     this.$store.dispatch('UPDATE_PAYMENT_RECEIVE',{data,index})
                    .then(response=>{
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Invoice Updated Successsfully"})
                        
                    })
                    .catch(error=>{
                        console.log(error.response)
                        this.addLoader = false; 
                        this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
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
            this.list.invoices.forEach(invoice=>{
                amount = amount + invoice.amount 
            })
            let ramount = this.list.amount-amount;
            if(ramount>0){
                return this.list.amount-amount;
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
