<template>
    <div class="card">
        <div class="container-fluid">
            <button v-if="permission.invoice_create" type="button" @click="addInvoiceModal" class="btn btn-primary contct-b pull-left"><i class="fa fa-life-bouy"></i> Add Invoice</button>
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <select  @change="customerVisa(search.customer_id)" name="Customer" v-model="search.customer_id"  class="form-control" >
                    <option value="" >Select Client</option>
                    <option   :value="contact.id"  v-for="(contact,index) in allContacts" :key="index">{{contact.name}}</option>
                </select>
                <select name="CustomerVisa" v-model="search.visa_id"  class="form-control" >
                    <option value="" >Select Visa</option>
                    <option   :value="customervisa.id"  v-for="(customervisa,index) in customervisas" :key="index">{{customervisa.worker_number}}</option>
                </select>
                <select v-model="search.purpose"  class="form-control" style="margin-right:10px">
                    <option value="" >Select Account Type</option>
                    <option v-if="index == 0" disabled style="font-weight:800" v-for="(accountType,index) in getAccountType" :key="index+1000">{{accountType.name.toUpperCase()}}</option>
                    <option v-if="purpose.account_type_id == 15"  v-for="(purpose,index) in purposes" :key="index+2000" :value="purpose.id">{{purpose.name}}</option>
                    <option v-if="index == 1" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                    <option v-if="purpose.account_type_id == 16"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option> -->
                </select>
                <button @click.prevent="searchIncome" class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
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
                    <tr v-for="(invoice,index) in invoices" :key="index">
                        <td>{{indexf(index)}}</td>
                        <td>{{invoice.date}}</td>
                        <td>{{invoice.invoice_number}}</td>
                        <td>{{invoice.customer}}</td>
                        <td>{{invoice.due_date}}</td>
                        <td>{{invoice.total}}</td>
                        <td>{{invoice.due_amount}}</td>
                        <td>
                            <i v-if="permission.invoice_update || permission.invoice_update_all" @click="editInvoiceModal(invoice,index)" class="icon-note icons actn"> </i>
                            <i @click="viewInvoiceModal(invoice)" class="icon-eye icons   actn"> </i>
                            <i v-if="permission.invoice_delete || permission.invoice_delete_all" @click="deleteInvoice(index,invoice.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="Object.assign({},invoices2)" @pagination-change-page="getResults" :limit="8"></pagination>
            </nav>
        </div>
        <InvoiceAddModal ref="add_invoice_modal"></InvoiceAddModal>
        <InvoiceEditModal ref="edit_invoice_modal"></InvoiceEditModal>
        <InvoiceViewModal ref="view_invoice_modal"></InvoiceViewModal>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import Loader from '../common/Loader'
import pagination from 'laravel-vue-pagination'

import InvoiceAddModal from './InvoiceAddModal'
import InvoiceEditModal from './InvoiceEditModal'
import InvoiceViewModal from './InvoiceViewModal'

import { mapState,mapGetters } from "vuex"
import { ALL_PURPOSE,DELETE_INVOICE,ALL_USER_ROLE2,SEARCH_INVOICE,ALL_INVOICE,CUSTOMER_VISA } from '../../store/action.type';
export default {
    data(){
        return {
            loading:false,
            permission:'',
            search:{
                agent:'',
                customer_id:'',
                account_id:'',
                visa_id:''
            },
            index2:0,
        }
    },
    methods:{
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
        indexf(index){
            return this.index2+index;
        },
        searchIncome(){
            this.loading = true
            var data = this.search
            var page = 1
            this.$store.dispatch('SEARCH_INVOICE',{page,data})
                .then(response=>{
                    this.loading=false;
                    this.index2 = response.data.meta.from;
                })
                .catch(error=>{
                    this.loading=true;        
                });
        },
        getResults(page =1){
            this.loading = true;
            var data = this.search
            if(data != ''){
                this.$store.dispatch('SEARCH_INVOICE',{page,data})
                .then(response=>{
                    this.loading=false;
                    this.index2=response.data.meta.from;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
            else{
                this.$store.dispatch('ALL_INVOICE',page)
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
        },
        addInvoiceModal(){
            this.$refs.add_invoice_modal.openModal()
        },
        editInvoiceModal(invoice,index){
            this.$refs.edit_invoice_modal.openModal(invoice,index)
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
        this.necessaryThings();
    },
    computed: {
        ...mapGetters(["getAccountType","invoices","invoices2","purposes","allContacts","customervisas"]),
    },
    components: {
        InvoiceAddModal,
        InvoiceEditModal,
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
