<template>
    <div class="card" style="height: 400px;">
        <div class="container-fluid">
            <div class="container-fluid">
           
            <form class="form-inline contct my-2 my-lg-0 pull-right" v-on:submit.prevent="onSubmit">
                <input class="form-control mr-sm-2" v-model="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" @click="searchf">Search</button>
            </form>
            </div>
            <div class="container-fluid col-md-12 row" v-if="visas.data.length>0">
                <table id="my-table" class="table table-striped table_fields">
                    <thead>
                        <tr>
                        <th scope="col">Workers Number</th>
                        <th scope="col">Passport Name</th>
                        <th scope="col">Passport Number</th>
                        <th scope="col">Visa Number</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Company ID Number</th>
                        <th scope="col">Occupation</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==2">Diving Licence</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==3">Police Clearence</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==4">Medical</th>
                        <th scope="col"  v-if="sidebar==1 || sidebar==5">Musaned</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==6">Okala</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==7">Mofa</th>
                        <th scope="col"  v-if="sidebar==1 || sidebar==8">Stamping</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==9">Finger Training</th>
                        <th scope="col" v-if="sidebar==1 || sidebar==10">Manpower</th>
                        <th scope="col"  v-if="sidebar==1 || sidebar==11">Flight</th>
                        <th scope="col"  v-if="sidebar==1 || sidebar==11">Delivery</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(visa,index) in visas.data" :key="index" >
                            <td>{{visa.worker_number}}</td>
                            <td>{{visa.passport_name}}</td>
                            <td>{{visa.passport_number}}</td>
                            <td>{{visa.visa_number}}</td>
                            <td>{{visa.gender}}</td>
                            <td>{{visa.company_id_number}}</td>
                            <td>{{visa.occupation}}</td>
                            <td>
                                   <span  v-if="visa.diving_licence_status==0 || visa.diving_licence_status==null" class="badge badge-warning">No</span>
                                   <span v-else class="badge badge-success">Yes</span>
                            </td>
                            <td>
                                <span v-if="visa.police_clearence_status==0 || visa.police_clearence_status==null" class="badge badge-warning">No</span>
                               <span  v-else class="badge badge-success">Yes</span>
                            <td >
                                <span  v-if="visa.medical_status==0 || visa.medical_status==null" class="badge badge-warning">No</span>
                               <span v-else class="badge badge-success">
                                   <p v-if="visa.medical==1">Fit</p>
                                    <p v-if="visa.medical==0">Update</p>
                               </span>
                            </td>
                            <td>
                                <span v-if="visa.musaned_status==0 || visa.musaned_status==null" class="badge badge-warning">No</span>
                               <span v-else class="badge badge-success">
                                {{visa.musaned_date}}
                               </span>
                               
                            </td>
                            <td>
                                <span  v-if="visa.okala_status==0 || visa.okala_status==null" class="badge badge-warning">No</span>
                               <span  v-else class="badge badge-success">
                                {{visa.okala_date}}
                               </span>
                            </td>
                            <td>
                                <span v-if="visa.mofa_status==0 || visa.mofa_status==null" class="badge badge-warning">No</span>
                               <span  v-else class="badge badge-success">
                                {{visa.mofa_date}}
                               </span>
                            </td>
                            <td>
                                <span v-if="visa.stamping_status==0 || visa.stamping_status==null" class="badge badge-warning">No</span>
                               <span  v-else class="badge badge-success">
                                {{visa.stamping_date}}
                               </span>
                            </td>
                            <td>
                                <span v-if="visa.finger_training_status==0 || visa.finger_training_status==null" class="badge badge-warning">No</span>
                               <span  v-else class="badge badge-success">
                                {{visa.finger_training_date}}
                               </span>
                            </td>
                            <td >
                                <span  v-if="visa.manpower_status==0 || visa.manpower_status==null" class="badge badge-warning">No</span>
                                <span v-else class="badge badge-success">
                                    {{visa.manpower_date}}
                               </span>
                            </td>
                            <td >
                                <span  v-if="visa.flight_status==0 || visa.flight_status==null" class="badge badge-warning">No</span>
                                   <span v-else class="badge badge-success">
                                    {{visa.flight_date}}
                               </span>
                            </td>
                            <td>
                                <span  v-if="visa.account_status==0 || visa.account_status==null" class="badge badge-warning">No</span>
                                <span v-else class="badge badge-success">
                                    {{visa.account_date}}
                               </span>
                            </td>
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
                    <pagination :data="visas" @pagination-change-page="getResults"></pagination>
                </nav>
            </div>
            <!-- <Loader v-if="contactLoader"></Loader> -->
        </div>
        <Create :list="list" ref="create_modal"></Create>
        <Loader v-if="loader"></Loader>
    </div>
</template>
<script>
import Vue from "vue";
Vue.component('pagination', require('laravel-vue-pagination'));
import Create from './create'
import Loader from '../../common/Loader'
import { mapState,mapGetters } from "vuex"
import { ALL_VISA,DELETE_VISA,GETLASTID } from '@/store/action.type';

export default {
    name:'Visa',
    components: {
        Create,
        Loader,
    },
    data(){
        return {
            lists:[],
            list:{
                entryType:1,
            },
            dataloading:false,
            data:{},
            sidebar:1,
            activeData:1,
            search:'',
            loader:false,
            type:'',
        }
    },
    computed: {
        ...mapGetters(["visas","allContacts","lastid"]),
    },
    mounted(){
        if(this.$route.name=='Recruiting Workers Infos'){
            this.type=2;
        }else{
            this.type=1;
        }
       this.getResults(); 
    },
    watch:{
        '$route'(to,from){
            if(this.$route.name=='Recruiting Workers Infos'){
                this.type=2;
            }else{
                this.type=1;
            }
            this.getResults();
        }
    },
    methods:{
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
        searchf(){
            this.data = {};
            this.data.search=this.search;
            this.getResults();
        },
        openModal(type){
            this.$store.dispatch('GETLASTID')
            .then(response=>{
                this.$refs.create_modal.openModal();
                this.list={
                    entryType:type,
                    id:'',
                    type:this.type,
                    worker_number:'RG-'+this.lastid.id,
                };
            })
            .catch(error=>{
                this.loader=true;        
            });
            
        },
        updateModal(type,index){
            this.list = this.visas.data[index];
            this.list.entryType = type;
            this.$refs.create_modal.openModal();
        },
        getResults(page = 1){
            this.loader = true;
            this.data.type = this.type;
            var data = this.data;
            this.$store.dispatch('ALL_VISA',{data,page})
            .then(response=>{
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
