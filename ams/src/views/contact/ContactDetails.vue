<template>
	<div class="card">
    <div class="form-group row" style="margin: 9px;">
        <div class="col-sm-12 custome_image">
            <img :src="contactDetails.image">
        </div>
        <table id="my-table" class="table table-striped table-bordered">
            <tbody>
                <tr >
                    <td>Name:</td>
                    <td>{{contactDetails.name}}</td>
                    <td>Mobile Number</td>
                    <td>{{contactDetails.mobile_number}}</td>
                    <td>Email</td>
                    <td>{{contactDetails.email}}</td>
                </tr>
                  <tr >
                    <td>Father Name:</td>
                    <td>{{contactDetails.father_name}}</td>
                    <td>Mother Name</td>
                    <td>{{contactDetails.mother_name}}</td>
                    <td>Spouse Name</td>
                    <td>{{contactDetails.spouse_name}}</td>
                </tr>
                <tr >
                    <td>District:</td>
                    <td>{{contactDetails.district_name}}</td>
                    <td>Subdistric</td>
                    <td>{{contactDetails.subdistrict_name}}</td>
                    <td>Area/Village</td>
                    <td>{{contactDetails.area_village}}</td>
                </tr>
                <tr >
                    <td>Ward/Union:</td>
                    <td>{{contactDetails.ward_union}}</td>
                    <td>Street/Para</td>
                    <td>{{contactDetails.street_para}}</td>
                    <td>Post Office</td>
                    <td>{{contactDetails.post_ofiice}}</td>
                </tr>
                <tr >
                    <td>Occupation:</td>
                    <td>{{contactDetails.occupation}}</td>
                    <td>Company</td>
                    <td>{{contactDetails.company}}</td>
                    <td>Designation</td>
                    <td>{{contactDetails.designation}}</td>
                </tr>
                <tr >
                    <td>Nid:</td>
                    <td>{{contactDetails.nid}}</td>
                    <td>Birthday</td>
                    <td>{{contactDetails.birthday}}</td>
                    <td>Contact Number</td>
                    <td>{{contactDetails.contact_number}}</td>
                </tr>

            </tbody>
        </table>
    </div>
    <b-card header="Workers Reports">
        <button v-on:click="print('workers_report_print')" class="button">Print</button>
        <div id="workers_report_print">
          <table id="my-table" class="table table-sm">
              <thead>
                  <tr>
                      <th scope="col">Title</th>
                      <th scope="col">Waiting</th>
                      <th scope="col">Okala</th>
                      <th scope="col">Visa</th>
                      <th scope="col">Manpower</th>
                      <th scope="col">Deliverd</th>
                      <th scope="col">Completed</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>RUBLE PROCESSING</td>
                      <td><span class="worker_report_table_td" @click="viewReport(1)">{{contactDetails.rbl_p_okalawaiting}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(2)">{{contactDetails.rbl_p_okala}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(3)">{{contactDetails.rbl_p_visa}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(4)">{{contactDetails.rbl_p_manpower}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(5)">{{contactDetails.rbl_p_delivery}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(6)">{{contactDetails.rbl_p_completed}}</span></td>
                  </tr>
                  <tr>
                      <td>RUBLE RECUITING</td>
                      <td><span class="worker_report_table_td" @click="viewReport(7)">{{contactDetails.rbl_r_okalawaiting}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(8)">{{contactDetails.rbl_r_okala}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(9)">{{contactDetails.rbl_r_visa}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(10)">{{contactDetails.rbl_r_manpower}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(11)">{{contactDetails.rbl_r_delivery}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(12)">{{contactDetails.rbl_r_completed}}</span></td>
                  </tr>
                    <tr>
                      <td>AMIR PROCESSING</td>
                      <td><span class="worker_report_table_td" @click="viewReport(13)">{{contactDetails.amir_p_okalawaiting}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(14)">{{contactDetails.amir_p_okala}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(15)">{{contactDetails.amir_p_visa}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(16)">{{contactDetails.amir_p_manpower}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(17)">{{contactDetails.amir_p_delivery}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(18)">{{contactDetails.amir_p_completed}}</span></td>
                  </tr>
                    <tr>
                      <td>AMIR RECUITING</td>
                      <td><span class="worker_report_table_td" @click="viewReport(19)">{{contactDetails.amir_r_okalawaiting}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(20)">{{contactDetails.amir_r_okala}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(21)">{{contactDetails.amir_r_visa}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(22)">{{contactDetails.amir_r_manpower}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(23)">{{contactDetails.amir_r_delivery}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(24)">{{contactDetails.amir_r_completed}}</span></td>
                  </tr>
                  <tr>
                      <td>FEMALE RECUITING</td>
                      <td><span class="worker_report_table_td" @click="viewReport(25)">{{contactDetails.female_r_okalawaiting}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(26)">{{contactDetails.female_r_okala}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(27)">{{contactDetails.female_r_visa}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(28)">{{contactDetails.female_r_manpower}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(29)">{{contactDetails.female_r_delivery}}</span></td>
                      <td><span class="worker_report_table_td" @click="viewReport(30)">{{contactDetails.female_r_completed}}</span></td>
                  </tr>
              </tbody>
          </table>
        </div>
    </b-card>
    <WorkersReport ref="view_modal" :lists="workers"></WorkersReport>
		    
         <div class="container-fluid" style="overflow: auto;" id="account_report">
              <table id="my-table" class="table table-striped table_fields">
                  <thead>
                      <tr>
                      <th scope="col">Date</th>
                      <th scope="col">Workers Number</th>
                      <th scope="col">Passport Name</th>
                      <th scope="col">Passport Number</th>
                      <th scope="col">Visa Number</th>
                      <th scope="col">Invoice</th>
                      <th scope="col">Bill</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-for="(visa,index) in contactDetails.visas" :key="index" >
                          <td>{{visa.created_at}}</td>
                          <td><span @click="viewModal(1,index,visa.id)">{{visa.worker_number}}</span></td>
                          <td>{{visa.passport_name}}</td>
                          <td>{{visa.passport_number}}</td>
                          <td>{{visa.visa_number}}</td>
                          <td>{{visa.total_invoice}}</td>
                          <td>{{visa.total_bill}}</td>
                      </tr>
                       <tr>
                          <td></td>
                          <td colspan="4">Total Accounht Info</td>
                          <td></td>
                      </tr>
                       <tr>
                          <td ></td>
                          <td></td>
                          <td colspan="3">Total Invoice</td>
                          <td>{{contactDetails.total_invoice}}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td colspan="3">Total Receive</td>
                          <td>{{contactDetails.total_receive}}</td>
                      </tr>
                       <tr>
                          <td></td>
                          <td></td>
                          <td colspan="3">Total Bill</td>
                          <td>{{contactDetails.total_bill}}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td colspan="3">Total Payment Made</td>
                          <td>{{contactDetails.total_payment_made}}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td colspan="3">Account Status</td>
                          <td>{{contactDetails.account_status}}</td>
                      </tr>
                     
                  </tbody>
              </table>
          </div>
           <button v-on:click="print('account_report')" class="button">Print</button>
          <div>
        </div>
        <Details :list="list" ref="details_modal"></Details>
        <Loader v-if="loader"></Loader>
      <AddInvoice :newInvoice="newInvoice" ref="add_invoice_modal"></AddInvoice>
	</div>
</template>
<script>
import Vue from "vue";
import axios from "axios"
import WorkersReport from '../dashboard/workersreportChange'
import Loader from '../common/Loader'
import Details from '../recuiting/workersinfo/details'
import { CONTACT_DETAILS,ALL_VISA,DELETE_VISA,GETLASTID } from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
import AddInvoice from './addInvoice'
export default {
    data(){
        return {
        	id:this.$route.params.id,
            largeModal2: false,
            contacts:[],
            permission:'',
            loading:false,
           
            search:{
                search_item:'',
                type:''
            },
            loader:false,
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
            list:{},
            lists:{},
            workers:{},
        }
    },
    methods:{
       print: function(elem) {
         var mywindow = window.open('', 'PRINT', 'height=800,width=1200');

          mywindow.document.write('<html><head><title>' + document.title  + '</title>');
          mywindow.document.write('</head><body >');
          mywindow.document.write('<h1>' + document.title  + '</h1>');
          mywindow.document.write(document.getElementById(elem).innerHTML);
          mywindow.document.write('</body></html>');

          mywindow.document.close(); // necessary for IE >= 10
          mywindow.focus(); // necessary for IE >= 10*/

          mywindow.print();
          mywindow.close();

          return true;
  
      },
       viewModal(type,index,id){
            this.loader = true;
            axios.get("/api/visa/show/"+id)
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
         viewReport(type){
             axios.get("api/worker/report/"+type+'/'+this.contactDetails.id+'/'+this.contactDetails.type)
              .then(response => {
                  this.workers = response.data
                   this.$refs.view_modal.openModal()
              })
              .catch(error => {
                  reject(error)
              });
            //this.lists = listArray;
           
         },
        addInvoiceModal(account_id,visa){
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
        },
        
        getResults() {

            this.$store.dispatch('CONTACT_DETAILS',this.id)
            .then(response=>{
                   
            })
            .catch(error=>{
                this.loading=true;        
            });

        },
        
        getPermission(){
            this.$store.dispatch('ALL_USER_ROLE2')
            .then(response=>{
                this.permission = response.data.permission
            })
        }
    },
    mounted(){
        this.getResults()
    },
    computed: {
        totalinvoice(){
            return (
                (parseFloat(this.rbl_p_invoice)+
                parseFloat(this.rbl_r_invoice)+
                parseFloat(this.amir_p_invoice)+
                parseFloat(this.amir_r_invoice)))
        },
        totaldue(){
            return (
                (parseFloat(this.rbl_p_invoice_due)+
                parseFloat(this.rbl_r_invoice_due)+
                parseFloat(this.amir_p_invoice_due)+
                parseFloat(this.amir_r_invoice_due)))
        },
        ...mapGetters(["contactDetails"]),
    },
    components: {
        Loader,
        AddInvoice,
        WorkersReport,
        Details
    }

}
</script>

<style>
.worker_report_table_td{
  cursor: pointer;
}
.custome_image{
    text-align: center;
    position: relative;
    
}
.custome_image>img{
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 1px solid;
    border-radius: 50%;
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
 .table_fields>td>span{
 	cursor:pointer;
 }
</style>
