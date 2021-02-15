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
                        <th scope="col">Client</th>
                        <th scope="col">Worker</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Receive</th>
                        <th scope="col">Bill</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Due</th>
                    </tr>
                </thead>
                <tbody v-if="this.loading==false">
                    <tr v-for="(item,index) in workersreports" :key='index'>
                        <td>
                             <router-link  :to="{ name : 'ContactDetails', params: {id : item.user_id}}" style="padding:5px">
                                 {{item.customer_name}}
                            </router-link>
                        </td>
                        <td>{{item.total_worker}}</td>
                        <td>{{item.total_invoice}}</td>
                        <td>{{item.total_bill}}</td>
                        <td>{{item.total_receive}}</td>
                        <td>{{item.total_payment_made}}</td>
                        <td>{{Math.abs(item.account_status)}}</td>
                    </tr>
                    <tr >
                        <td colspan="1"></td>
                        <td>{{Math.abs(total)}}</td>
                        <td>{{Math.abs(invoice)}}</td>
                        <td>{{Math.abs(receive)}}</td>
                        <td>{{Math.abs(bill)}}</td>
                        <td>{{Math.abs(payment)}}</td>
                        <td>{{Math.abs(account_status)}}</td>
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
import { CURRENT_LEADGER ,SEARCH_WORKERS,ALL_CONTACT,ALL_PURPOSE,CUSTOMER_VISA} from '../../store/action.type';
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
               visa_id:this.search.visa_id
            }
            this.loading = true;
            console.log(data);
            this.$store.dispatch('SEARCH_WORKERS',data).then(response=>{
                this.loading=false;
            }).catch(error=>{
                this.loading=false;        
            });

        },
        getReports(){
            var data = {
               customer_id:this.search.customer_id,
               vandor_id:this.search.vandor_id,
               account_id:this.search.account_id,
               start_date:'',
               end_date:'',
               visa_id:this.search.visa_id,
               type:1,
            }
            this.loading = true;
            console.log(data);
            this.$store.dispatch('SEARCH_WORKERS',data).then(response=>{
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
        this.getReports();
        this.cuurentLeadger();
    },
    computed: {
        ...mapGetters(["leadgerdatas","allContacts","purposes","customervisas","workersreports"]),
        receive(){
            var total = 0;
            this.workersreports.forEach(element => {
               
                    total = total+ parseFloat(element.total_receive)
                
            })
            return total;
        },
        invoice(){
            var total = 0;
            this.workersreports.forEach(element => {
                    total = total+ parseFloat(element.total_invoice)
            })
            return total;
        },
        bill(){
            var total = 0;
            this.workersreports.forEach(element => {
                    total = total+ parseFloat(element.total_bill)
            })
            return total;
        },
        payment(){
            var total = 0;
            this.workersreports.forEach(element => {
                    total = total+ parseFloat(element.total_payment_made)
            })
            return total;
        },
        account_status(){
            var total = 0;
            this.workersreports.forEach(element => {
                    total = total+ parseFloat(element.account_status)
            })
            return total;
        },
        total(){

            this.dataForExcel =[]
            var total = 0
            var that = this
            this.workersreports.forEach(element => {
                var exldata = {
                    "Client" : element.customer_name,
                    "Total Worker" : element.total_worker,
                    "Invoice" : element.invoice,
                    "Receive" : element.receive,
                    "Due" : Math.abs(element.invoice-element.receive),
                }
                that.dataForExcel.push(exldata)

                
                total = total+parseFloat(element.total_worker)
                
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
