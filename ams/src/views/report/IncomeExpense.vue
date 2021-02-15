<template>
    <div class="card">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 contct">
                        <VueCtkDateTimePicker 
                            :id="demo.options.id"
                            v-model="demo.value"
                            :range="demo.options.range"
                            :format="demo.options.format"
                            :formatted="demo.options.formatted"
                            :color="demo.options.color"
                            :label="demo.options.label"
                        >
                            <input
                            v-if="demo.options && demo.options.slot && demo.options.slot.type === 'input'"
                            type="text"  
                            >
                            <button
                            v-else-if="demo.options && demo.options.slot && demo.options.slot.type === 'button'"
                            type="button"
                            class="lm-btn"
                            style="margin: 0;"
                            />
                        </VueCtkDateTimePicker>
                    </div>
                    <div class="col-md-3">
                        <select  @change="customerVisa(search.customer_id)" name="Customer" v-model="search.customer_id"  class="form-control" >
                            <option value="" >Select Client</option>
                            <option   :value="contact.id"  v-for="(contact,index) in allContacts" :key="index">{{contact.name}}</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <select name="CustomerVisa" v-model="search.visa_id"  class="form-control" >
                                <option value="" >Select Visa</option>
                                <option   :value="customervisa.id"  v-for="(customervisa,index) in customervisas" :key="index">{{customervisa.worker_number}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <form  class="form-inline contct my-2 my-lg-0 pull-left">
                            <select   v-model="search.account_id"  class="form-control" style="margin-right:10px" >
                                <option value="" >Select Purpose</option>
                                <option  :value="purpose.id"  v-for="(purpose,index) in purposes" :key="index">{{purpose.name}}</option>
                            </select>
                        </form>
                    </div>
                    <div class="col-md-2">
                         <button @click.prevent="serachLeadger" class="btn btn-outline-success my-2 my-sm-0" >Search</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div style="margin:10px;" class="pull-right">
                            <downloadExcel :data="dataForExcel">
                                <button class="btn btn-success">Excel <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                            </downloadExcel>
                        </div>
                        <div style="margin-top:10px" class="pull-right">
                            <button @click.prevent="makePdf" class="btn btn-success">Pdf <i class="fa fa-file-pdf-o" ></i></button>
                        </div>
                    </div>
                </div>

            
            <table id="my-table" class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Number</th>
                        <th scope="col">Client/Vendor</th>
                        <!-- <th scope="col">Jurnal Type</th> -->
                        <th scope="col">Account</th>
                        <th scope="col">Receive</th>
                        <th scope="col">Expense</th>
                    </tr>
                </thead>
                <tbody v-if="this.loading==false">
                    <tr v-for="(leadgerdata,index) in leadgerdatas" :key='index'>
                        <td>{{leadgerdata.date}}</td>
                        <td>{{leadgerdata.number}}</td>
                        <td>{{leadgerdata.contact}}</td>
                        <!-- <td>{{leadgerdata.jurnal_type}}</td> -->
                        <td>({{leadgerdata.account}})</td>
                        <td v-if="leadgerdata.jurnal_type=='payment_receive'">{{leadgerdata.amount}}</td>
                        <td v-if="leadgerdata.jurnal_type=='payment_receive'"></td>
                        <td v-if="leadgerdata.jurnal_type=='expense'"></td>
                        <td v-if="leadgerdata.jurnal_type=='expense'">{{leadgerdata.amount}}</td>
                        
                    </tr>
                    <tr >
                        <td colspan="4"></td>
                        <td>{{Math.abs(receive)}}</td>
                        <td>{{Math.abs(expense)}}</td>
                    </tr>
                     <tr >
                        <td colspan="4"></td>
                        <td>Cash In Hand</td>
                        <td>{{Math.abs(receive-expense)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import Vue from 'vue'

import Loader from '../common/Loader'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import jsPDF from 'jspdf'
import 'jspdf-autotable'
import downloadExcel from 'vue-json-excel'
import { mapState,mapGetters } from "vuex"
import { CURRENT_LEADGER ,SEARCH_LEADGER,ALL_CONTACT,ALL_PURPOSE,CUSTOMER_VISA} from '../../store/action.type';
export default {
    data(){
        return {
            now:new Date(),
           loading:false,
           dataForExcel: [],
         demo:{
            title: 'Range Date Picker',
            description: 'Date Range selector - With custom element to trigger the component (only input or button)',
            editOption: false,
                initial: {
                start: new Date(),
                end: new Date(),
                },
                value: {
                start:new Date(),
                end: new Date()
                },
                options: {
                slot: {
                    type: 'button'
                },
                range: true,
                formatted: 'll',
                format: 'YYYY-MM-DD',
                color: 'green',
                label: 'Select date range',
                id: 'RangeDatePicker'
                }
          },
          search:{
               customer_id:'',
               vandor_id:'',
               account_id:'',
               visa_id:''
           },
        }
    },
    methods:{
        nameWithLang ({ name, contact_number }) {
        return `${name} — [${contact_number}]`
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
        cuurentLeadger(){
            // this.loading=true;
            // this.$store.dispatch('CURRENT_LEADGER')
            // .then(response=>{
            //         this.loading=false;
            // })
            // .catch(error=>{
            //     this.loading=true;        
            // });
            this.$store.dispatch('ALL_CONTACT')
            this.$store.dispatch('ALL_PURPOSE')
        },
        serachLeadger(){
            var data = {
               customer_id:this.search.customer_id,
               vandor_id:this.search.vandor_id,
               account_id:this.search.account_id,
               start_date:this.demo.value.start,
               end_date:this.demo.value.end,
               visa_id:this.search.visa_id,
               type:1,
            }
            this.loading = true;
            this.$store.dispatch('SEARCH_LEADGER',data).then(response=>{
                this.loading=false;
            }).catch(error=>{
                this.loading=false;        
            });

        },
        
        makePdf(){
            const doc = new jsPDF();
            doc.autoTable({html: '#my-table'});
            doc.save('table.pdf'); 
        }
    },
    mounted(){
        this.serachLeadger();
        //this.getReport();
        this.cuurentLeadger();
    },
    computed: {
        ...mapGetters(["leadgerdatas","allContacts","purposes","customervisas"]),
        receive(){
            var total = 0;
            this.leadgerdatas.forEach(element => {
               

                if(element.jurnal_type == 'payment_receive'){
                    total = total+ parseFloat(element.amount)
                }
                
            })
            return total;
        },
        expense(){
            var total = 0;
            this.leadgerdatas.forEach(element => {
               

                if(element.jurnal_type == 'expense'){
                    total = total+ parseFloat(element.amount)
                }
                
            })
            return total;
        },
        invoice(){
            var total = 0;
            this.leadgerdatas.forEach(element => {
               

                if(element.jurnal_type == 'invoice'){
                    total = total+ parseFloat(element.amount)
                }
                
            })
            return total;
        },
        total2(){
            this.dataForExcel =[]
            var total = 0
            var that = this
            this.leadgerdatas.forEach(element => {
                var exldata = {
                    "Date" : element.date,
                    "Number" : element.number,
                    "Client/Vendor" : element.contact,
                    "Jurnal Type" : element.jurnal_type,
                    "Account" : element.account,
                    "Amount" : element.amount
                }
                that.dataForExcel.push(exldata)

                // if(element.type == 1){
                //     total = total+ parseFloat(element.total)
                // }
                // if(element.type == 2){
                //     total = total - parseFloat(element.total)
                // }
                
            })
             
            return total
            
        }
        
    },
    components: {
        VueCtkDateTimePicker,
        downloadExcel,
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
