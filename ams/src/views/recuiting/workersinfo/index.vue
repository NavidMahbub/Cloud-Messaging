<template>
    <div class="card">
        <div class="container-fluid">
            <div class="container-fluid">
            <div class="row">  
            <button v-if="permission.recuiting_create" type="button" @click="openModal(1)" class="btn btn-primary contct-b pull-left"><i class="icons icon-user-follow"></i>Add Workers info</button>
            <div style="margin:10px;" class="pull-right">
            <downloadExcel :data="dataForExcel">
                <button class="btn btn-success">Excel <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
            </downloadExcel>
            </div>
            </div>
            <div class="row">
                <div class="col-md-3">
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
                <div class="col-md-4">
                     <multiselect v-model="value" :options="allContacts" :custom-label="nameWithLang" placeholder="Select one" label="name" track-by="id"></multiselect>
                </div>
                <div class="col-md-3">
                     <input class="form-control mr-sm-2" v-model="search" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-success my-2 my-sm-0" @click="searchf">Search</button>
                </div>
            </div>
           
            </div>
            <div class="container-fluid" style="overflow: auto;">
                <table id="my-table" class="table table-striped table_fields table-fixed">
                    <thead>
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">SLN</th>
                        <th scope="col">PP Name</th>
                        <th scope="col">Client</th>
                        <th scope="col">PP Number</th>
                        <!-- <th scope="col">Visa Number</th> -->
                        <th scope="col">Occupation</th>
                        <!-- <th scope="col">ID Number</th> -->
                        <th scope="col">P Rate</th>
                        <th scope="col">Update</th>
                        <th scope="col">Other's</th>
                        <th scope="col">Total</th>
                        <!-- <th scope="col">Due</th> -->
                        <!-- <th scope="col">Occupation</th> -->
                        <!-- <th scope="col" v-if="sidebar==1 || sidebar==2">Diving Licence</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==3">Police Clearence</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==4">Medical</th>
                        <th scope="col"  v-if="sidebar==1 || sidebar==5">Musaned</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==6">Okala</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==7">Mofa</th>
                        <th scope="col"  v-if="sidebar==1 || sidebar==8">Stamping</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==9">Finger Training</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==10">Manpower</th>
                        <th scope="col"  v-if="sidebar==1 || sidebar==11">Flight</th>
                        <th scope="col"  v-if="sidebar==1 || sidebar==11">Delivery Status</th> -->
                        <th scope="col">Actions</th>
                        <th scope="col">Update By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(visa,index) in visas.data" :key="index" :class="visa.status?'':'off_active'">
                            <td>{{visa.created_at}}</td>
                            <td>{{visa.worker_number}}</td>
                            <td>{{visa.passport_name}}</td>
                            <td>{{visa.user}}</td>
                            <td>{{visa.passport_number}}</td>
                            <!-- <td>{{visa.visa_number}}</td> -->
                            <!-- <td>{{visa.company_id_number}}</td> -->
                            <td>{{visa.occupation}}</td>
                            <td>{{visa.processing_rate_i}}</td>
                            <td>
                                <span @click="addInvoiceModal(2,visa)">{{visa.update}}</span>
                            </td>
                            <td><span @click="addInvoiceModal(3,visa)">{{visa.others}}</span></td>
                            <td>{{parseInt(visa.processing_rate_i)+parseInt(visa.update)+parseInt(visa.others)}}</td>
                            <!-- <td>{{visa.due_amount}}</td> -->
                            <!-- <td>{{visa.occupation}}</td> -->
                           <!--  <td v-if="sidebar==1 || sidebar==2">
                                   <span @click="updateModal(2,index)" v-if="visa.diving_licence_status==0 || visa.diving_licence_status==null" class="badge badge-warning">No</span>
                                   <span @click="updateModal(2,index)" v-else class="badge badge-success">Yes</span>
                            </td>
                            <td v-if="sidebar==1 || sidebar==3">
                                <span @click="updateModal(2,index)" v-if="visa.police_clearence_status==0 || visa.police_clearence_status==null" class="badge badge-warning">No</span>
                               <span  @click="updateModal(2,index)" v-else class="badge badge-success">Yes</span>
                            <td  v-if="sidebar==1 || sidebar==4">
                                <span @click="updateModal(3,index)" v-if="visa.medical_status==0 || visa.medical_status==null" class="badge badge-warning">No</span>
                               <span @click="updateModal(3,index)" v-else class="badge badge-success">
                                <p v-if="visa.medical==1">Fit</p>
                                <p v-if="visa.medical==0">Update</p>
                               </span>
                            </td>
                            <td v-if="sidebar==1 || sidebar==5">
                                <span @click="updateModal(4,index)" v-if="visa.musaned_status==0 || visa.musaned_status==null" class="badge badge-warning">No</span>
                               <span @click="updateModal(4,index)" v-else class="badge badge-success">
                                {{visa.musaned_date}}
                               </span>
                               
                            </td>
                            <td v-if="sidebar==1 || sidebar==6">
                                <span @click="updateModal(5,index)" v-if="visa.okala_status==0 || visa.okala_status==null" class="badge badge-warning">No</span>
                               <span @click="updateModal(5,index)" v-else class="badge badge-success">
                                {{visa.okala_date}}
                               </span>
                            </td>
                            <td v-if="sidebar==1 || sidebar==7">
                                <span @click="updateModal(6,index)" v-if="visa.mofa_status==0 || visa.mofa_status==null" class="badge badge-warning">No</span>
                               <span @click="updateModal(6,index)" v-else class="badge badge-success">
                                {{visa.mofa_date}}
                               </span>
                            </td>
                            <td v-if="sidebar==1 || sidebar==8">
                                <span @click="updateModal(7,index)" v-if="visa.stamping_status==0 || visa.stamping_status==null" class="badge badge-warning">No</span>
                               <span @click="updateModal(7,index)" v-else class="badge badge-success">
                                {{visa.stamping_date}}
                               </span>
                            </td>
                            <td v-if="sidebar==1 || sidebar==9">
                                <span @click="updateModal(8,index)" v-if="visa.finger_training_status==0 || visa.finger_training_status==null" class="badge badge-warning">No</span>
                               <span @click="updateModal(8,index)" v-else class="badge badge-success">
                                {{visa.finger_training_date}}
                               </span>
                            </td>
                            <td  v-if="sidebar==1 || sidebar==10">
                                <span @click="updateModal(9,index)" v-if="visa.manpower_status==0 || visa.manpower_status==null" class="badge badge-warning">No</span>
                                <span @click="updateModal(9,index)" v-else class="badge badge-success">
                                    {{visa.manpowe_date}}
                               </span>
                            </td>
                            <td  v-if="sidebar==1 || sidebar==11">
                                <span @click="updateModal(10,index)" v-if="visa.flight_status==0 || visa.flight_status==null" class="badge badge-warning">No</span>
                                   <span @click="updateModal(10,index)" v-else class="badge badge-success">
                                    {{visa.flight_date}}
                               </span>
                            </td>
                            <td  v-if="sidebar==1 || sidebar==11">
                                <span @click="updateModal(11,index)" v-if="visa.account_status==0 || visa.account_status==null" class="badge badge-warning">No</span>
                                   <span @click="updateModal(11,index)" v-else class="badge badge-success">
                                    {{visa.account_date}}
                               </span>
                            </td> -->
                            <td>
                                <i v-if="permission.recuiting_view || permission.recuiting_viewall" class="icon-eye icons   actn" @click="viewModal(1,index)"> </i>
                                <i  v-if="permission.recuiting_update || permission.recuiting_updateall" class="icon-note icons actn" @click="updateModal(1,index)"> </i>
                                <!-- <i  class="icon-eye icons   actn"> </i> -->
                                <i v-if="permission.recuiting_delete || permission.recuiting_deleteall" class="icon-trash icons   actn" @click="del(index,visa.id)"> </i>
                                <div class="btn-group lang-btn" role="group" v-if="permission.recuiting_update || permission.recuiting_updateall">
                                <div v-if="status_update && tab_index==index" >
                                    <a  tabindex="0" href="#" class="btn"><i class="fa fa-cog fa-spin"></i></a>
                                </div>
                                <div v-else >
                                    <a  tabindex="0" href="#" class="btn visa_on" v-if="visa.status"   @click="statusUpdate(index)">On</a>
                                    <a  tabindex="0" href="#" class="btn visa_off" v-else   @click="statusUpdate(index)">Off</a>
                                </div>
                                </div>
                            </td>
                            <td>{{visa.updated_by}}</td>
                        </tr>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <!-- <ul class="pagination pagination-sm">
                        <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                        </li>
                    </ul> -->
                    <div v-if="this.loader"></div>
                    <div v-else>
                        <pagination v-if="visas" :data="visas" :limit="8" @pagination-change-page="getResults"></pagination>
                    </div>
                </nav>
            </div>
            <!-- <Loader v-if="contactLoader"></Loader> -->
        </div>
        <Create :list="list" :permission="permission" :companies="companies" ref="create_modal"></Create>
        <Details :list="list" :permission="permission" ref="details_modal"></Details>
        <Loader v-if="loader"></Loader>
        <AddInvoice :newInvoice="newInvoice" ref="add_invoice_modal"></AddInvoice>
    </div>
