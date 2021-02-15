<template>
    <div class="card">
        <div class="container-fluid">
            <div style="padding-bottom:20px;" class="contct list-group col-md-12">
                <div class="row">
                    <div  class="col-md-3 contct">
                        <a class="list-group-item " href="#"><router-link to="/income-expense">Income Expense</router-link></a>
                    </div>
                    <div  class="col-md-3 contct">
                         <a class="list-group-item " href="#"><router-link to="/general-leadger">General Ledger</router-link></a>
                    </div>
                   
                    <div  class="col-md-3 contct">
                        <a class="list-group-item " href="#"><router-link to="/workers-report">Workers</router-link></a>
                    </div>
                    <div  class="col-md-3 contct">
                        <a class="list-group-item " href="#"><router-link to="/company-report">Company</router-link></a>
                    </div>
                </div>
            </div>
            <b-row>
               <table id="my-table" class="table table-sm">
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
                            <td rowspan="2">Amir Processing</td>
                            <td>workers</td>
                            <td>{{reports.amir_p_okalawaiting}}</td>
                            <td>{{reports.amir_p_okala}}</td>
                            <td>{{reports.amir_p_visa}}</td>
                            <td>{{reports.amir_p_manpower}}</td>
                            <td>{{reports.amir_p_delivery}}</td>
                            <td>{{reports.amir_p_completed}}</td>
                            <!-- <td>{{reports.amir_p_okalawaiting+reports.amir_p_okala+reports.amir_p_visa+reports.amir_p_manpower+reports.amir_p_delivery+reports.amir_p_completed}}</td> -->
                        </tr>
                       <tr>
                            <td>Amount</td>
                            <td>{{reports.amir_p_okalawaiting_invoice}}</td>
                            <td>{{reports.amir_p_okala_invoice}}</td>
                            <td>{{reports.amir_p_visa_invoice}}</td>
                            <td>{{reports.amir_p_manpower_invoice}}</td>
                            <td>{{reports.amir_p_delivery_invoice}}</td>
                            <td>{{reports.amir_p_completed_invoice}}</td>
                            <!-- <td>{{reports.amir_p_okalawaiting_invoice+reports.amir_p_okala_invoice+reports.amir_p_visa_invoice+reports.amir_p_manpower_invoice+reports.amir_p_delivery_invoice+reports.amir_p_completed_invoice}}</td> -->
                        </tr>
                        <tr>
                            <td rowspan="2">Amir Recruiting</td>
                            <td>workers</td>
                            <td>{{reports.amir_r_okalawaiting}}</td>
                            <td>{{reports.amir_r_okala}}</td>
                            <td>{{reports.amir_r_visa}}</td>
                            <td>{{reports.amir_r_manpower}}</td>
                            <td>{{reports.amir_r_delivery}}</td>
                            <td>{{reports.amir_r_completed}}</td>
                            <!-- <td>{{reports.amir_r_okalawaiting+reports.amir_r_okala+reports.amir_r_visa+reports.amir_r_manpower+reports.amir_r_delivery+reports.amir_r_completed}}</td> -->
                        </tr>
                       <tr>
                            <td>Amount</td>
                            <td>{{reports.amir_r_okalawaiting_invoice}}</td>
                            <td>{{reports.amir_r_okala_invoice}}</td>
                            <td>{{reports.amir_r_visa_invoice}}</td>
                            <td>{{reports.amir_r_manpower_invoice}}</td>
                            <td>{{reports.amir_r_delivery_invoice}}</td>
                            <td>{{reports.amir_r_completed_invoice}}</td>
                            <!-- <td>{{reports.amir_r_okalawaiting_invoice+reports.amir_r_okala_invoice+reports.amir_r_visa_invoice+reports.amir_r_manpower_invoice+reports.amir_r_delivery_invoice+reports.amir_r_completed_invoice}}</td> -->
                        </tr>
                        <tr>
                            <td rowspan="2">Ruble Processing</td>
                            <td>workers</td>
                            <td>{{reports.rbl_p_okalawaiting}}</td>
                            <td>{{reports.rbl_p_okala}}</td>
                            <td>{{reports.rbl_p_visa}}</td>
                            <td>{{reports.rbl_p_manpower}}</td>
                            <td>{{reports.rbl_p_delivery}}</td>
                            <td>{{reports.rbl_p_completed}}</td>
                            <!-- <td>{{reports.rbl_p_okalawaiting+reports.rbl_p_okala+reports.rbl_p_visa+reports.rbl_p_manpower+reports.rbl_p_delivery+reports.rbl_p_completed}}</td> -->
                        </tr>
                       <tr>
                            <td>Amount</td>
                            <td>{{reports.rbl_p_okalawaiting_invoice}}</td>
                            <td>{{reports.rbl_p_okala_invoice}}</td>
                            <td>{{reports.rbl_p_visa_invoice}}</td>
                            <td>{{reports.rbl_p_manpower_invoice}}</td>
                            <td>{{reports.rbl_p_delivery_invoice}}</td>
                            <td>{{reports.rbl_p_completed_invoice}}</td>
                            <!-- <td>{{reports.rbl_p_okalawaiting_invoice+reports.rbl_p_okala_invoice+reports.rbl_p_visa_invoice+reports.rbl_p_manpower_invoice+reports.rbl_p_delivery_invoice+reports.rbl_p_completed_invoice}}</td> -->
                        </tr>
                        <tr>
                            <td rowspan="2">Ruble Recruiting</td>
                            <td>workers</td>
                            <td>{{reports.rbl_r_okalawaiting}}</td>
                            <td>{{reports.rbl_r_okala}}</td>
                            <td>{{reports.rbl_r_visa}}</td>
                            <td>{{reports.rbl_r_manpower}}</td>
                            <td>{{reports.rbl_r_delivery}}</td>
                            <td>{{reports.rbl_r_completed}}</td>
                            <!-- <td>{{reports.rbl_r_okalawaiting+reports.rbl_r_okala+reports.rbl_r_visa+reports.rbl_r_manpower+reports.rbl_r_delivery+reports.rbl_r_completed}}</td> -->
                        </tr>
                       <tr>
                            <td>Amount</td>
                            <td>{{reports.rbl_r_okalawaiting_invoice}}</td>
                            <td>{{reports.rbl_r_okala_invoice}}</td>
                            <td>{{reports.rbl_r_visa_invoice}}</td>
                            <td>{{reports.rbl_r_manpower_invoice}}</td>
                            <td>{{reports.rbl_r_delivery_invoice}}</td>
                            <td>{{reports.rbl_r_completed_invoice}}</td>
                            <!-- <td>{{reports.rbl_r_okalawaiting_invoice+reports.rbl_r_okala_invoice+reports.rbl_r_visa_invoice+reports.rbl_r_manpower_invoice+reports.rbl_r_delivery_invoice+reports.rbl_r_completed_invoice}}</td> -->
                        </tr>
                    </tbody>
                </table>
            </b-row>
            <!-- <b-row>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.today_total_invoice}}</h4>
                        <p>Today Invoiced</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.today_total_payment_receive}}</h4>
                        <p>Today Receive</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.today_total_expense}}</h4>
                        <p>Today Expense</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.today_cash_in_hand}}</h4>
                        <p>Today Cash In Hand</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-info">
                    <b-card-body class="pb-0">
                        
                        <h4 class="mb-0">{{reports.today_total_invoice_due}}</h4>
                        <p>Today Invoice Due</p>
                    </b-card-body>
                    <card-line2-chart-example chartId="card-chart-02" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
                    </b-card>
                </b-col>
                  <b-col sm="3" lg="3">
                    <b-card no-body class="bg-danger">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.today_clients}}</h4>
                        <p>Today Client</p>
                    </b-card-body>
                    <card-bar-chart-example chartId="card-chart-04" class="chart-wrapper px-3" style="height:70px;" height="70"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.today_total_visa}}</h4>
                        <p>Today Visa</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
                    </b-card>
                </b-col>
            </b-row> -->
            <b-row>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.total_invoice}}</h4>
                        <p>Total Invoiced</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3"/>
                    </b-card>
                </b-col>
                
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.total_payment_receive}}</h4>
                        <p>Total Receive</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.total_expense}}</h4>
                        <p>Total Expense</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.cash_in_hand}}</h4>
                        <p>Cash In hand</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-info">
                    <b-card-body class="pb-0">
                        
                        <h4 class="mb-0">{{reports.total_invoice_due}}</h4>
                        <p>Total Invoice Due</p>
                    </b-card-body>
                    <card-line2-chart-example chartId="card-chart-02" class="chart-wrapper px-3"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-danger">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.clients}}</h4>
                        <p>Total Client</p>
                    </b-card-body>
                    <card-bar-chart-example chartId="card-chart-04" class="chart-wrapper px-3"/>
                    </b-card>
                </b-col>
                <b-col sm="3" lg="3">
                    <b-card no-body class="bg-primary">
                    <b-card-body class="pb-0">
                        <h4 class="mb-0">{{reports.total_visa}}</h4>
                        <p>Total Visa</p>
                    </b-card-body>
                    <card-line1-chart-example chartId="card-chart-01" class="chart-wrapper px-3"/>
                    </b-card>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'

import { mapState,mapGetters } from "vuex"
import { ALL_PURPOSE,DELETE_PROJECT,REPORT } from '../../store/action.type';
export default {
    data(){
        return {
           yourValue: null ,
           demo:{
            id: '2',
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
              color: 'purple',
              label: 'Select date range',
              id: 'RangeDatePicker'
            }
          },
        }
    },
    methods:{
        addProjectModal(){
            // this.$refs.add_purpose_modal.openModal()
        },
        editProjectModal(project,index){
            // this.$refs.edit_project_modal.openModal(project,index)
        },
        viewProjectModal(){
            // this.$refs.view_project_modal.openModal()
        },
        allPurpose(){
            this.$store.dispatch('ALL_PURPOSE')
        },
        deleteProject(index,id){
            
            this.$store.dispatch('DELETE_PROJECT',{index,id})
        },
        reportsf(){
            this.$store.dispatch('REPORT');
        }
    },
    mounted(){
        this.allPurpose();
        this.reportsf();
    },
    computed: {
        ...mapGetters(["purposes","reports"]),
    },
    components: {
        VueCtkDateTimePicker
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
