<template>
    <b-modal title="Invoice" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="addInvoice">
            <div>
                <div class="form-group row">
                    <!-- <label for="inputPassword3" class="col-sm-2 col-form-label ">Select Customer</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'" @change="customerVisa(newInvoice.customer_id)" name="Customer" v-model="newInvoice.customer_id"  class="form-control" >
                                <option value="" >Select Client</option>
                                <option   :value="contact.id"  v-for="(contact,index) in clients" :key="index">{{contact.name}}</option>
                            </select>
                            <select v-if="customervisas.length>0" v-validate="'required'" name="CustomerVisa" v-model="newInvoice.visa_id"  class="form-control" >
                                <option value="" >Select Visa</option>
                                <option   :value="customervisa.id"  v-for="(customervisa,index) in customervisas" :key="index">{{customervisa.worker_number}}</option>
                            </select>
                            <span v-if="clients.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Customer')" style="color:red">* {{ errors.first('Customer') }}</p>
                    </div> -->
                    <!-- <label for="inputPassword3" class="col-sm-2 col-form-label">Select Agent</label> -->
                    <!-- <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'"  name="Agent" v-model="newInvoice.agent_id"  class="form-control" >
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
                        <input v-validate="'required'" name="Date" v-model="newInvoice.date" type="date" class="form-control" id="inputPassword3" placeholder="Date">
                        <p  v-show="errors.has('Date')" style="color:red">* {{ errors.first('Date') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-4">
                        <input  v-model="newInvoice.due_date" type="date" class="form-control" id="inputPassword3" placeholder="Date">
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Commission Type</label>
                    <div class="col-sm-4">
                        <select v-model="newInvoice.commission_type"  class="form-control" >
                            <option value="">Commission Type</option>
                            <option value="1">%</option>
                            <option value="2">BDT</option>
                        </select>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Commission Amount</label>
                    <div class="col-sm-4">
                        <input v-model="newInvoice.commission_amount" class="form-control"  >
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Total Amount</label>
                    <div class="col-sm-4">
                        <input name="Total" type="number" v-validate="'required'" v-model="newInvoice.total" class="form-control"  >
                        <p  v-show="errors.has('Total')" style="color:red">* {{ errors.first('Total') }}</p>
                    </div>
                    <!-- <label for="inputPassword3" class="col-sm-2 col-form-label">Purpose Type</label>
                    <div class="col-sm-4">
                        <select v-model="newInvoice.account_id"  class="form-control" >
                            <option value="">Purpose Type</option>
                            <option value="1">Processing Rate</option>
                            <option value="2">Update</option>
                            <option value="3">Other's</option>
                        </select>
                    </div> -->
                </div>
                <table class="table table-sm" v-if="invoice_type==2">
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
                        <tr v-for="(invoice,index) in newInvoice.invoice_items">
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
                <div class="form-group row" v-if="invoice_type==2">
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
                            <p class="pull-right"  style="padding-left:10px;margin-top:2px;">{{newInvoice.adjustment}}</p>
                            <input v-model="newInvoice.adjustment" style="margin-right:20px;margin-top:5px;" type="text" class="form-control pull-right col-sm-2 ">
                        </div>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                    <div  class="col-sm-10">
                        <div style="border-top:2px solid #888;margin-top:3px;">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Total</label>
                            <p class="pull-right"  style="padding-left:10px;margin-top:2px;">{{total}}</p>
                            <input v-model="newInvoice.total" type="hidden">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Personal Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" v-model="newInvoice.personal_note" cols="20" rows="5"></textarea>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Customer Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" v-model="newInvoice.customer_note" cols="20" rows="5"></textarea>
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
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE2,ALL_CONTACT,ADD_INVOICE} from "../../../store/action.type"
import { mapState,mapGetters } from "vuex"
import { VueEditor } from 'vue2-editor'
export default {
    props:['newInvoice'],
    data(){
        return{
            invoice_type:1,
            clients:[],
            agents:[],
            projects:[],
            largeModal:false,
            addLoader:false,
            customerVisaLoading:false,
        }
    },
    methods:{
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
            var self = this
            this.newInvoice.invoice_items.forEach(function(element,index){
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
            this.newInvoice.invoice_items.push({
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
            this.newInvoice.invoice_items.splice(index,1)
        },
        openModal(){
            this.largeModal = true
        },
        addInvoice(){
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.newInvoice
                    this.addLoader = true
                    this.$store.dispatch('ADD_INVOICE',data)
                    .then(response=>{
                        this.$parent.getResults();
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Invoice Added Successsfully"})
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
            var subtotal = 0
            var discount = 0
            var tax = 0
            var temp_amount = 0
            this.newInvoice.invoice_items.forEach(element=>{
                discount = 0
                tax = 0
                temp_amount = 0
                temp_amount = (parseFloat(element.quantity)*parseFloat(element.rate))
                discount = ((temp_amount*parseFloat(element.discount))/100)
                tax = ((temp_amount*parseFloat(element.tax))/100)
                element.amount = (temp_amount-discount+tax)
                subtotal = subtotal + element.amount
            })
            this.newInvoice.total = (subtotal - parseFloat(this.newInvoice.adjustment))
            return (subtotal - parseFloat(this.newInvoice.adjustment))
        },
        subtotal(){
            var subtotal = 0
            this.newInvoice.invoice_items.forEach(element=>{
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
