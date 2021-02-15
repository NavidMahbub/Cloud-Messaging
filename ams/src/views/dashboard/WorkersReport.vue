<template>
    <b-modal title="Workers Reports"   no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form>
          <b-card no-body class="mb-1" v-for="(list,key) in this.contact" v-bind:key="key">
            <b-card-header header-tag="header" class="p-1" role="tab" @click="TabOpen(list.id)">
              <b-btn block href="#" v-b-toggle="'tab'+key" variant="info">{{list.name}} ({{list.total}})</b-btn>
            </b-card-header>
            <b-collapse :id="'tab'+key"  accordion="my-accordion" role="tabpanel">
              <b-card-body>
                <div class="container-fluid" style="overflow: auto;">
                    <table id="my-table" class="table table-striped table_fields">
                        <thead>
                            <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Workers Number</th>
                            <th scope="col">Passport Name</th>
                            <th scope="col">Passport Number</th>
                            <th scope="col">Visa Number</th>
                            <th scope="col">Occupation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(visa,index) in workers" :key="index">
                                <td>{{visa.created_at}}</td>
                                <td>{{visa.worker_number}}</td>
                                <td><a @click="viewModal(visa.id)" href="#"> {{visa.passport_name}}</a></td>
                                <td>{{visa.passport_number}}</td>
                                <td>{{visa.visa_number}}</td>
                                <td>{{visa.occupation}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
              </b-card-body>
            </b-collapse>
          </b-card>
        </form>
        <Details :list="list" :permission="permission" ref="details_modal"></Details>
        <Loader v-if="loading"></Loader>
    </b-modal>
</template>
<script>
import Loader from '../common/Loader';
import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import Details from '../recuiting/workersinfo/details'
Vue.use(VueAxios, axios);
export default {
    props:['ClientWorkers'],
    components: {
        Loader,
        Details
    },
    data(){
        return{
            largeModal:false,
            contact:'',
            loading:false,
            report:''.Loadert,
            type:'',
            workers:[],
            list:{},
        }
    },
    methods:{
        openModal(report,type){
            this.largeModal = true
            this.getdata(report,type)
        },
         viewModal(id){
            this.loader = true;
            axios.get("/api/visa/show/"+id)
            .then(response => {
                this.loader = false;
                this.list = response.data;
            })
            .catch(function(error) {
                this.loader = true;
            });
            
            this.$refs.details_modal.openModal();
        },
        TabOpen(id){
            this.loading = true;
            let data = {report:this.report,type:this.type,user_id:id};
            Vue.axios.post('api/statistics/contacts/workers',data).then((response) => {   
                this.loading=false;
                this.workers= response.data;
            }).catch(function (error) {                    
                    this.loading=true;
            });
        },
        getdata(report,type){
            this.loading = true;
            this.report = report;
            this.type = type;
            let data = {report:report,type:type};
            Vue.axios.post('api/statistics/contacts',data).then((response) => {   
                this.loading=false;
                this.contact= response.data;
            }).catch(function (error) {                    
                    this.loading=true;
            });
        }
    }

}
</script>

<style>

</style>
