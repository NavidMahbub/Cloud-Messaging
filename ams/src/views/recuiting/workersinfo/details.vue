
<template>
    <b-modal title="Workers Information Add Form" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <div class="container custom_modal_body">
            <table id="my-table" class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td>Client:</td>
                        <td>{{list.user}}</td>
                        <td>Passport Name</td>
                        <td>{{list.passport_name}}</td>
                        <td>Passport Number</td>
                        <td>{{list.passport_number}}</td>
                    </tr>
                    <tr>
                        <td>Visa Number:</td>
                        <td>{{list.visa_number}}</td>
                        <td class="hilights">Processing Rate</td>
                        <td>{{list.processing_rate}}</td>
                        <td>Company ID Number:</td>
                        <td>{{list.company_id_number}}</td>
                    </tr>
                    <tr class="hilights">
                        <td>Update</td>
                        <td>{{list.update}}</td>
                        <td>Other's</td>
                        <td>{{list.others}}</td>
                        <td>Total</td>
                        <td>{{parseInt(list.processing_rate)+parseInt(list.update)+parseInt(list.others)}}</td> 
                    </tr>
                    <tr>
                        <td>Occupation</td>
                        <td>{{list.occupation}}</td>
                        <td>Gender</td>
                        <td>{{list.gender}}</td>
                        <td>Worker Number</td>
                        <td>{{list.worker_number}}</td>
                    </tr>
                    <tr>
                        <td>Due</td>
                        <td>{{list.due_amount}}</td>
                        <td>Diving Licence</td>
                        <td>
                            <input  type="checkbox" id="diving_licence_status"  checked="checked" class="custom-control-input" disabled>
                        </td>
                        <td>Police Clearence</td>
                        <td>
                            <input disabled type="checkbox" id="police_clearence_status"  checked="checked" class="custom-control-input">
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Worker Number</td>
                        <td>{{list.worker_number}}</td>
                        <td>Medical</td>
                        <td>
                            <span v-if="list.diving_licence_status==0 || list.diving_licence_status==null" class="badge badge-warning">No</span>
                            <span  v-else class="badge badge-success">Yes</span>
                        </td>
                        <td>Police Clearence</td>
                        <td>
                            <span v-if="list.police_clearence_status==0 || list.police_clearence_status==null" class="badge badge-warning">No</span>
                            <span  v-else class="badge badge-success">Yes</span>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Medical</td>
                        <td>
                            <span  v-if="list.medical_status==0 || list.medical_status==null" class="badge badge-warning">No</span>
                            <span  v-else class="badge badge-success">
                                <p v-if="list.medical==1">Fit</p>
                                <p v-if="list.medical==0">Update</p>
                            </span>
                        </td>
                        <td>Musaned Date</td>
                        <td>
                           <span  v-if="list.musaned_status==0 || list.musaned_status==null" class="badge badge-warning">No</span>
                            <span v-else class="badge badge-success">
                                {{list.musaned_date}}
                               </span>
                        </td>
                        <td>Okala Date</td>
                        <td>
                            <span  v-if="list.okala_status==0 || list.okala_status==null" class="badge badge-warning">No</span>
                               <span  v-else class="badge badge-success">
                                {{list.okala_date}}
                               </span>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Mofa Date</td>
                        <td>
                            <span  v-if="list.mofa_status==0 || list.mofa_status==null" class="badge badge-warning">No</span>
                            <span  v-else class="badge badge-success">
                                {{list.mofa_date}}
                               </span>
                        </td>
                        <td>Stamping Date</td>
                        <td>
                           <span  v-if="list.stamping_status==0 || list.stamping_status==null" class="badge badge-warning">No</span>
                               <span  v-else class="badge badge-success">
                                {{list.stamping_date}}
                               </span>
                        </td>
                        <td>Finger Training Date</td>
                        <td>
                            <span  v-if="list.finger_training_status==0 || list.finger_training_status==null" class="badge badge-warning">No</span>
                            <span v-else class="badge badge-success">
                                {{list.finger_training_date}}
                               </span>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Manpowe Date</td>
                        <td>
                             <span  v-if="list.manpower_status==0 || list.manpower_status==null" class="badge badge-warning">No</span>
                            <span  v-else class="badge badge-success">
                                    {{list.manpowe_date}}
                               </span>
                        </td>
                        <td>Flight Date</td>
                        <td>
                           <span  v-if="list.flight_status==0 || list.flight_status==null" class="badge badge-warning">No</span>
                            <span  v-else class="badge badge-success">
                                    {{list.flight_date}}
                               </span>
                        </td>
                        <td>Delivery Date</td>
                        <td>
                           <span v-if="list.account_status==0 || list.account_status==null" class="badge badge-warning">No</span>
                            <span  v-else class="badge badge-success">
                                    {{list.account_date}}
                               </span> 
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div>
                All Invoice
            </div>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Persoanl Note</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(invoice,index) in list.invoices" :key="index">
                        <td>{{index}}</td>
                        <td>{{invoice.created_at}}</td>
                        <td>{{invoice.note}}</td>
                        <td>{{invoice.amount}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </b-modal>
</template>

<script>
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE,ALL_CONTACT,ADD_INCOME} from "../../../store/action.type"
import { mapState,mapGetters } from "vuex"
import { VueEditor } from 'vue2-editor'
export default {
    props:['list','permission'],
    data(){
        return{
            largeModal:false,
            addLoader:false,
        }
    },
    watch:{
        list(val){
            //alert(val);
            //this.list.entryType = val.entryType;
            //this.openModal();
        }
    },
    methods:{
        close(){
            this.largeModal = false;
        },
        errorClear(fields)
        {
            delete this.errors[fields];
        },
        openModal(){
            this.largeModal = true
        },
        addVisa(){
            this.addLoader=true;
            var type = this.$parent.list.entryType;
            this.$store.dispatch('ADD_VISA',this.list)
            .then(response=>{
                this.addLoader=false;
                this.largeModal = false;
                if(type==1){
                    this.$parent.list={entryType:1};
                    this.errors = [];
                }
                this.$parent.list.entryType= type;
                this.$parent.active =false;
            }).catch(errors=>{
                this.addLoader=false;
                this.errors=errors.response.data.errors;
            });
        },
        necessaryThings(){
            this.$store.dispatch('ALL_PURPOSE')
            this.$store.dispatch('ALL_CONTACT')
            this.$store.dispatch('ALL_ACCOUNT_TYPE',1)
        }
    },
    mounted(){
        this.necessaryThings()
    },
    computed:{
        ...mapGetters(["accountTypes","purposes","allContacts"]),
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
