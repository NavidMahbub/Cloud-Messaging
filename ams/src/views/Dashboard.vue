<template>
  <div class="animated fadeIn">
    <b-card header="Reports">
     <b-row>
          <table id="my-table" class="table table-striped">
              <thead>
                  <tr>
                      <th scope="col">Type</th>
                      <th scope="col">Type</th>
                      <th scope="col">Waiting</th>
                      <th scope="col">Okala</th>
                      <th scope="col">Visa</th>
                      <th scope="col">Manpower</th>
                      <th scope="col">Deliverd</th>
                      <th scope="col">Completed</th>
                      <!-- <th scope="col">Total</th> -->
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td rowspan="2">Amir Proc</td>
                      <td>workers</td>
                      <td><a href="#" @click="viewReport(1,3)">{{workersCount(1,3)}}</a></td>
                      <td><a href="#" @click="viewReport(2,3)">{{workersCount(2,3)}}</a></td>
                      <td><a href="#" @click="viewReport(3,3)">{{workersCount(3,3)}}</a></td>
                      <td><a href="#" @click="viewReport(4,3)">{{workersCount(4,3)}}</a></td>
                      <td><a href="#" @click="viewReport(6,3)">{{workersCount(6,3)}}</a></td>
                      <td><a href="#" @click="viewReport(7,3)">{{workersCount(7,3)}}</a></td>
                      <!-- <td>{{reports.amir_p_okalawaiting+reports.amir_p_okala+reports.amir_p_visa+reports.amir_p_manpower+reports.amir_p_delivery+reports.amir_p_completed}}</td> -->
                  </tr>
                  <tr>
                      <td>Amount</td>
                      <td>{{invoiceCount(1,3)}}</td>
                      <td>{{invoiceCount(2,3)}}</td>
                      <td>{{invoiceCount(3,3)}}</td>
                      <td>{{invoiceCount(4,3)}}</td>
                      <td>{{invoiceCount(6,3)}}</td>
                      <td>{{invoiceCount(7,3)}}</td>
                      <!-- <td>{{reports.amir_p_okalawaiting_invoice+reports.amir_p_okala_invoice+reports.amir_p_visa_invoice+reports.amir_p_manpower_invoice+reports.amir_p_delivery_invoice+reports.amir_p_completed_invoice}}</td> -->
                  </tr>
                  <tr>
                      <td rowspan="2">Amir Rec</td>
                      <td>workers</td>
                      <td><a href="#" @click="viewReport(1,4)">{{workersCount(1,4)}}</a></td>
                      <td><a href="#" @click="viewReport(2,4)">{{workersCount(2,4)}}</a></td>
                      <td><a href="#" @click="viewReport(3,4)">{{workersCount(3,4)}}</a></td>
                      <td><a href="#" @click="viewReport(4,4)">{{workersCount(4,4)}}</a></td>
                      <td><a href="#" @click="viewReport(6,4)">{{workersCount(6,4)}}</a></td>
                      <td><a href="#" @click="viewReport(7,4)">{{workersCount(7,4)}}</a></td>
                      <!-- <td>{{reports.amir_r_okalawaiting+reports.amir_r_okala+reports.amir_r_visa+reports.amir_r_manpower+reports.amir_r_delivery+reports.amir_r_completed}}</td> -->
                  </tr>
                  <tr>
                      <td>Amount</td>
                      <td>{{invoiceCount(1,4)}}</td>
                      <td>{{invoiceCount(2,4)}}</td>
                      <td>{{invoiceCount(3,4)}}</td>
                      <td>{{invoiceCount(4,4)}}</td>
                      <td>{{invoiceCount(6,4)}}</td>
                      <td>{{invoiceCount(7,4)}}</td>
                      <!-- <td>{{reports.amir_r_okalawaiting_invoice+reports.amir_r_okala_invoice+reports.amir_r_visa_invoice+reports.amir_r_manpower_invoice+reports.amir_r_delivery_invoice+reports.amir_r_completed_invoice}}</td> -->
                  </tr>
                  <tr>
                      <td rowspan="2">Ruble Proc</td>
                      <td>workers</td>
                      <td><a href="#" @click="viewReport(1,1)">{{workersCount(1,1)}}</a></td>
                      <td><a href="#" @click="viewReport(2,1)">{{workersCount(2,1)}}</a></td>
                      <td><a href="#" @click="viewReport(3,1)">{{workersCount(3,1)}}</a></td>
                      <td><a href="#" @click="viewReport(4,1)">{{workersCount(4,1)}}</a></td>
                      <td><a href="#" @click="viewReport(6,1)">{{workersCount(6,1)}}</a></td>
                      <td><a href="#" @click="viewReport(7,1)">{{workersCount(7,1)}}</a></td>
                      <!-- <td>{{reports.rbl_p_okalawaiting+reports.rbl_p_okala+reports.rbl_p_visa+reports.rbl_p_manpower+reports.rbl_p_delivery+reports.rbl_p_completed}}</td> -->
                  </tr>
                  <tr>
                      <td>Amount</td>
                     <td>{{invoiceCount(1,1)}}</td>
                      <td>{{invoiceCount(2,1)}}</td>
                      <td>{{invoiceCount(3,1)}}</td>
                      <td>{{invoiceCount(4,1)}}</td>
                      <td>{{invoiceCount(6,1)}}</td>
                      <td>{{invoiceCount(7,1)}}</td>
                      <!-- <td>{{reports.rbl_p_okalawaiting_invoice+reports.rbl_p_okala_invoice+reports.rbl_p_visa_invoice+reports.rbl_p_manpower_invoice+reports.rbl_p_delivery_invoice+reports.rbl_p_completed_invoice}}</td> -->
                  </tr>
                  <tr>
                      <td rowspan="2">Ruble Rec</td>
                      <td>workers</td>
                      <td><a href="#" @click="viewReport(1,2)">{{workersCount(1,2)}}</a></td>
                      <td><a href="#" @click="viewReport(2,2)">{{workersCount(2,2)}}</a></td>
                      <td><a href="#" @click="viewReport(3,2)">{{workersCount(3,2)}}</a></td>
                      <td><a href="#" @click="viewReport(4,2)">{{workersCount(4,2)}}</a></td>
                      <td><a href="#" @click="viewReport(6,2)">{{workersCount(6,2)}}</a></td>
                      <td><a href="#" @click="viewReport(7,2)">{{workersCount(7,2)}}</a></td>
                      <!-- <td>{{reports.rbl_r_okalawaiting+reports.rbl_r_okala+reports.rbl_r_visa+reports.rbl_r_manpower+reports.rbl_r_delivery+reports.rbl_r_completed}}</td> -->
                  </tr>
                  <tr>
                      <td>Amount</td>
                      <td>{{invoiceCount(1,2)}}</td>
                      <td>{{invoiceCount(2,2)}}</td>
                      <td>{{invoiceCount(3,2)}}</td>
                      <td>{{invoiceCount(4,2)}}</td>
                      <td>{{invoiceCount(6,2)}}</td>
                      <td>{{invoiceCount(7,2)}}</td>
                      <!-- <td>{{reports.rbl_r_okalawaiting_invoice+reports.rbl_r_okala_invoice+reports.rbl_r_visa_invoice+reports.rbl_r_manpower_invoice+reports.rbl_r_delivery_invoice+reports.rbl_r_completed_invoice}}</td> -->
                  </tr>
                  <tr>
                      <td rowspan="2">Nahar Rec</td>
                      <td>workers</td>
                      <td><a href="#" @click="viewReport(1,6)">{{workersCount(1,6)}}</a></td>
                      <td><a href="#" @click="viewReport(2,6)">{{workersCount(2,6)}}</a></td>
                      <td><a href="#" @click="viewReport(3,6)">{{workersCount(3,6)}}</a></td>
                      <td><a href="#" @click="viewReport(4,6)">{{workersCount(4,6)}}</a></td>
                      <td><a href="#" @click="viewReport(6,6)">{{workersCount(6,6)}}</a></td>
                      <td><a href="#" @click="viewReport(7,6)">{{workersCount(7,6)}}</a></td>
                      <!-- <td>{{reports.rbl_r_okalawaiting+reports.rbl_r_okala+reports.rbl_r_visa+reports.rbl_r_manpower+reports.rbl_r_delivery+reports.rbl_r_completed}}</td> -->
                  </tr>
                  <tr>
                      <td>Amount</td>
                      <td>{{invoiceCount(1,6)}}</td>
                      <td>{{invoiceCount(2,6)}}</td>
                      <td>{{invoiceCount(3,6)}}</td>
                      <td>{{invoiceCount(4,6)}}</td>
                      <td>{{invoiceCount(6,6)}}</td>
                      <td>{{invoiceCount(7,6)}}</td>
                      <!-- <td>{{reports.rbl_r_okalawaiting_invoice+reports.rbl_r_okala_invoice+reports.rbl_r_visa_invoice+reports.rbl_r_manpower_invoice+reports.rbl_r_delivery_invoice+reports.rbl_r_completed_invoice}}</td> -->
                  </tr>
                  <tr>
                      <td rowspan="2">Nahar Rec</td>
                      <td>workers</td>
                      <td><a href="#" @click="viewReport(1,7)">{{workersCount(1,7)}}</a></td>
                      <td><a href="#" @click="viewReport(2,7)">{{workersCount(2,7)}}</a></td>
                      <td><a href="#" @click="viewReport(3,7)">{{workersCount(3,7)}}</a></td>
                      <td><a href="#" @click="viewReport(4,7)">{{workersCount(4,7)}}</a></td>
                      <td><a href="#" @click="viewReport(6,7)">{{workersCount(6,7)}}</a></td>
                      <td><a href="#" @click="viewReport(7,7)">{{workersCount(7,7)}}</a></td>
                      <!-- <td>{{reports.rbl_r_okalawaiting+reports.rbl_r_okala+reports.rbl_r_visa+reports.rbl_r_manpower+reports.rbl_r_delivery+reports.rbl_r_completed}}</td> -->
                  </tr>
                  <tr>
                      <td>Amount</td>
                      <td>{{invoiceCount(1,7)}}</td>
                      <td>{{invoiceCount(2,7)}}</td>
                      <td>{{invoiceCount(3,7)}}</td>
                      <td>{{invoiceCount(4,7)}}</td>
                      <td>{{invoiceCount(6,7)}}</td>
                      <td>{{invoiceCount(7,7)}}</td>
                      <!-- <td>{{reports.rbl_r_okalawaiting_invoice+reports.rbl_r_okala_invoice+reports.rbl_r_visa_invoice+reports.rbl_r_manpower_invoice+reports.rbl_r_delivery_invoice+reports.rbl_r_completed_invoice}}</td> -->
                  </tr>
                   <tr>
                      <td rowspan="2">Famel Rec</td>
                      <td>workers</td>
                      <td><a href="#" @click="viewReport(1,5)">{{workersCount(1,5)}}</a></td>
                      <td><a href="#" @click="viewReport(2,5)">{{workersCount(2,5)}}</a></td>
                      <td><a href="#" @click="viewReport(3,5)">{{workersCount(3,5)}}</a></td>
                      <td><a href="#" @click="viewReport(4,5)">{{workersCount(4,5)}}</a></td>
                      <td><a href="#" @click="viewReport(6,5)">{{workersCount(6,5)}}</a></td>
                      <td><a href="#" @click="viewReport(7,5)">{{workersCount(7,5)}}</a></td>
                      <!-- <td>{{reports.rbl_r_okalawaiting+reports.rbl_r_okala+reports.rbl_r_visa+reports.rbl_r_manpower+reports.rbl_r_delivery+reports.rbl_r_completed}}</td> -->
                  </tr>
                  <tr>
                      <td>Amount</td>
                      <td>{{invoiceCount(1,5)}}</td>
                      <td>{{invoiceCount(2,5)}}</td>
                      <td>{{invoiceCount(3,5)}}</td>
                      <td>{{invoiceCount(4,5)}}</td>
                      <td>{{invoiceCount(6,5)}}</td>
                      <td>{{invoiceCount(7,5)}}</td>
                      <!-- <td>{{reports.rbl_r_okalawaiting_invoice+reports.rbl_r_okala_invoice+reports.rbl_r_visa_invoice+reports.rbl_r_manpower_invoice+reports.rbl_r_delivery_invoice+reports.rbl_r_completed_invoice}}</td> -->
                  </tr>
              </tbody>
          </table>
      </b-row>
    </b-card>
    <WorkersReport ref="view_modal" :lists="lists"></WorkersReport>
    <Loader v-if="loader"></Loader>
  </div>