</template>
<script>
import { Switch as cSwitch } from '@coreui/vue'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import Vue from "vue";
import axios from "axios"

Vue.component('pagination', require('laravel-vue-pagination'));
import Create from './create'
import Details from './details'
import AddInvoice from './addInvoice'
import Loader from '../../common/Loader'
import { mapState,mapGetters } from "vuex"
import jsPDF from 'jspdf'
import 'jspdf-autotable'
import downloadExcel from 'vue-json-excel'
import { ALL_VISA,DELETE_VISA,GETLASTID,ALL_USER_ROLE2,ADD_VISA } from '@/store/action.type';

export default {
    name:'Visa',
    components: {
        Details,
        Create,
        Loader,
        downloadExcel,
        AddInvoice,
        cSwitch,
        VueCtkDateTimePicker,
    },
    data(){
        return {
            value: {id:'',name:'Select Client',contact_number:''},
            demo:{
            title: 'Range Date Picker',
            description: 'Date Range selector - With custom element to trigger the component (only input or button)',
            editOption: false,
                initial: {
                start: '2018-04-05',
                end: '2018-04-20'
                },
                value: {
                start: '2018-04-05',
                end: '2018-04-20'
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
            tab_index:'',
            status_update:false,
            permission:'',
            dataForExcel:[],
            lists:[],
            list:{
                entryType:1,
                id:'',
                type:this.type,
                worker_number:'AMIR-R',
                passport_name:'',
                passport_number:'',
                processing_rate:'',
                visa_number:'',
                company_rate:'',
                company_id_number:'',
                occupation:'',
                gender:'',
                worker_number:'',
                diving_licence_status:'',
                police_clearence_status:false,
                medical_status:false,
                medical:'',
                musaned_status:false,
                musaned_date:false,
                okala_status:false,
                okala_date:'',
                mofa_status:false,
                mofa_date:false,
                stamping_status:false,
                stamping_date:'',
                training:false,
                training_date:'',
                finger_training_status:false,
                finger_training_date:'',
                manpower_status:false,
                manpowe_date:'',
                flight_status:false,
                flight_date:'',
                account_status:false,
                account_date:'',
                completed:false,
                completed_date:'',
                company_id:'',
                remarks:''

            },
            dataloading:false,
            data:{},
            sidebar:1,
            activeData:1,
            search:'',
            loader:false,
            type:'',
            companies:{},
            newInvoice:{
                date:'',
                account_id:'',
                agent_id:'',
                customer_id:'',
                visa_id:'',
                invoice_number:'',
                due_date:'',
                customer_id:'',
                commission_type:'',
                commission_amount:'',
                shipping_charge:'',
                adjustment:0,
                total:'',
                personal_note:'',
                customer_note:'',
                invoice_items:[{
                    project_id:'',
                    quantity:1,
                    rate:0,
                    discount:0,
                    tax:0,
                    amount:0,
                    purpose_id:''
                }],
            },
        }
    },
    computed: {
        ...mapGetters(["visas","allContacts","lastid","user"]),
    },
    mounted(){
        if(this.$route.name=='Rubel Recruiting Workers Infos'){
            this.type=2;
        }else if(this.$route.name=='Rubel Processing Workers Infos'){
            this.type=1;
        }else if(this.$route.name=='Amir Processing Workers Infos'){
            this.type=3;
        }else if(this.$route.name=='Amir Recruiting Workers Infos'){
            this.type=4;
        }else if(this.$route.name=='Female Recruiting Workers Infos'){
            this.type=5;
        }else if(this.$route.name=='Nahar Recruiting Workers Infos'){
            this.type=6;
        }else if(this.$route.name=='Nahar Processing Workers Infos'){
            this.type=7;
        }
        this.getPermission();
        this.getResults(); 
        this.getCompanies();
        
    },
    watch:{
        '$route'(to,from){
            if(this.$route.name=='Rubel Recruiting Workers Infos'){
                this.type=2;
            }else if(this.$route.name=='Rubel Processing Workers Infos'){
                this.type=1;
            }else if(this.$route.name=='Amir Processing Workers Infos'){
                this.type=3;
            }else if(this.$route.name=='Amir Recruiting Workers Infos'){
                this.type=4;
            }else if(this.$route.name=='Female Recruiting Workers Infos'){
                this.type=5;
            }else if(this.$route.name=='Nahar Recruiting Workers Infos'){
                this.type=6;
            }else if(this.$route.name=='Nahar Processing Workers Infos'){
                this.type=7;
            }
            this.getResults();
        }
    },
    methods:{
        getCompanies(){
            return new Promise((resolve, reject) => {
                var type = 4;
                axios.get("api/specific/contacts/"+type)
                .then(response => {
                    this.companies = response.data
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                });
            });
        },
        nameWithLang ({ name, contact_number }) {
        return `${name} — [${contact_number}]`
        },
        statusUpdate(index){
            this.tab_index = index;
            this.list = this.visas.data[index];
            this.list.entryType = 1;
            if(this.visas.data[index].status){
                this.list.status = 0;
            }else{
                 this.list.status = 1;
            }
            this.status_update=true;
            this.$store.dispatch('ADD_VISA',this.list)
            .then(response=>{
                this.status_update=false;
                this.$iziToast.success({position:'topRight',title:'Ok',message:"Status Update Successfull"})

            }).catch(errors=>{
                this.status_update=false;
                this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       

            });
        },
        getPermission(){
            this.$store.dispatch('ALL_USER_ROLE2')
            .then(response=>{
                this.permission = response.data.permission
            })
        },
        addInvoiceModal(account_id,visa){
            if(this.permission.invoice_create){
                this.newInvoice.account_id=account_id;
                this.newInvoice.customer_id=visa.user_id;
                this.newInvoice.visa_id=visa.id;
                this.newInvoice.agent_id=visa.agent_id;
                this.newInvoice.date='';
                this.newInvoice.due_date='';
                this.newInvoice.total='';
                this.newInvoice.personal_note='';
                this.newInvoice.customer_note='';
                this.$refs.add_invoice_modal.openModal()
            }
            
        },
        makePdf(){
            const doc = new jsPDF();
            doc.autoTable({html: '#my-table'});
            doc.save('table.pdf'); 
        },
        sidebarActive(type){
            this.sidebar =  type;
            this.activeData = 1;
            if(type==1){
               this.data = {}; 
            }else if(type==2){
                this.data = {};
                this.data.diving_licence_status=1;
            }else if(type==3){
                this.data = {};
                this.data.police_clearence_status=1;
            }else if(type==4){
                this.data = {};
                this.data.medical_status=1;
            }else if(type==5){
                this.data = {};
                this.data.musaned_status=1;
            }else if(type==6){
                this.data = {};
                this.data.okala_status=1;
            }else if(type==7){
                this.data = {};
                this.data.mofa_status=1;
            }else if(type==8){
                this.data = {};
                this.data.stamping_status=1;
            }else if(type==9){
                this.data = {};
                this.data.finger_training_status=1;
            }else if(type==10){
                this.data = {};
                this.data.manpower_status=1;
            }else if(type==11){
                this.data = {};
                this.data.flight_status=1;
            }else if(type==12){
                this.data = {};
                this.data.account_status=1;
            }
            this.getResults();
        },
        activeDataF(type){
            this.activeData =  type;
            if(this.sidebar==1){
               this.data = {}; 
            }else if(this.sidebar==2){
                this.data = {};
                this.data.diving_licence_status=type;
            }else if(this.sidebar==3){
                this.data = {};
                this.data.police_clearence_status=type;
            }else if(this.sidebar==4){
                this.data = {};
                this.data.medical_status=type;
            }else if(this.sidebar==5){
                this.data = {};
                this.data.musaned_status=type;
            }else if(this.sidebar==6){
                this.data = {};
                this.data.okala_status=type;
            }else if(this.sidebar==7){
                this.data = {};
                this.data.mofa_status=type;
            }else if(this.sidebar==8){
                this.data = {};
                this.data.stamping_status=type;
            }else if(this.sidebar==9){
                this.data = {};
                this.data.finger_training_status=type;
            }else if(this.sidebar==10){
                this.data = {};
                this.data.manpower_status=type;
            }else if(this.sidebar==11){
                this.data = {};
                this.data.flight_status=type;
            }else if(this.sidebar==12){
                this.data = {};
                this.data.account_status=type;
            }
            this.getResults();
        },
        
        dateSearch(){
        },
        openModal(type){
        this.$refs.create_modal.openModal();
            if(this.type==1){
                    this.list.entryType=type;
                    this.list.id='';
                    this.list.type=this.type;
                    this.list.worker_number='RBL-P';
            }else if(this.type==2){
                this.list.entryType=type;
                this.list.id='';
                this.list.type=this.type;
                this.list.worker_number='RBL-R';
            }else if(this.type==3){
                this.list.entryType=type;
                this.list.id='';
                this.list.type=this.type;
                this.list.worker_number='AMIR-P';
            }else if(this.type==4){
                this.list.entryType=type;
                this.list.id='';
                this.list.type=this.type;
                this.list.worker_number='AMIR-R';
            }else if(this.type==5){
                this.list.entryType=type;
                this.list.id='';
                this.list.type=this.type;
                this.list.worker_number='FEM-R';
            }else if(this.type==5){
                this.list.entryType=type;
                this.list.id='';
                this.list.type=this.type;
                this.list.worker_number='FEM-R';
            }else if(this.type==6){
                this.list.entryType=type;
                this.list.id='';
                this.list.type=this.type;
                this.list.worker_number='NAHAR-R';
            }else if(this.type==7){
                this.list.entryType=type;
                this.list.id='';
                this.list.type=this.type;
                this.list.worker_number='NAHAR-P';
            }
        },
        
        viewModal(type,index){
            this.loader = true;
            axios.get("/api/visa/show/"+this.visas.data[index].id)
            .then(response => {
                this.loader = false;
                this.list = response.data;
            })
            .catch(function(error) {
                this.loader = true;
            });
            
            this.list.entryType = type;
            this.$refs.details_modal.openModal();
        },
        updateModal(type,index){
            this.loader = true;
            axios.get("/api/visa/show/"+this.visas.data[index].id)
            .then(response => {
                this.loader = false;
                this.list = response.data;
            })
            .catch(function(error) {
                this.loader = true;
            });
            this.list.entryType = type;
            this.$refs.create_modal.openModal();
        },
        searchf(){
            
            this.data.customer_id =this.value.id;
            this.data.start_date = this.demo.value.start;
            this.data.end_date = this.demo.value.end;
            this.data.search=this.search;
            this.getResults();
        },
        getResults(page = 1){
            this.loader = true;
            this.data.type = this.type;
            var data = this.data;
            this.$store.dispatch('ALL_VISA',{data,page})
            .then(response=>{
                this.dataForExcel =[]
                var that = this
                var visadata = response.data.data;
                visadata.forEach(element => {
                    var exldata = {
                        "Worker Number" : element.worker_number,
                        "Passport Name" : element.passport_name,
                        //"Processing Rate" : element.processing_rate,
                        //"Update" : element.update,
                        //"Other's" : element.others,
                        //"Total" : parseInt(element.processing_rate)+parseInt(element.update)+parseInt(element.others),
                        //"Due" : element.due_amount,
                        "Passport Number" : element.passport_number,
                        "Visa Number" : element.visa_number,
                        //"Gender" : element.gender,
                        "Company ID Number" : element.company_id_number,
                        //"Occupation" : element.occupation,
                        //"Diving Licence" : element.diving_licence_status ==0||element.diving_licence_status ==null?"No":"Yes",
                        //"Police Clearence" : element.police_clearence_status ==0||element.police_clearence_status ==null?"No":"Yes",
                        //"Medical" : element.medical==0?"Update":""+element.medical==1?"Fit":"",
                        //"Musaned" : element.musaned_date,
                        //"Okala" : element.okala_date,
                        //"Mofa" : element.mofa_date,
                        //"Stamping" : element.stamping_date,
                        //"Finger Training" : element.finger_training_date,
                        //"Manpower" : element.manpowe_date,
                        //"Flight" : element.flight_date,
                        //"Delivery Date" : element.account_date,
                        "Client" : element.user,
                    }
                    that.dataForExcel.push(exldata)
                })
                this.loader=false;
            })
            .catch(error=>{
                this.loader=true;        
            });

        },
        del(index,id){

            var self = this
            this.$iziToast.question({
                timeout: 10000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                message: 'Are you sure To Delete?',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        self.$store.dispatch(DELETE_VISA,{index,id})
                        .then(response=>{
                            this.dataloading=false;
                        })
                        .catch(error=>{
                            this.dataloading=true;        
                        }); 
                        
            
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
            
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }],
                ]
            });
        }
        
    },
}
</script>

