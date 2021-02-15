<template>
    <b-modal title="Invoice" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="updateInvoice">
            <div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label ">Select Customer</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'"  name="Customer" v-model="editInvoice.customer_id"  class="form-control" >
                                <option value="" >Select Client</option>
                                <option   :value="contact.id"  v-for="(contact,index) in clients" :key="index">{{contact.name}}</option>
                            </select>
                            <select v-if="invoice_type == 1" v-validate="'required'" name="CustomerVisa" v-model="editInvoice.visa_id"  class="form-control" >
                                <option value="" >Select Visa</option>
                                <option   :value="customervisa.id"  v-for="(customervisa,index) in customervisas" :key="index">{{customervisa.worker_number}}</option>
                            </select>
                            <!-- <p  v-show="errors.has('CustomerVisa')" style="color:red">* {{ errors.first('CustomerVisa') }}</p> -->
                        </div>
                        <p  v-show="errors.has('Customer')" style="color:red">* {{ errors.first('Customer') }}</p>
                    </div>
                    <label v-if="customervisas.length>0 && invoice_type==1 " for="inputPassword3" class="col-sm-2 col-form-label">Select Visa</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-if="customervisas.length>0 && invoice_type==1 "  name="CustomerVisa" v-model="editInvoice.visa_id"  class="form-control" >
                                <option value="" >Select Visa</option>
                                <option   :value="customervisa.id"  v-for="(customervisa,index) in customervisas" :key="index">{{customervisa.worker_number}}</option>
                            </select>
                        </div>
                         <p v-show="errors.has('CustomerVisa')" style="color:red">* {{ errors.first('CustomerVisa') }}</p>
                    </div>
                    <!-- <label for="inputPassword3" class="col-sm-2 col-form-label">Select Agent</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'"  name="Agent" v-model="editInvoice.agent_id"  class="form-control" >
                                <option value="" >Select Agent</option>
                                <option  :value="contact.id" v-for="(contact,index) in agents" :key="index+1000">{{contact.name}}</option>
                            </select>
                            <span  v-if="agents.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Agent')" style="color:red">* {{ errors.first('Agent') }}</p>
                    </div> -->
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-4">
                        <input v-validate="'required'" name="Date" v-model="editInvoice.date" type="date" class="form-control" id="inputPassword3" placeholder="Date">
                        <p  v-show="errors.has('Date')" style="color:red">* {{ errors.first('Date') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-4">
                        <input  v-model="editInvoice.due_date" type="date" class="form-control" id="inputPassword3" placeholder="Date">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Commission Type</label>
                    <div class="col-sm-4">
                        <select v-model="editInvoice.commission_type"  class="form-control" >
                            <option value="">Commission Type</option>
                            <option value="1">%</option>
                            <option value="2">BDT</option>
                        </select>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Commission Amount</label>
                    <div class="col-sm-4">
                        <input v-model="editInvoice.commission_amount" class="form-control"  >
                    </div>
                </div>
                <div v-if="invoice_type == 1" class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Total Amount</label>
                    <div class="col-sm-4">
                        <input name="Total" v-validate="'required'" v-model="editInvoice.total" class="form-control"  >
                        <p  v-show="errors.has('Total')" style="color:red">* {{ errors.first('Total') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Purpose Type</label>
                    <div class="col-sm-4">
                        <select v-model="editInvoice.account_id"  class="form-control" >
                            <option value="" >Select Purpose</option>
                            <option v-if="index == 0" disabled style="font-weight:800" v-for="(accountType,index) in getAccountType" :key="index+1000">{{accountType.name.toUpperCase()}}</option>
                            <option v-if="purpose.account_type_id == 15"  v-for="(purpose,index) in purposes" :key="index+2000" :value="purpose.id">{{purpose.name}}</option>
                            <option v-if="index == 1" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                            <option v-if="purpose.account_type_id == 16"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option>
                        </select>
                    </div>
                </div>
                <table v-if="invoice_type == 2" class="table table-sm" >
                    <thead>
                        <tr>
                            <th scope="col">Prject</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Discount(%)</th>
                            <th scope="col">Tax</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(invoice,index) in editInvoice.invoice_items">
                            <td>
                                <select @change="proRate(index)" v-validate="'required'"   v-model="invoice.project_id" class="form-control" >
                                    <option value="" >Select Project</option>
                                    <option :value="project.id"  v-for="(project,index) in projects" :key="index">{{project.name}}</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" v-model="invoice.quantity" class="form-control" >
                            </td>
                            <td>
                                <input  v-model="invoice.rate" class="form-control" >
                            </td>
                            <td>
                                <input  v-model="invoice.discount" class="form-control" >
                            </td>
                            <td>
                                <select v-model="invoice.tax" class="form-control" >
                                    <option value="0">0%</option>
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                </select>
                            </td>
                            <td>
                                <input v-model="invoice.amount" type="text" class="form-control" >
                            </td>
                            <td>
                                <select  v-model="invoice.purpose_id"  class="form-control" >
                                    <option value="" >Select Purpose</option>
                                    <option v-if="index == 0" disabled style="font-weight:800" v-for="(accountType,index) in getAccountType" :key="index+1000">{{accountType.name.toUpperCase()}}</option>
                                    <option v-if="purpose.account_type_id == 15"  v-for="(purpose,index) in purposes" :key="index+2000" :value="purpose.id">{{purpose.name}}</option>
                                    <option v-if="index == 1" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                                    <option v-if="purpose.account_type_id == 16"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option> -->
                                </select>
                            </td>
                            <td>
                                <i v-if="index == 0" @click="addInvPro" class="icon-plus icons actn"> </i>
                                <i v-if="index != 0" @click="removeInvPro(index)" class="icon-minus icons actn"> </i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group row" v-if="invoice_type == 2 ">
                    <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                    <div  class="col-sm-10">
                        <div style="border-top:2px solid #888;margin-top:3px;">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Subtotal</label>
                            <p class="pull-right"  style="padding-left:10px;margin-top:2px;">{{subtotal}}</p>
                        </div>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                    <div  class="col-sm-10">
                        <div style="border-top:2px solid #888;margin-top:3px;">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Adjustment</label>
                            <p class="pull-right"  style="padding-left:10px;margin-top:2px;">{{editInvoice.adjustment}}</p>
                            <input v-model="editInvoice.adjustment" style="margin-right:20px;margin-top:5px;" type="text" class="form-control pull-right col-sm-2 ">
                        </div>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                    <div  class="col-sm-10">
                        <div style="border-top:2px solid #888;margin-top:3px;">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Total</label>
                            <p class="pull-right"  style="padding-left:10px;margin-top:2px;">{{total}}</p>
                            <input v-model="editInvoice.total" type="hidden">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label v-if="invoice_type==2 || invoice_type==1" for="inputPassword3" class="col-sm-2 col-form-label">Mode</label>
                    <div v-if="invoice_type==2 || invoice_type==1" class="col-sm-4">
                        <select v-model="editInvoice.mode" class="form-control" >
                            <option value="0">Select Mode</option>
                            <option value="1">Cash</option>
                            <option value="2">Bank Checque</option>
                            <!-- <option value="3">Installment</option> -->
                        </select>
                    </div>
                    <label v-if="editInvoice.mode == 3" for="inputPassword3" class="col-sm-2 col-form-label">Down Payment</label>
                    <div v-if="editInvoice.mode == 3" class="col-sm-4">
                        <input @keyup="perinstallment" class="form-control" v-model="editInvoice.down_payment" >
                    </div>
                </div>
                <div class="form-group row">
                    <label v-if="editInvoice.mode == 3" for="inputPassword3" class="col-sm-2 col-form-label">Installment Type</label>
                    <div class="col-sm-4">
                        <select v-if="editInvoice.mode == 3" v-model="editInvoice.installment_type" class="form-control" >
                            <option value="">Select Installment Type</option>
                            <option value="1">Weakly</option>
                            <option value="2">Monthly</option>
                        </select>
                    </div>
                    <label v-if="editInvoice.mode == 3 && editInvoice.total > 0" for="inputPassword3" class="col-sm-2 col-form-label">Total Installment</label>
                    <div class="col-sm-4">
                        <input  @keyup="perinstallment" v-if="editInvoice.mode == 3 && editInvoice.total > 0" class="form-control" v-model="editInvoice.total_installment" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Personal Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" v-model="editInvoice.personal_note" cols="20" rows="5"></textarea>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Customer Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" v-model="editInvoice.customer_note" cols="20" rows="5"></textarea>
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
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE2,ALL_CONTACT,UPDATE_INVOICE,CUSTOMER_VISA} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
import { VueEditor } from 'vue2-editor'
export default {
    data(){
        return{
            invoice_type:1,
            clients:[],
            agents:[],
            projects:[],
            largeModal:false,
            addLoader:false,
            index:'',
            editInvoice:{
                invoice_id:'',
                date:'',
                account_id:'',
                agent_id:'',
                visa_id:'',
                customer_id:'',
                invoice_number:'',
                due_date:'',
                customer_id:'',
                agent_id:'',
                commission_type:'',
                commission_amount:'',
                shipping_charge:'',
                adjustment:0,
                total:0,
                mode:0,
                down_payment:0,
                total_installment:0,
                per_installment_amount:0,
                installment_type:'',
                personal_note:'',
                customer_note:'',
                invoice_items:[],
            },
            customerVisaLoading:false,
        }
    },
    methods:{
        perinstallment(){
            this.editInvoice.per_installment_amount = ((this.editInvoice.total-this.editInvoice.down_payment)/this.editInvoice.total_installment)
            // alert("ok")
        },
        customerVisa(id){
            this.customerVisaLoading=true;
            this.$store.dispatch('CUSTOMER_VISA',id)
            .then(response=>{
               this.customerVisaLoading=false; 
            })
            .catch(error=>{
               this.customerVisaLoading=false;       
            });
        },
        proRate(index_item){
            if(this.editInvoice.invoice_items == null){
                this.editInvoice.invoice_items = [{
                    project_id:'',
                    quantity:1,
                    rate:0,
                    discount:0,
                    tax:0,
                    amount:0,
                    purpose_id:''
                }]
            }
            var self = this
            this.editInvoice.invoice_items.forEach(function(element,index){
                if(index_item == index){
                    self.projects.forEach(project=>{
                        if(project.id == element.project_id){
                            element.rate = project.sales_price
                        }
                    })
                    
                }
            })
        },
        addInvPro(){
            this.editInvoice.invoice_items.push({
                    project_id:'',
                    quantity:1,
                    rate:0,
                    discount:0,
                    tax:0,
                    amount:0,
                    purpose_id:''
                })
        },
        removeInvPro(index){
            this.editInvoice.invoice_items.splice(index,1)
        },
        openModal(invoice,index){
            console.log(invoice)
            this.customerVisa(invoice.customer_id);
            this.index = index;
            this.largeModal = true
            this.editInvoice.invoice_id = invoice.id
            this.editInvoice.visa_id = invoice.visa_id
            this.editInvoice.account_id = invoice.account_id
            this.editInvoice.invoice_items = invoice.invoice_items
            this.editInvoice.date = invoice.date
            this.editInvoice.agent_id = invoice.agent_id
            this.editInvoice.customer_id = invoice.customer_id
            this.editInvoice.invoice_number = invoice.invoice_number
            this.editInvoice.due_date = invoice.due_date
            this.editInvoice.customer_id = invoice.customer_id
            this.editInvoice.agent_id = invoice.agent_id
            this.editInvoice.commission_type = invoice.commission_type
            this.editInvoice.commission_amount = invoice.commission_amount
            this.editInvoice.shipping_charge = invoice.shipping_charge
            this.editInvoice.adjustment = invoice.adjustment
            this.editInvoice.total = invoice.total
            this.editInvoice.mode = invoice.mode
            this.editInvoice.down_payment = invoice.down_payment
            this.editInvoice.total_installment = invoice.total_installment
            this.editInvoice.per_installment_amount = invoice.per_installment_amount
            this.editInvoice.installment_type = invoice.installment_type
            this.editInvoice.personal_note = invoice.personal_note
            this.editInvoice.customer_note = invoice.customer_note
            // if(invoice.invoice_items == null){
            //     this.invoice_type = 1
            // }else{
            //    this.invoice_type = 2 
            // }
        },
        updateInvoice(){
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.editInvoice
                    var index = this.index
                    this.addLoader = true
                     this.$store.dispatch('UPDATE_INVOICE',{data,index})
                    .then(response=>{
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Invoice Updated Successsfully"})
                        
                    })
                    .catch(error=>{
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
        ...mapGetters(["getAccountType","purposes","allContacts","customervisas"]),
        total(){
            if(this.editInvoice.invoice_items == null){
                this.editInvoice.invoice_items = [{
                    project_id:'',
                    quantity:1,
                    rate:0,
                    discount:0,
                    tax:0,
                    amount:0,
                    purpose_id:''
                }]
            }
            var subtotal = 0
            var discount = 0
            var tax = 0
            var temp_amount = 0
            this.editInvoice.invoice_items.forEach(element=>{
                discount = 0
                tax = 0
                temp_amount = 0
                temp_amount = (parseFloat(element.quantity)*parseFloat(element.rate))
                discount = ((temp_amount*parseFloat(element.discount))/100)
                tax = ((temp_amount*parseFloat(element.tax))/100)
                element.amount = (temp_amount-discount+tax)
                subtotal = subtotal + element.amount
            })
            this.editInvoice.total = (subtotal - parseFloat(this.editInvoice.adjustment))
            this.editInvoice.per_installment_amount = ((this.editInvoice.total-this.editInvoice.down_payment)/this.editInvoice.total_installment).toFixed(2)
            return (subtotal - parseFloat(this.editInvoice.adjustment))
        },
        subtotal(){
            var subtotal = 0
            if(this.editInvoice.invoice_items == null){
                this.editInvoice.invoice_items = [{
                    project_id:'',
                    quantity:1,
                    rate:0,
                    discount:0,
                    tax:0,
                    amount:0,
                    purpose_id:''
                }]
            }
            this.editInvoice.invoice_items.forEach(element=>{
                subtotal = subtotal + element.amount 
            })
            return subtotal
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
