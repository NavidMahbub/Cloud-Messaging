<template>
  <div class="animated fadeIn">
    <!-- Amir Processing -->
    <b-card header="Amir Processing">
      <b-row>
        <b-col sm="6" md="2" @click="viewReport(13)">
          <b-card class="text-white bg-info cursor_pointer">
            <div class="h4 mb-0">{{amir_p_okalawaiting}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Waiting</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(14)">
          <b-card class="text-white bg-success cursor_pointer">
            <div class="h4 mb-0">{{amir_p_okala}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Okala</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(15)">
          <b-card class="text-white bg-warning cursor_pointer">
            <div class="h4 mb-0">{{amir_p_visa}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Visa</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(16)">
          <b-card class="text-white bg-primary cursor_pointer">
            <div class="h4 mb-0">{{amir_p_manpower}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Manpower</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(17)">
          <b-card class="text-white bg-danger cursor_pointer">
            <div class="h4 mb-0">{{amir_p_delivery}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Deliverd</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(18)">
          <b-card class="text-white bg-danger cursor_pointer">
            <div class="h4 mb-0">{{amir_p_completed}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Completed</small>
          </b-card>
        </b-col>
        <!-- <b-col sm="6" md="2" >
          <b-card class="text-white bg-info cursor_pointer">
            <div class="h4 mb-0">{{amir_p_invoice-amir_p_invoice_due}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Income</small>
            <div class="h4 mb-0">{{amir_p_invoice_due}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Due</small>
          </b-card>
       </b-col> -->
      </b-row>
    </b-card>
    <!-- Amir Processing -->
    <!-- Amir Recuiting -->
    <b-card header="Amir Recruiting">
      <b-row>
        <b-col sm="6" md="2" @click="viewReport(19)">
          <b-card class="text-white bg-info cursor_pointer">
            <div class="h4 mb-0">{{amir_r_okalawaiting}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Waiting</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(20)">
          <b-card class="text-white bg-success cursor_pointer">
            <div class="h4 mb-0">{{amir_r_okala}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Okala</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(21)">
          <b-card class="text-white bg-warning cursor_pointer">
            <div class="h4 mb-0">{{amir_r_visa}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Visa</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(22)">
          <b-card class="text-white bg-primary cursor_pointer">
            <div class="h4 mb-0">{{amir_r_manpower}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Manpower</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(23)">
          <b-card class="text-white bg-danger cursor_pointer">
            <div class="h4 mb-0">{{amir_r_delivery}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Deliverd</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(24)">
          <b-card class="text-white bg-danger cursor_pointer">
            <div class="h4 mb-0">{{amir_r_completed}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Completed</small>
          </b-card>
        </b-col>
        <!-- <b-col sm="6" md="2" >
          <b-card class="text-white bg-info cursor_pointer">
            <div class="h4 mb-0">{{amir_r_invoice-amir_r_invoice_due}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Income</small>
            <div class="h4 mb-0">{{amir_r_invoice_due}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Due</small>
          </b-card>
        </b-col> -->
      </b-row>
    </b-card>
    <!-- Amir Recuiting -->
    <!-- Ruble profeccing -->
    <b-card header="Rubel Processing">
      <b-row>
        <b-col sm="6" md="2" @click="viewReport(1)">
          <b-card class="text-white bg-info cursor_pointer">
            <div class="h4 mb-0">{{rbl_p_okalawaiting}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Waiting</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(2)">
          <b-card class="text-white bg-success cursor_pointer">
            <div class="h4 mb-0">{{rbl_p_okala}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Okala</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(3)">
          <b-card class="text-white bg-warning cursor_pointer">
            <div class="h4 mb-0">{{rbl_p_visa}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Visa</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(4)">
          <b-card class="text-white bg-primary cursor_pointer">
            <div class="h4 mb-0">{{rbl_p_manpower}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Manpower</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(5)">
          <b-card class="text-white bg-danger cursor_pointer">
            <div class="h4 mb-0">{{rbl_p_delivery}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Deliverd</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(6)">
          <b-card class="text-white bg-danger cursor_pointer">
            <div class="h4 mb-0">{{rbl_p_completed}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Completed</small>
          </b-card>
        </b-col>
        <!-- <b-col sm="6" md="2">
          <b-card class="text-white bg-info cursor_pointer">
            <div class="h4 mb-0">{{rbl_p_invoice-rbl_p_invoice_due}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Income</small>
            <div class="h4 mb-0">{{rbl_p_invoice_due}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Due</small>
          </b-card>
        </b-col> -->
      </b-row>
    </b-card>
    <!-- Ruble profeccing -->
    <!-- Ruble Recuiting -->
    <b-card header="Rubel Recruiting">
      <b-row>
        <b-col sm="6" md="2" @click="viewReport(7)">
          <b-card class="text-white bg-info cursor_pointer">
            <div class="h4 mb-0">{{rbl_r_okalawaiting}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Waiting</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(8)">
          <b-card class="text-white bg-success cursor_pointer">
            <div class="h4 mb-0">{{rbl_r_okala}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Okala</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(9)">
          <b-card class="text-white bg-warning cursor_pointer">
            <div class="h4 mb-0">{{rbl_r_visa}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Visa</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(10)">
          <b-card class="text-white bg-primary cursor_pointer">
            <div class="h4 mb-0">{{rbl_r_manpower}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Manpower</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(11)">
          <b-card class="text-white bg-danger cursor_pointer">
            <div class="h4 mb-0">{{rbl_r_delivery}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Deliverd</small>
          </b-card>
        </b-col>
        <b-col sm="6" md="2" @click="viewReport(12)">
          <b-card class="text-white bg-danger cursor_pointer">
            <div class="h4 mb-0">{{rbl_r_completed}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Completed</small>
          </b-card>
        </b-col>
        <!-- <b-col sm="6" md="2">
          <b-card class="text-white bg-info cursor_pointer">
            <div class="h4 mb-0">{{rbl_r_invoice-rbl_r_invoice_due}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Income</small>
            <div class="h4 mb-0">{{rbl_r_invoice_due}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Due</small>
          </b-card>
        </b-col> -->
      </b-row>
    </b-card>
    <!-- Ruble Recuiting -->
     
    <WorkersReport ref="view_modal" :lists="lists"></WorkersReport>
  </div>
</template>

<script>
import WorkersReport from './dashboard/WorkersReport'
import { Callout } from '@coreui/vue'
import { mapState,mapGetters } from "vuex"
import { STATISTICS,SEARCH_LEADGER} from '@/store/action.type';
export default {
  name: 'dashboard',
  components: {
    WorkersReport,
  },
  data: function () {
    return {
      lists:{},
      rbl_p_invoice:0,
      rbl_p_invoice_due:0,
      rbl_r_invoice:0,
      rbl_r_invoice_due:0,
      amir_p_invoice:0,
      amir_p_invoice_due:0,
      amir_r_invoice:0,
      amir_r_invoice_due:0,
      rbl_p_okalawaiting:0,
      rbl_p_okala:0,
      rbl_p_visa:0,
      rbl_p_manpower:0,
      rbl_p_delivery:0,
      rbl_p_completed:0,
      rbl_r_okalawaiting:0,
      rbl_r_okala:0,
      rbl_r_visa:0,
      rbl_r_manpower:0,
      rbl_r_delivery:0,
      rbl_r_completed:0,
      amir_p_okalawaiting:0,
      amir_p_okala:0,
      amir_p_visa:0,
      amir_p_manpower:0,
      amir_p_delivery:0,
      amir_p_completed:0,
      amir_r_okalawaiting:0,
      amir_r_okala:0,
      amir_r_visa:0,
      amir_r_manpower:0,
      amir_r_delivery:0,
      amir_r_completed:0,
      selected: 'Month',
      tableItems: [
        {
          avatar: { url: 'img/avatars/1.jpg', status: 'success' },
          user: { name: 'Yiorgos Avraamu', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'USA', flag: 'us' },
          usage: { value: 50, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Mastercard', icon: 'fa fa-cc-mastercard' },
          activity: '10 sec ago'
        },
        {
          avatar: { url: 'img/avatars/2.jpg', status: 'danger' },
          user: { name: 'Avram Tarasios', new: false, registered: 'Jan 1, 2015' },
          country: { name: 'Brazil', flag: 'br' },
          usage: { value: 22, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Visa', icon: 'fa fa-cc-visa' },
          activity: '5 minutes ago'
        },
        {
          avatar: { url: 'img/avatars/3.jpg', status: 'warning' },
          user: { name: 'Quintin Ed', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'India', flag: 'in' },
          usage: { value: 74, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Stripe', icon: 'fa fa-cc-stripe' },
          activity: '1 hour ago'
        },
        {
          avatar: { url: 'img/avatars/4.jpg', status: '' },
          user: { name: 'Enéas Kwadwo', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'France', flag: 'fr' },
          usage: { value: 98, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'PayPal', icon: 'fa fa-paypal' },
          activity: 'Last month'
        },
        {
          avatar: { url: 'img/avatars/5.jpg', status: 'success' },
          user: { name: 'Agapetus Tadeáš', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'Spain', flag: 'es' },
          usage: { value: 22, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Google Wallet', icon: 'fa fa-google-wallet' },
          activity: 'Last week'
        },
        {
          avatar: { url: 'img/avatars/6.jpg', status: 'danger' },
          user: { name: 'Friderik Dávid', new: true, registered: 'Jan 1, 2015' },
          country: { name: 'Poland', flag: 'pl' },
          usage: { value: 43, period: 'Jun 11, 2015 - Jul 10, 2015' },
          payment: { name: 'Amex', icon: 'fa fa-cc-amex' },
          activity: 'Last week'
        }
      ],
      tableFields: {
        avatar: {
          label: '<i class="icon-people"></i>',
          class: 'text-center'
        },
        user: {
          label: 'User'
        },
        country: {
          label: 'Country',
          class: 'text-center'
        },
        usage: {
          label: 'Usage'
        },
        payment: {
          label: 'Payment method',
          class: 'text-center'
        },
        activity: {
          label: 'Activity'
        }
      },
      loader:false,
    }
  },
  computed: {
      ...mapGetters(["leadgerdatas","statistics","authuser","user"]),
      total2(){
            var total = 0
            this.leadgerdatas.forEach(element => {
                if(element.type == 1){
                    total = total+ parseFloat(element.total)
                }
                if(element.type == 2){
                    total = total - parseFloat(element.total)
                }
                
            })
             
            return total
            
        }
  },
  mounted(){
    this.getPermission();
    
    this.serachLeadger();
  },
  methods: {
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
    serachLeadger(){
        var d = new Date();
        var today = d.getFullYear() + '-' + ((d.getMonth()+1)<10?'0':'') + (d.getMonth()+1) + '-' + (d.getDate()<10?'0':'') + d.getDate();
          var data = {
             customer_id:'',
             vandor_id:'',
             account_id:'',
             strat_date:today,
             end_date:today,
          }
          this.$store.dispatch('SEARCH_LEADGER',data)
    },
    variant (value) {
      let $variant
      if (value <= 25) {
        $variant = 'info'
      } else if (value > 25 && value <= 50) {
        $variant = 'success'
      } else if (value > 50 && value <= 75) {
        $variant = 'warning'
      } else if (value > 75 && value <= 100) {
        $variant = 'danger'
      }
      return $variant
    },
    viewReport(type){
      var listArray = [];
      if(this.user.id!=2){
      this.statistics.clients.forEach(element => {
        var list=null;
        if(type==1 && element.rbl_p_okalawaiting.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_p_okalawaiting};
        }
        else if(type==2 && element.rbl_p_okala.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_p_okala};
        }
        else if(type==3 && element.rbl_p_visa.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_p_visa};
        }
        else if(type==4 && element.rbl_p_manpower.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_p_manpower};
        }else if(type==6 && element.rbl_p_completed.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_p_completed};
        }
        else if(type==5 && element.rbl_p_delivery.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_p_delivery};
        }else if(type==7 && element.rbl_r_okalawaiting.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_r_okalawaiting};
        }
        else if(type==8 && element.rbl_r_okala.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_r_okala};
        }
        else if(type==9 && element.rbl_r_visa.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_r_visa};
        }
        else if(type==10 && element.rbl_r_manpower.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_r_manpower};
        }else if(type==12 && element.rbl_r_completed.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_r_completed};
        }
        else if(type==11 && element.rbl_r_delivery.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.rbl_r_delivery};
        }else if(type==13 && element.amir_p_okalawaiting.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_p_okalawaiting};
        }
        else if(type==14 && element.amir_p_okala.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_p_okala};
        }
        else if(type==15 && element.amir_p_visa.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_p_visa};
        }
        else if(type==16 && element.amir_p_manpower.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_p_manpower};
        }else if(type==18 && element.amir_p_completed.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_p_completed};
        }
        else if(type==17 && element.amir_p_delivery.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_p_delivery};
        }else if(type==19 && element.amir_r_okalawaiting.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_r_okalawaiting};
        }
        else if(type==20 && element.amir_r_okala.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_r_okala};
        }
        else if(type==21 && element.amir_r_visa.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_r_visa};
        }
        else if(type==22 && element.amir_r_manpower.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_r_manpower};
        }else if(type==24 && element.amir_r_completed.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_r_completed};
        }
        else if(type==23 && element.amir_r_delivery.length>0){
           list={name:element.name,mobile_number:element.mobile_number,visas:element.amir_r_delivery};
        }
        if(list!=null){
          listArray.push(list);
        }
        
      });
      }else{
        var list=null;
        if(type==1 && this.authuser.rbl_p_okalawaiting.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_p_okalawaiting};
        }
        else if(type==2 && this.authuser.rbl_p_okala.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_p_okala};
        }
        else if(type==3 && this.authuser.rbl_p_visa.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_p_visa};
        }
        else if(type==4 && this.authuser.rbl_p_manpower.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_p_manpower};
        }else if(type==6 && this.authuser.rbl_p_completed.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_p_completed};
        }
        else if(type==5 && this.authuser.rbl_p_delivery.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_p_delivery};
        }else if(type==7 && this.authuser.rbl_r_okalawaiting.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_r_okalawaiting};
        }
        else if(type==8 && this.authuser.rbl_r_okala.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_r_okala};
        }
        else if(type==9 && this.authuser.rbl_r_visa.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_r_visa};
        }
        else if(type==10 && this.authuser.rbl_r_manpower.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_r_manpower};
        }else if(type==12 && this.authuser.rbl_r_completed.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_r_completed};
        }
        else if(type==11 && this.authuser.rbl_r_delivery.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.rbl_r_delivery};
        }else if(type==13 && this.authuser.amir_p_okalawaiting.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_p_okalawaiting};
        }
        else if(type==14 && this.authuser.amir_p_okala.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_p_okala};
        }
        else if(type==15 && this.authuser.amir_p_visa.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_p_visa};
        }
        else if(type==16 && this.authuser.amir_p_manpower.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_p_manpower};
        }else if(type==18 && this.authuser.amir_p_completed.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_p_completed};
        }
        else if(type==17 && this.authuser.amir_p_delivery.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_p_delivery};
        }else if(type==19 && this.authuser.amir_r_okalawaiting.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_r_okalawaiting};
        }
        else if(type==20 && this.authuser.amir_r_okala.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_r_okala};
        }
        else if(type==21 && this.authuser.amir_r_visa.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_r_visa};
        }
        else if(type==22 && this.authuser.amir_r_manpower.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_r_manpower};
        }else if(type==24 && this.authuser.amir_r_completed.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_r_completed};
        }
        else if(type==23 && this.authuser.amir_r_delivery.length>0){
           list={name:this.authuser.name,mobile_number:this.authuser.mobile_number,visas:this.authuser.amir_r_delivery};
        }
        if(list!=null){
          listArray.push(list);
        }
      }
      this.lists = listArray;
      this.$refs.view_modal.openModal()
    },
    flag (value) {
      return 'flag-icon flag-icon-' + value
    },
    DataShow(){
      this.$store.dispatch('AUTH_USER')
      .then(response=>{
          console.log('a');
      let data = response.data;
      console.log(data);
      let rbl_p_okalawaiting_t=0;
      let rbl_p_okala_t=0;
      let rbl_p_visa_t=0;
      let rbl_p_manpower_t=0;
      let rbl_p_delivery_t=0;
      let rbl_p_completed_t=0;
      let rbl_r_okalawaiting_t=0;
      let rbl_r_okala_t=0;
      let rbl_r_visa_t=0;
      let rbl_r_manpower_t=0;
      let rbl_r_delivery_t=0;
      let rbl_r_completed_t=0;
      let amir_p_okalawaiting_t=0;
      let amir_p_okala_t=0;
      let amir_p_visa_t=0;
      let amir_p_manpower_t=0;
      let amir_p_delivery_t=0;
      let amir_p_completed_t=0;
      let amir_r_okalawaiting_t=0;
      let amir_r_okala_t=0;
      let amir_r_visa_t=0;
      let amir_r_manpower_t=0;
      let amir_r_delivery_t=0;
      let amir_r_completed_t=0;

      let rbl_p_invoice_t=0;
      let rbl_p_invoice_due_t=0;
      let rbl_r_invoice_t=0;
      let rbl_r_invoice_due_t=0;
      let amir_p_invoice_t=0;
      let amir_p_invoice_due_t=0;
      let amir_r_invoice_t=0;
      let amir_r_invoice_due_t=0;
        rbl_p_okalawaiting_t = rbl_p_okalawaiting_t+data.rbl_p_okalawaiting.length;
        rbl_p_okala_t = rbl_p_okala_t+data.rbl_p_okala.length;
        rbl_p_visa_t = rbl_p_visa_t+data.rbl_p_visa.length;
        rbl_p_manpower_t = rbl_p_manpower_t+data.rbl_p_manpower.length;
        rbl_p_delivery_t = rbl_p_delivery_t+data.rbl_p_delivery.length;
        rbl_p_completed_t = rbl_p_completed_t+data.rbl_p_completed.length;
        rbl_r_okalawaiting_t = rbl_r_okalawaiting_t+data.rbl_r_okalawaiting.length;
        rbl_r_okala_t = rbl_r_okala_t+data.rbl_r_okala.length;
        rbl_r_visa_t = rbl_r_visa_t+data.rbl_r_visa.length;
        rbl_r_manpower_t = rbl_r_manpower_t+data.rbl_r_manpower.length;
        rbl_r_delivery_t = rbl_r_delivery_t+data.rbl_r_delivery.length;
        rbl_r_completed_t = rbl_r_completed_t+data.rbl_r_completed.length;
        amir_p_okalawaiting_t = amir_p_okalawaiting_t+data.amir_p_okalawaiting.length;
        amir_p_okala_t = amir_p_okala_t+data.amir_p_okala.length;
        amir_p_visa_t = amir_p_visa_t+data.amir_p_visa.length;
        amir_p_manpower_t = amir_p_manpower_t+data.amir_p_manpower.length;
        amir_p_delivery_t = amir_p_delivery_t+data.amir_p_delivery.length;
        amir_p_completed_t = amir_p_completed_t+data.amir_p_completed.length;
        amir_r_okalawaiting_t = amir_r_okalawaiting_t+data.amir_r_okalawaiting.length;
        amir_r_okala_t = amir_r_okala_t+data.amir_r_okala.length;
        amir_r_visa_t = amir_r_visa_t+data.amir_r_visa.length;
        amir_r_manpower_t = amir_r_manpower_t+data.amir_r_manpower.length;
        amir_r_delivery_t = amir_r_delivery_t+data.amir_r_delivery.length;
        amir_r_completed_t = amir_r_completed_t+data.amir_r_completed.length;

        this.rbl_p_invoice=rbl_p_invoice_t;
        this.rbl_p_invoice_due=rbl_p_invoice_due_t;
        this.rbl_r_invoice=rbl_r_invoice_t;
        this.rbl_r_invoice_due=rbl_r_invoice_due_t;
        this.amir_p_invoice=amir_p_invoice_t;
        this.amir_p_invoice_due=amir_p_invoice_due_t;
        this.amir_r_invoice=amir_r_invoice_t;
        this.amir_r_invoice_due=amir_r_invoice_due_t;

        this.rbl_p_okalawaiting = rbl_p_okalawaiting_t;
        this.rbl_p_okala = rbl_p_okala_t;
        this.rbl_p_visa = rbl_p_visa_t;
        this.rbl_p_manpower = rbl_p_manpower_t;
        this.rbl_p_delivery = rbl_p_delivery_t,
        this.rbl_p_completed = rbl_p_completed_t,
        this.rbl_r_okalawaiting = rbl_r_okalawaiting_t;
        this.rbl_r_okala = rbl_r_okala_t;
        this.rbl_r_visa= rbl_r_visa_t;
        this.rbl_r_manpower = rbl_r_manpower_t;
        this.rbl_r_delivery = rbl_r_delivery_t;
        this.rbl_r_completed = rbl_r_completed_t;
        this.amir_p_okalawaiting = amir_p_okalawaiting_t;
        this.amir_p_okala = amir_p_okala_t;
        this.amir_p_visa = amir_p_visa_t;
        this.amir_p_manpower = amir_p_manpower_t;
        this.amir_p_delivery = amir_p_delivery_t;
        this.amir_p_completed = amir_p_completed_t;
        this.amir_r_okalawaiting = amir_r_okalawaiting_t;
        this.amir_r_okala = amir_r_okala_t;
        this.amir_r_visa = amir_r_visa_t;
        this.amir_r_manpower = amir_r_manpower_t; 
        this.amir_r_delivery = amir_r_delivery_t;
        this.amir_r_completed = amir_r_completed_t;
      })
      .catch(error=>{    
      });
      
    },
    getResults(){
          this.loader = true;
          this.$store.dispatch('STATISTICS')
          .then(response=>{
            console.log('response.data');
            console.log(response.data);
              this.loader=false;
              let data = response.data;
              let rbl_p_okalawaiting_t=0;
              let rbl_p_okala_t=0;
              let rbl_p_visa_t=0;
              let rbl_p_manpower_t=0;
              let rbl_p_delivery_t=0;
              let rbl_p_completed_t=0;
              let rbl_r_okalawaiting_t=0;
              let rbl_r_okala_t=0;
              let rbl_r_visa_t=0;
              let rbl_r_manpower_t=0;
              let rbl_r_delivery_t=0;
              let rbl_r_completed_t=0;
              let amir_p_okalawaiting_t=0;
              let amir_p_okala_t=0;
              let amir_p_visa_t=0;
              let amir_p_manpower_t=0;
              let amir_p_delivery_t=0;
              let amir_p_completed_t=0;
              let amir_r_okalawaiting_t=0;
              let amir_r_okala_t=0;
              let amir_r_visa_t=0;
              let amir_r_manpower_t=0;
              let amir_r_delivery_t=0;
              let amir_r_completed_t=0;

              let rbl_p_invoice_t=0;
              let rbl_p_invoice_due_t=0;
              let rbl_r_invoice_t=0;
              let rbl_r_invoice_due_t=0;
              let amir_p_invoice_t=0;
              let amir_p_invoice_due_t=0;
              let amir_r_invoice_t=0;
              let amir_r_invoice_due_t=0;

              data.clients.forEach(element => {
                rbl_p_okalawaiting_t = rbl_p_okalawaiting_t+element.rbl_p_okalawaiting.length;
                rbl_p_okala_t = rbl_p_okala_t+element.rbl_p_okala.length;
                rbl_p_visa_t = rbl_p_visa_t+element.rbl_p_visa.length;
                rbl_p_manpower_t = rbl_p_manpower_t+element.rbl_p_manpower.length;
                rbl_p_delivery_t = rbl_p_delivery_t+element.rbl_p_delivery.length;
                rbl_p_completed_t = rbl_p_completed_t+element.rbl_p_completed.length;
                rbl_r_okalawaiting_t = rbl_r_okalawaiting_t+element.rbl_r_okalawaiting.length;
                rbl_r_okala_t = rbl_r_okala_t+element.rbl_r_okala.length;
                rbl_r_visa_t = rbl_r_visa_t+element.rbl_r_visa.length;
                rbl_r_manpower_t = rbl_r_manpower_t+element.rbl_r_manpower.length;
                rbl_r_delivery_t = rbl_r_delivery_t+element.rbl_r_delivery.length;
                rbl_r_completed_t = rbl_r_completed_t+element.rbl_r_completed.length;
                amir_p_okalawaiting_t = amir_p_okalawaiting_t+element.amir_p_okalawaiting.length;
                amir_p_okala_t = amir_p_okala_t+element.amir_p_okala.length;
                amir_p_visa_t = amir_p_visa_t+element.amir_p_visa.length;
                amir_p_manpower_t = amir_p_manpower_t+element.amir_p_manpower.length;
                amir_p_delivery_t = amir_p_delivery_t+element.amir_p_delivery.length;
                amir_p_completed_t = amir_p_completed_t+element.amir_p_completed.length;
                amir_r_okalawaiting_t = amir_r_okalawaiting_t+element.amir_r_okalawaiting.length;
                amir_r_okala_t = amir_r_okala_t+element.amir_r_okala.length;
                amir_r_visa_t = amir_r_visa_t+element.amir_r_visa.length;
                amir_r_manpower_t = amir_r_manpower_t+element.amir_r_manpower.length;
                amir_r_delivery_t = amir_r_delivery_t+element.amir_r_delivery.length;
                amir_r_completed_t = amir_r_completed_t+element.amir_r_completed.length;
              });
              this.rbl_p_invoice=rbl_p_invoice_t;
              this.rbl_p_invoice_due=rbl_p_invoice_due_t;
              this.rbl_r_invoice=rbl_r_invoice_t;
              this.rbl_r_invoice_due=rbl_r_invoice_due_t;
              this.amir_p_invoice=amir_p_invoice_t;
              this.amir_p_invoice_due=amir_p_invoice_due_t;
              this.amir_r_invoice=amir_r_invoice_t;
              this.amir_r_invoice_due=amir_r_invoice_due_t;

              this.rbl_p_okalawaiting = rbl_p_okalawaiting_t;
              this.rbl_p_okala = rbl_p_okala_t;
              this.rbl_p_visa = rbl_p_visa_t;
              this.rbl_p_manpower = rbl_p_manpower_t;
              this.rbl_p_delivery = rbl_p_delivery_t,
              this.rbl_p_completed = rbl_p_completed_t,
              this.rbl_r_okalawaiting = rbl_r_okalawaiting_t;
              this.rbl_r_okala = rbl_r_okala_t;
              this.rbl_r_visa= rbl_r_visa_t;
              this.rbl_r_manpower = rbl_r_manpower_t;
              this.rbl_r_delivery = rbl_r_delivery_t;
              this.rbl_r_completed = rbl_r_completed_t;
              this.amir_p_okalawaiting = amir_p_okalawaiting_t;
              this.amir_p_okala = amir_p_okala_t;
              this.amir_p_visa = amir_p_visa_t;
              this.amir_p_manpower = amir_p_manpower_t;
              this.amir_p_delivery = amir_p_delivery_t;
              this.amir_p_completed = amir_p_completed_t;
              this.amir_r_okalawaiting = amir_r_okalawaiting_t;
              this.amir_r_okala = amir_r_okala_t;
              this.amir_r_visa = amir_r_visa_t;
              this.amir_r_manpower = amir_r_manpower_t; 
              this.amir_r_delivery = amir_r_delivery_t;
              this.amir_r_completed = amir_r_completed_t;
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
