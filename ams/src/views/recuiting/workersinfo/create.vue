
<template>
    <b-modal :title="title+' Add Form'" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="addVisa" >
            <div class="container custom_modal_body">
               
                 <div class="form-group row"  v-if="this.permission.recuiting_update">
                        <label for="inputPassword3" class="col-sm-2 col-form-label ">Select Customer</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <select v-validate="'required'" @change="errorClear('user_id')" name="Client" v-model="list.user_id"  class="form-control" >
                                    <option value="" >Select Client</option>
                                    <option  v-if="contact.type == 1" :value="contact.id"  v-for="(contact,index) in allContacts" :key="index">{{contact.name}}</option>
                                </select>
                            </div>
                            <p style="color:red;" v-for="(servererror,k) in serverErrors.user_id" v-bind:key="'u'+k">{{servererror}}</p>
                            <p style="color:red" v-for="(error,k) in errors.user_id" v-bind:key="'user_id'+k">{{error}}</p>
                        </div>
                        <label v-if="this.$parent.type==5" for="inputPassword3" class="col-sm-2 col-form-label">Select Company</label>
                        <div class="col-sm-4" v-if="this.$parent.type==5">
                            <div class="input-group">
                                <select  name="Category" v-model="list.company_id"  class="form-control" >
                                    <option value="" >Select Company</option>
                                    <option :value="company.id" v-for="(company,key) in companies" v-bind:key="key">{{company.name}}</option>
                                </select>
                            </div>
                            <p style="color:red" v-for="(error,k) in errors.company_id" v-bind:key="'user_id'+k">{{error}}</p>
                        </div>
                    <!--  <label for="inputPassword3" class="col-sm-2 col-form-label">Select Agent</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <select :disabled="list.entryType!=1" @change="errorClear('agent_id')" name="Category" v-model="list.agent_id"  class="form-control" >
                                    <option value="" >Select Agent</option>
                                    <option v-if="contact.type == 2" :value="contact.id" v-for="(contact,index) in allContacts" :key="index+1000">{{contact.name}}</option>
                                </select>
                            </div>
                            <p style="color:red" v-for="(error,k) in errors.agent_id" v-bind:key="'user_id'+k">{{error}}</p>
                        </div> -->
                    </div>
                    <div class="form-group row"  v-if="this.permission.recuiting_update">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Passport Name</label>
                        <div class="col-sm-4">
                        <input @keydown="errorClear('passport_name')"  v-model="list.passport_name"  type="text" class="form-control" id="inputPassword3" placeholder="passport name">
                        <p style="color:red" v-for="(error,k) in errors.passport_name" v-bind:key="'passport_name'+k">{{error}}</p>
                        <p style="color:red;" v-for="(servererror,k) in serverErrors.passport_name" v-bind:key="'u'+k">{{servererror}}</p>

                        </div>
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Passport Number</label>
                        <div class="col-sm-4">
                        <input @keydown="errorClear('passport_number')" v-model="list.passport_number" type="text" class="form-control" id="inputPassword3" placeholder="passport number">
                        <p style="color:red" v-for="(error,k) in errors.passport_number" v-bind:key="'user_id'+k">{{error}}</p>
                        <p style="color:red;" v-for="(servererror,k) in serverErrors.passport_number" v-bind:key="'u'+k">{{servererror}}</p>
                        </div>
                        
                    </div>
                    <div class="form-group row"  v-if="this.permission.recuiting_update">
                        
                        <label for="inputPassword3" v-if="this.$parent.type==5" class="col-sm-2 col-form-label">Commission Rate</label>
                        <label for="inputPassword3" v-else class="col-sm-2 col-form-label">Processing Rate</label>
                        <div class="col-sm-4">
                        <input  @keydown="errorClear('processing_rate')" v-model="list.processing_rate" type="text"  class="form-control" id="inputPassword3" placeholder="rate">
                        <p style="color:red;" v-for="(servererror,k) in serverErrors.processing_rate" v-bind:key="'u'+k">{{servererror}}</p>
                        
                        </div>
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Visa Number</label>
                        <div class="col-sm-4">
                        <input @keydown="errorClear('visa_number')" v-model="list.visa_number"  type="text" class="form-control" id="inputPassword3" placeholder="visa number">
                        <p style="color:red" v-for="(error,k) in errors.visa_number" v-bind:key="'user_id'+k">{{error}}</p>
                        <p style="color:red;" v-for="(servererror,k) in serverErrors.visa_number" v-bind:key="'u'+k">{{servererror}}</p>
                    
                        </div>

                        <label v-if="this.$parent.type==5" for="inputPassword3" class="col-sm-2 col-form-label">Company Rate</label>
                        
                        <div class="col-sm-4" v-if="this.$parent.type==5">
                            <input  @keydown="errorClear('company_rate')" v-model="list.company_rate" type="text"  class="form-control" id="inputPassword3" placeholder="company rate">
                            <p style="color:red;" v-for="(servererror,k) in serverErrors.company_rate" v-bind:key="'u'+k">{{servererror}}</p>
                        </div>
                        
                    </div>
                    <div class="form-group row"  v-if="this.permission.recuiting_update">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Company ID Number</label>
                        <div class="col-sm-4">
                        <input v-model="list.company_id_number"  type="text" class="form-control" id="inputPassword3" placeholder="company id number">
                        </div>
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Occupation</label>
                        <div class="col-sm-4">
                        <input v-model="list.occupation"  type="text" class="form-control" id="inputPassword3" placeholder="occupation">
                        <p style="color:red;" v-for="(servererror,k) in serverErrors.occupation" v-bind:key="'u'+k">{{servererror}}</p>
                        
                        </div>
                    </div>
                    <div class="form-group row" v-if="this.permission.recuiting_update">
                        <label for="inputPassword3" class="col-sm-2 col-form-label ">Select gender</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <select  name="Category"  v-model="list.gender"  class="form-control">
                                    <option value="" selected>Select gender</option>
                                    <option value="Male" >Male</option>
                                    <option value="Female" >Female</option>
                                    <option value="Others" >Others</option>
                                </select>
                            </div>
                        </div>
                        <label for="workernumber" class="col-sm-2 col-form-label">Worker Number</label>
                        <div class="col-sm-4">
                        <input v-model="list.worker_number" disabled type="text" class="form-control" id="workernumber" placeholder="workernumber">
                        </div>
                    </div>
                    <div class="form-group row" v-if="this.permission.recuiting_update">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Diving Licence </label>
                        <div class="col-sm-4">
                            <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.diving_licence_status" type="checkbox" id="diving_licence_status"  checked="checked" class="custom-control-input"><label  for="diving_licence_status" class="custom-control-label">Status</label>
                            </div>
                        </div>
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Police Clearence</label>
                        <div class="col-sm-4">
                            <div  class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.police_clearence_status" type="checkbox" id="police_clearence_status"  checked="checked" class="custom-control-input"><label  for="police_clearence_status" class="custom-control-label">Status</label>
                            </div>
                        </div>
                    </div>
                <div class="form-group row" v-if="this.permission.medical_update">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Medical</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.medical_status" type="checkbox" id="medical_status"  checked="checked" class="custom-control-input"><label  for="medical_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label ">Select Medical Status</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select  name="Category" v-model="list.medical"  class="form-control">
                                <option value="" selected>Select Medical Status</option>
                                <option value="1">Fit</option>
                                <option value="0">Update</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row" v-if="this.permission.musaned_update">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Musaned</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.musaned_status" type="checkbox" id="musaned_status"  checked="checked" class="custom-control-input"><label  for="musaned_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Musaned Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.musaned_date" type="date" class="form-control" id="musaned_date" placeholder="Date">
                    </div>
                </div>
                <div class="form-group row" v-if="permission.okala_update">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Okala</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.okala_status" type="checkbox" id="okala_status"  checked="checked" class="custom-control-input"><label  for="okala_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Okala Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.okala_date" type="date" class="form-control" id="okala_date" placeholder="Date">
                    </div>
                </div>
                <div class="form-group row" v-if="permission.mofa_update">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mofa</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.mofa_status" type="checkbox" id="mofa_status"  checked="checked" class="custom-control-input"><label  for="mofa_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Mofa Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.mofa_date" type="date" class="form-control" id="mofa_date" placeholder="Date">
                    </div>
                </div>
                <div class="form-group row" v-if="permission.stamping_update && list.okala_date!=null">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Stamping</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.stamping_status" type="checkbox" id="stamping_status"  checked="checked" class="custom-control-input"><label  for="stamping_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Stamping Date</label>
                    <div class="col-sm-4" >
                        <input v-model="list.stamping_date" type="date" class="form-control" id="stamping_date" placeholder="Date">
                    </div>
                </div>
                <div class="form-group row" v-if="permission.finger_update">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Finger</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.finger_training_status" type="checkbox" id="finger_training_status"  checked="checked" class="custom-control-input"><label  for="finger_training_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Finger Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.finger_training_date" type="date" class="form-control" id="finger_training_date" placeholder="Date">
                    </div>
                </div>
                <div class="form-group row" v-if="permission.training_update">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Training</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.training" type="checkbox" id="training_status"  checked="checked" class="custom-control-input"><label  for="training_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Training Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.training_date" type="date" class="form-control" id="finger_training_date" placeholder="Date">
                    </div>
                </div>
                <div class="form-group row" v-if="permission.manpower_update && (list.stamping_date!=null || list.stamping_date!='')">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Manpower</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.manpower_status" type="checkbox" id="manpower_status"  checked="checked" class="custom-control-input"><label  for="manpower_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Manpowe Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.manpowe_date" type="date" class="form-control" id="manpowe_date" placeholder="Date">
                    </div>
                </div>
                <div class="form-group row" v-if="permission.flight_update">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Flight</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.flight_status" type="checkbox" id="flight_status"  checked="checked" class="custom-control-input"><label  for="flight_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Flight Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.flight_date" type="date" class="form-control" id="flight_date" placeholder="Date">
                    </div>
                </div>
               
                <div class="form-group row" v-if="permission.account_update   && list.manpowe_date!=null">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Delivery Status</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.account_status" type="checkbox" id="account_status"  checked="checked" class="custom-control-input"><label  for="account_status" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Delivery Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.account_date" type="date" class="form-control" id="account_date" placeholder="Date">
                    </div>
                </div>
                 <div class="form-group row" v-if="permission.completed_update && list.account_date!=null" >
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Completed</label>
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox custom-control-inline"><input  v-model="list.completed" type="checkbox" id="completed"  checked="checked" class="custom-control-input"><label  for="completed" class="custom-control-label">Status</label>
                        </div>
                    </div>
                     <label for="inputPassword3" class="col-sm-2 col-form-label">Completed Date</label>
                    <div class="col-sm-4">
                        <input v-model="list.completed_date" type="date" class="form-control" id="account_date" placeholder="Date">
                    </div>
                </div>
                 <div class="form-group row" v-if="permission.recuiting_update">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Remarks</label>
                    <div class="col-sm-4">
                        <input v-model="list.remarks" type="text" class="form-control" id="remarks" placeholder="remarks">
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                <input type="submit" value="submit" v-if="!addLoader"  class="btn btn-primary pull-right">
                 <button v-if="addLoader" class="btn btn-primary pull-right" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Submitting...
                </button>
                <button @click.prevent="close" class="btn btn-success pull-right" style="margin-right:5px;">Close</button>
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE,ALL_CONTACT,ADD_INCOME} from "../../../store/action.type"
import { mapState,mapGetters } from "vuex"
import { VueEditor } from 'vue2-editor'
export default {
	props:['list','permission','companies'],
    data(){
        return{
            title:this.$route.name,
            largeModal:false,
            addLoader:false,
            serverErrors:{},
            nav_tab:1,
        }
    },
    watch:{
        
    },
    methods:{
        NabTabf(type){
            this.nav_tab = type;
        },
        close(){
            this.largeModal = false;
        },
        errorClear(fields)
        {
            delete this.serverErrors[fields];
        },
        openModal(){
            this.nav_tab=1;
            this.largeModal = true
        },
        addVisa(){
            this.addLoader=true;
            var type = this.$parent.list.entryType;
            this.$store.dispatch('ADD_VISA',this.list)
            .then(response=>{
                this.addLoader=false;
                this.largeModal = false;
                if(this.list.id==''){
                    this.$iziToast.success({position:'topRight',title:'Ok',message:"Create Successsfully"})
                }else{
                    this.$iziToast.success({position:'topRight',title:'Ok',message:"Updated Successsfully"})
                }
                if(type==1){
                    this.$parent.list={entryType:1};
                }
                this.$parent.list.entryType= type;
                this.$parent.active =false;
                this.serverErrors = {};
            }).catch(errors=>{
                this.addLoader=false;
                this.$iziToast.error({position:'topRight',title:'Error',message:"Validation Error !!"})
                this.serverErrors=errors.response.data.errors;
            });
        },
        necessaryThings(){
            this.$store.dispatch('ALL_PURPOSE')
            this.$store.dispatch('ALL_CONTACT')
            this.$store.dispatch('ALL_ACCOUNT_TYPE',1)
        },
        
    },
    mounted(){
        this.necessaryThings()
    },
    computed:{
        ...mapGetters(["accountTypes","purposes","allContacts"]),
        total(){
            return ((parseFloat(this.newIncome.amount)+parseFloat(this.newIncome.utility)+parseFloat(this.newIncome.car_parking)+parseFloat(this.newIncome.registration_cost)+parseFloat(this.newIncome.other_cost))-(parseFloat(this.newIncome.discount)+parseFloat(this.newIncome.gift)))
        },
        edit(){
            if(this.list.id!=null||this.list.id!=''){
                return true;
            }else{
                return false;
            }
        },
        routelist () {
        return this.$route.matched.filter((route) => route.name || route.meta.label )
        },
        
    },
    components:{
        VueEditor
    }
}
</script>

<style>
.custom_modal_body{
    overflow: auto;
    min-height: 380px; width:99%;
}
#preview {
    height: 120px;
    width: 70%;
}
#preview img{
    height: 100%;
    width: 100%;
}
</style>