<style scoped>
.off_active{
    background: #faafaf !important;
    color: #fff;
}
.lang-btn.btn-group {border: 1px solid #fff;border-radius: 2px; margin-left: 1px;}
.lang-btn .btn {
  font-size: 12px;
  border-radius: 0;
  padding: 1px 8px;
  text-align: center;
  -webkit-box-shadow: none;
  box-shadow: none;
  background-color: #ccc;
  color: #000;
  line-height: 16px;
  transition: all 0.4s;
}
.lang-btn .visa_on {background-color: rgb(0, 205, 85);color: #fff;}
.lang-btn .visa_off {background-color: #CD0000;color: #fff;}

.table_fields td {
    text-align: center;
    border-bottom: 1px solid #dce1e9;
    border-right: 1px solid #dce1e9;
    font-size: 13px;
    line-height: 16px;
    color: #666;
    white-space:nowrap;
}
.table_fields th {
    text-align: center;
    border-bottom: 1px solid #dce1e9;
    border-right: 1px solid #dce1e9;
    font-size: 13px;
    line-height: 16px;
    color: #666;
    white-space:nowrap;
}
.table_main_div{
    overlay:auto;
}
.activesidebar{
    background: #20a8d8;
    margin: 3px;
    border-radius: 5px;
    color:#fff;
}
.activesidebar a {
    color:#fff;
}

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
 td span{
    cursor:pointer;
 }
</style>
