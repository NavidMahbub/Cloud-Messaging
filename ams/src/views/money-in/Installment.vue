<template>
    <div class="card">
        <div class="container-fluid">
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Due Amount</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(invoice,index) in invoiceInstallments" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{invoice.date}}</td>
                        <td>{{invoice.invoice_number}}</td>
                        <td>{{invoice.customer}}</td>
                        <td>{{invoice.due_date}}</td>
                        <td>{{invoice.total}}</td>
                        <td>{{invoice.due_amount}}</td>
                        <td>
                            <i v-if="permission.invoice_update || permission.invoice_update_all" @click="editInvoiceModal(invoice,index)" class="fa fa-money actn"> </i>
                            <i @click="viewInvoiceModal(invoice)" class="icon-eye icons   actn"> </i>
                            <router-link :to="{ path: 'installment/paid/'+invoice.id}"> Payments</router-link>
                            <!-- <i v-if="permission.invoice_delete || permission.invoice_delete_all" @click="deleteInvoice(index,invoice.id)" class="fa fa-arrow-circle-down   actn"> </i> -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="Object.assign({},invoiceInstallments2)" @pagination-change-page="getResults"></pagination>
            </nav>
        </div>
        <InvoiceAddModal ref="add_invoice_modal"></InvoiceAddModal>
        <InstallmentPay ref="edit_invoice_modal"></InstallmentPay>
        <InvoiceViewModal ref="view_invoice_modal"></InvoiceViewModal>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import axios from 'axios'
import Loader from '../common/Loader'
import pagination from 'laravel-vue-pagination'

import InvoiceAddModal from './InvoiceAddModal'
import InstallmentPay from './InstallmentPay'
import InvoiceViewModal from './InvoiceViewModal'

import { mapState,mapGetters } from "vuex"
import { ALL_PURPOSE,DELETE_INVOICE,ALL_USER_ROLE2,SEARCH_INVOICE,ALL_INSTALLMENT_INVOICE } from '../../store/action.type';
export default {
    data(){
        return {
            loading:false,
            permission:'',
            search:{
                agent:'',
                customer:'',
                purpose:''
            },
            payments:[]
        }
    },
    methods:{
        paymentInstallment(){
            return new Promise((resolve, reject) => {
            axios
                .post('/api/installment-invoices-payment')
                .then(response => {
                    this.payments = response.data
                    this.loading=false
                    resolve(response)
                })
                .catch(function(error) {
                    reject(error)
                });
            });
        },
        // searchIncome(){
        //     this.loading = true
        //     var data = this.search
        //     var page = 1
        //     this.$store.dispatch('SEARCH_INVOICE',{page,data})
        //         .then(response=>{
        //             this.loading=false;
        //         })
        //         .catch(error=>{
        //             this.loading=true;        
        //         });
        // },
        getResults(page =1){
            this.loading=true;
            this.$store.dispatch('ALL_INSTALLMENT_INVOICE',page)
            .then(response=>{
                this.paymentInstallment()
            })
            .catch(error=>{
                this.loading=true;        
            });
        },
        addInvoiceModal(){
            this.$refs.add_invoice_modal.openModal()
        },
        editInvoiceModal(invoice,index){
            this.$refs.edit_invoice_modal.openModal(invoice,index,this.payments)
        },
        viewInvoiceModal(invoice){
            this.$refs.view_invoice_modal.openModal(invoice)
        },
        deleteInvoice(index,id){
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
                        self.$store.dispatch('DELETE_INVOICE',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Invoice Delated Successsfully"})
                            
                        })
                        .catch(error=>{
                            self.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
                        });
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
            
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            
                    }],
                ]
            });
        },
        necessaryThings(){
            this.$store.dispatch('ALL_PURPOSE')
            this.$store.dispatch('ALL_CONTACT')
            var id = 4;
            this.$store.dispatch('ALL_ACCOUNT_TYPE2',id)
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
        this.getPermission()
    },
    computed: {
        ...mapGetters(["getAccountType","invoiceInstallments","invoiceInstallments2","purposes","allContacts"]),
    },
    components: {
        InvoiceAddModal,
        InstallmentPay,
        InvoiceViewModal,
        Loader,
        pagination
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
