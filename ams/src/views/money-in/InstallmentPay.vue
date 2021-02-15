<template>
    <b-modal title="Installment Pay" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="updateInstallmentPayment">
            <div>
                <div v-for="(installment,index) in installments" :key="index" class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">{{installment.month}} {{installment.week}}</label>
                    <div class="col-sm-4">
                        <input v-model='installment.pay' type="checkbox" value="1" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                <input v-if="!addLoader" type="submit" value="Submit" class="btn btn-primary pull-right"/>
                <button v-if="addLoader" class="btn btn-primary pull-right" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Submitting...
                </button>
                <button v-if="!addLoader"  @click.prevent="close" class="btn btn-success pull-right" style="margin-right:5px;">Close</button>
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
import Vue from 'vue'
// import VeeValidate from 'vee-validate';
// Vue.use(VeeValidate)
import axios from 'axios'
import {ALL_PURPOSE,ALL_ACCOUNT_TYPE2,ALL_CONTACT,UPDATE_INVOICE,CUSTOMER_VISA} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"

export default {
    data(){
        return{
            invoice_type:"",
            clients:[],
            agents:[],
            projects:[],
            largeModal:false,
            addLoader:false,
            index:'',
            editInvoice:{
                invoice_id:'',
                date:'',
                account_id:'',
                agent_id:'',
                visa_id:'',
                customer_id:'',
                invoice_number:'',
                due_date:'',
                customer_id:'',
                agent_id:'',
                commission_type:'',
                commission_amount:'',
                shipping_charge:'',
                adjustment:0,
                total:0,
                mode:0,
                down_payment:0,
                total_installment:0,
                per_installment_amount:0,
                installment_type:'',
                personal_note:'',
                customer_note:'',
                invoice_items:[],
                installments:[],
                payments:[],
                invoice:'',
                paid:0,
            },
            customerVisaLoading:false,
            installments:[],
            payments:[]
        }
    },
    methods:{
        test(){
            console.log( this.installments)
        },
        installmentSet(){
            this.installments = []
            var weeks = ['First','Second','Third','Forth'];
            var months = ['January','February','March','April','May','Jun','July','August','September','October','November','December']
            var selectDate = parseFloat(this.editInvoice.date.slice(5, 7))
            if(this.editInvoice.installment_type == 1){
                var j = 0
                for(var i=1;i<=this.editInvoice.total_installment;i++){
                    
                        this.installments.push({
                            month:months[selectDate-1],
                            week:weeks[j],
                            pay:0
                        })
                        j++;
                        if(j%4 == 0){
                            selectDate++
                        }
                }
            }
            else if(this.editInvoice.installment_type == 2){
                for(var i=1;i<=this.editInvoice.total_installment;i++){
                    this.installments.push({
                        month:months[selectDate-1],
                        week:'',
                        pay:0
                    })
                    selectDate++
                }

            }
            this.chckInstallment()
        },
        
        openModal(invoice,index,payments){
            this.index = index;
            this.largeModal = true
            this.editInvoice.invoice_id = invoice.id
            this.editInvoice.visa_id = invoice.visa_id
            this.editInvoice.account_id = invoice.account_id
            this.editInvoice.invoice_items = invoice.invoice_items
            this.editInvoice.date = invoice.date
            this.editInvoice.agent_id = invoice.agent_id
            this.editInvoice.customer_id = invoice.customer_id
            this.editInvoice.invoice_number = invoice.invoice_number
            this.editInvoice.due_date = invoice.due_date
            this.editInvoice.customer_id = invoice.customer_id
            this.editInvoice.agent_id = invoice.agent_id
            this.editInvoice.commission_type = invoice.commission_type
            this.editInvoice.commission_amount = invoice.commission_amount
            this.editInvoice.shipping_charge = invoice.shipping_charge
            this.editInvoice.adjustment = invoice.adjustment
            this.editInvoice.total = invoice.total
            this.editInvoice.mode = invoice.mode
            this.editInvoice.down_payment = invoice.down_payment
            this.editInvoice.total_installment = invoice.total_installment
            this.editInvoice.per_installment_amount = invoice.per_installment_amount
            this.editInvoice.installment_type = invoice.installment_type
            this.editInvoice.personal_note = invoice.personal_note
            this.editInvoice.customer_note = invoice.customer_note
            this.editInvoice.payments = payments
            this.editInvoice.invoices = invoice
            this.editInvoice.invoices.amount = invoice.per_installment_amount
            if(invoice.invoice_items == null){
                this.invoice_type = 1
            }else{
               this.invoice_type = 2 
            }
            this.installmentSet()
            
        },
        close(){
            this.largeModal = false
        },
        chckInstallment(){
            var self = this
            var i=0 
            this.editInvoice.payments.forEach(element=>{
                element.invoices.forEach(element2 =>{
                    if(element2.id == self.editInvoice.invoice_id){
                        self.installments[i].pay = true
                        self.editInvoice.paid = i+1
                        i++;
                    }
                    
                })
            })
        },
        updateInstallmentPayment(){
            this.addLoader = true;
            this.editInvoice.installments = this.installments
            return new Promise((resolve, reject) => {
            axios
                .post('/api/installment-payment',this.editInvoice)
                .then(response => {
                    resolve(response)
                    this.addLoader = false;
                    this.$iziToast.success({position:'topRight',title:'Ok',message:"Update Installment Payment Successsfully"})
                    this.$router.push("/installment/paid/"+this.editInvoice.invoice_id )
                })
                .catch(function(error) {
                    reject(error)
                    this.addLoader = false; 
                    this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})
                });
            });
        }
    },
    mounted(){
        // this.necessaryThings()
    },
    computed:{
        
    },
    components:{
        // VueEditor
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
