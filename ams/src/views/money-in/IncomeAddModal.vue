<template>
    <b-modal title="Income" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="addIncome">
            <div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Purpose</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'"  name="Account type" v-model="newIncome.account_id"  class="form-control" >
                                <option value="" >Select Account Type</option>
                                <option v-if="index == 0" disabled style="font-weight:800" v-for="(accountType,index) in getAccountType" :key="index+1000">{{accountType.name.toUpperCase()}}</option>
                                <option v-if="purpose.account_type_id == 15"  v-for="(purpose,index) in purposes" :key="index+2000" :value="purpose.id">{{purpose.name}}</option>
                                <option v-if="index == 1" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                                <option v-if="purpose.account_type_id == 16"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option> -->
                            </select>
                            <span v-if="purposes.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Account type')" style="color:red">* {{ errors.first('Account type') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label ">Select Customer</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'"  name="Customer" v-model="newIncome.customer_id"  class="form-control" >
                                <option value="" >Select Client</option>
                                <option   :value="contact.id"  v-for="(contact,index) in clients" :key="index">{{contact.name}}</option>
                            </select>
                            <span v-if="clients.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Customer')" style="color:red">* {{ errors.first('Customer') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Anount</label>
                    <div class="col-sm-4">
                    <input v-validate="'required|numeric'" name="Amount" v-model="newIncome.amount" type="number" class="form-control" id="inputPassword3" placeholder="Anount">
                    <p  v-show="errors.has('Amount')" style="color:red">* {{ errors.first('Amount') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Discount</label>
                    <div class="col-sm-4">
                        <input v-validate="'required|numeric'" name="Discount" v-model="newIncome.discount" type="number" class="form-control" id="inputPassword3" placeholder="Discount">
                        <p  v-show="errors.has('Discount')" style="color:red">* {{ errors.first('Discount') }}</p>
                    </div>
                   
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Due Date</label>
                    <div class="col-sm-4">
                        <input  v-model="newIncome.date" type="date" class="form-control" id="inputPassword3" placeholder="Date">
                    </div>
                     <label  for="inputPassword3" class="col-sm-2 col-form-label">Mode</label>
                    <div  class="col-sm-4">
                        <select v-validate="'required|numeric'" v-model="newIncome.mode" name="mode" class="form-control" >
                            <option value="null">Select Mode</option>
                            <option value="1">Cash</option>
                            <option value="2">Bank Checque</option>
                        </select>
                        <p  v-show="errors.has('mode')" style="color:red">* {{ errors.first('mode') }}</p>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Reference Name</label>
                    <div class="col-sm-4">
                    <input v-model="newIncome.reference" type="text" class="form-control" id="inputPassword3" placeholder="Reference Name">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Bank Info</label>
                    <div class="col-sm-4">
                    <input v-model="newIncome.bank_info" type="text" class="form-control" id="inputPassword3" placeholder="Bank Info">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Note</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" v-model="newIncome.note" cols="20" rows="5"></textarea>
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
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE2,ALL_CONTACT,ADD_INCOME} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
import { VueEditor } from 'vue2-editor'
export default {
    data(){
        return{
            clients:[],
            agents:[],
            largeModal:false,
            addLoader:false,
            newIncome:{
                date:'',
                amount:0,
                utility:0,
                car_parking:0,
                registration_cost:0,
                gift:0,
                discount:0,
                other_cost:0,
                reference:'',
                account_id:'',
                agent_id:'',
                customer_id:'',
                bank_info:'',
                mode:'',
                note:'',
            }
        }
    },
    methods:{
        openModal(){
            this.largeModal = true
        },
        addIncome(){
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.newIncome
                    this.addLoader = true
                    this.$store.dispatch('ADD_INCOME',data)
                    .then(response=>{
                        this.newIncome={
                            date:'',
                            amount:0,
                            utility:0,
                            car_parking:0,
                            registration_cost:0,
                            gift:0,
                            discount:0,
                            other_cost:0,
                            reference:'',
                            account_id:'',
                            agent_id:'',
                            customer_id:'',
                            bank_info:'',
                            mode,
                            note:'',
                        };
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Income Added Successsfully"})
                        
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
        necessaryThings(){
            this.$store.dispatch('ALL_PURPOSE')
            this.contactClients()
            this.contactAgents()
            var id = 4;
            this.$store.dispatch('ALL_ACCOUNT_TYPE2',id)
        }
    },
    mounted(){
        this.necessaryThings()
    },
    computed:{
        ...mapGetters(["getAccountType","purposes","allContacts"]),
        total(){
            return ((parseFloat(this.newIncome.amount)+parseFloat(this.newIncome.utility)+parseFloat(this.newIncome.car_parking)+parseFloat(this.newIncome.registration_cost)+parseFloat(this.newIncome.other_cost))-(parseFloat(this.newIncome.discount)+parseFloat(this.newIncome.gift)))
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
