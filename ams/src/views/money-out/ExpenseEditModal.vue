<template>
    <b-modal title="Expense" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="updateExpense">
            <div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Purpose</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select  v-validate="'required'"  name="Purpose" v-model="editExpense.account_id"  class="form-control" >
                                <option value="" >Select Purpose</option>
                                <option v-if="index == 0" disabled style="font-weight:800" v-for="(accountType,index) in getAccountType" :key="index+1000">{{accountType.name.toUpperCase()}}</option>
                                <option v-if="purpose.account_type_id == 17"  v-for="(purpose,index) in purposes" :key="index+2000" :value="purpose.id">{{purpose.name}}</option>
                                <option v-if="index == 1" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                                <option v-if="purpose.account_type_id == 18"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option>
                                <option v-if="index == 2" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                                <option v-if="purpose.account_type_id == 19"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option>
                            </select>
                            <span v-if="purposes.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Purpose')" style="color:red">* {{ errors.first('Purpose') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label ">Select Client</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select  v-validate="'required'"  name="Vendor" v-model="editExpense.vendor_id"  class="form-control" >
                                <option value="" >Select Client</option>
                                <option   :value="contact.id"  v-for="(contact,index) in vendors" :key="index">{{contact.name}}</option>
                            </select>
                            <span v-if="vendors.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Vendor')" style="color:red">* {{ errors.first('Vendor') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-4">
                        <input  v-validate="'required'" name="Date" v-model="editExpense.date" type="date" class="form-control" id="inputPassword3" placeholder="Date">
                        <p  v-show="errors.has('Date')" style="color:red">* {{ errors.first('Date') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Anount</label>
                    <div class="col-sm-4">
                    <input  v-validate="'required|numeric'" name="Amount" v-model="editExpense.amount" type="number" class="form-control" id="inputPassword3" placeholder="Anount">
                    <p  v-show="errors.has('Amount')" style="color:red">* {{ errors.first('Amount') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Total Tax</label>
                    <div class="col-sm-4">
                    <input  v-validate="'required|numeric'" name="Tax" v-model="editExpense.tax_total" type="number" class="form-control" id="inputPassword3" placeholder="Tax">
                    <p  v-show="errors.has('Tax')" style="color:red">* {{ errors.first('Tax') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Total</label>
                    <div  class="col-sm-10">
                        <div style="border-top:2px solid #888;margin-top:3px;">
                            <p class="pull-right"  style="padding-left:10px;margin-top:2px;">{{total}}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Reference Name</label>
                    <div class="col-sm-4">
                    <input v-model="editExpense.reference" type="text" class="form-control" id="inputPassword3" placeholder="Reference Name">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Bank Info</label>
                    <div class="col-sm-4">
                    <input v-model="editExpense.bank_info" type="text" class="form-control" id="inputPassword3" placeholder="Bank Info">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Note</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" v-model="editExpense.note" cols="20" rows="5"></textarea>
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
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE,ALL_CONTACT,UPDATE_EXPENSE} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
import { VueEditor } from 'vue2-editor'
export default {
    data(){
        return{
            vendors:[],
            largeModal:false,
            addLoader:false,
            index:'',
            editExpense:{
                date:'',
                amount:0,
                tax_total:0,
                reference:'',
                account_id:'',
                vendor_id:'',
                account_id:'',
                bank_info:'',
                note:'',
                expense_id:'',
            }
        }
    },
    methods:{
        
        openModal(expense,index){
            this.largeModal = true
            this.index = index
            this.editExpense.expense_id = expense.id
            this.editExpense.date = expense.date
            this.editExpense.amount = expense.amount
            this.editExpense.tax_total = expense.tax_total
            this.editExpense.reference = expense.reference
            this.editExpense.account_id = expense.account_id
            this.editExpense.vendor_id = expense.vendor_id
            this.editExpense.bank_info = expense.bank_info
            this.editExpense.note = expense.note

        },
        updateExpense(){
            this.$validator.validateAll().then( result =>{
                if(result){
                    this.addLoader = true
                    var data = this.editExpense
                    var index = this.index
                    this.$store.dispatch('UPDATE_EXPENSE',{data,index})
                    .then(response=>{
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Expense Updated Successsfully"})
                        
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
        necessaryThings(){
            this.$store.dispatch('ALL_PURPOSE')
            var id = 5
            this.$store.dispatch('ALL_ACCOUNT_TYPE2',id)
        },
        contactVendors(){
            return new Promise((resolve, reject) => {
                var type = 4
                axios.get("api/specific/contacts/"+type)
                .then(response => {
                    this.vendors = response.data
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                });
            });
        },
    },
    mounted(){
        this.necessaryThings()
        this.contactVendors()
    },
    computed:{
        ...mapGetters(["getAccountType","purposes"]),
        total(){
            return (parseFloat(this.editExpense.amount)+parseFloat(this.editExpense.tax_total))
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