</template>

<script>
import WorkersReport from './dashboard/WorkersReport'
import { Callout } from '@coreui/vue'
import { mapState,mapGetters } from "vuex"
import { STATISTICS,SEARCH_LEADGER} from '@/store/action.type';
import Loader from './common/Loader'
export default {
  name: 'dashboard',
  components: {
    WorkersReport,
    Loader,
  },
  data: function () {
    return {
      lists:{},
      loader:false,
    }
  },
  computed: {
      ...mapGetters(["leadgerdatas","statistics","authuser","user"]),
  },
  mounted(){
    this.getPermission();
  },
  methods: {
    invoiceCount(report,type){
        if(report==1){
        let total = 0;
        this.statistics.okalawaiting_invoice.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==2){
        let total = 0;
        this.statistics.okala_invoice.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==3){
        let total = 0;
        this.statistics.visa_invoice.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==4){
        let total = 0;
        this.statistics.manpower_invoice.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==5){
        let total = 0;
        this.statistics.flight_invoice.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==6){
        let total = 0;
        this.statistics.delivery_invoice.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==7){
        let total = 0;
        this.statistics.completed_invoice.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
    },
    workersCount(report,type){
      if(report==1){
        let total = 0;
        this.statistics.okalawaiting.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==2){
        let total = 0;
        this.statistics.okala.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==3){
        let total = 0;
        this.statistics.visa.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==4){
        let total = 0;
        this.statistics.manpower.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==5){
        let total = 0;
        this.statistics.flight.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==6){
        let total = 0;
        this.statistics.delivery.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
      if(report==7){
        let total = 0;
        this.statistics.completed.forEach(element => {
          if(element.type==type){
            total =  element.TotalType
          }
        });
        return total;
      }
    },
    getPermission(){
        this.$store.dispatch('ALL_USER_ROLE2')
        .then(response=>{
            if(response.data.id!=2){
              this.getResults();
            }else{
              this.DataShow();
            }
        })
    },
    viewReport(report,type){
      this.$refs.view_modal.openModal(report,type)
    },
    getResults(){
          this.loader = true;
          this.$store.dispatch('STATISTICS')
          .then(response=>{
             this.loader=false;    
          })
          .catch(error=>{
              this.loader=true;        
          });

      },

  }
}
</script>

<style>
.cursor_pointer{
  cursor: pointer;
}
  /* IE fix */
  #card-chart-01, #card-chart-02 {
    width: 100% !important;
  }
</style>
