<template>
    <div class="card">
        <div class="container-fluid">
            <button v-if="permission.expense_create" type="button" @click="addExpenseModal" class="btn btn-primary contct-b pull-left"><i class="fa fa-life-bouy"></i> Add Expense</button>
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <select @change="searchExpense" v-model="search.vendor"   id="inputState" class="form-control" style="margin-right:10px" >
                    <option  value="" >Select Client</option>
                    <option   v-for="(allContact,index) in vendors" :key="index" :value="allContact.id">{{allContact.name}}</option>
                </select>
                <select @change="searchExpense"  v-model="search.purpose"  class="form-control" style="margin-right:10px">
                    <option value="" >Select Purpose</option>
                    <option v-if="index == 0" disabled style="font-weight:800" v-for="(accountType,index) in getAccountType" :key="index+1000">{{accountType.name.toUpperCase()}}</option>
                    <option v-if="purpose.account_type_id == 17"  v-for="(purpose,index) in purposes" :key="index+2000" :value="purpose.id">{{purpose.name}}</option>
                    <option v-if="index == 1" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                    <option v-if="purpose.account_type_id == 18"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option>
                    <option v-if="index == 2" disabled style="font-weight:800"  v-for="(accountType,index) in getAccountType" :key="index+3000">{{accountType.name.toUpperCase()}}</option>
                    <option v-if="purpose.account_type_id == 19"  v-for="(purpose,index) in purposes" :key="index+4000" :value="purpose.id">{{purpose.name}}</option>
                </select>
            </form>
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Date</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(expense,index) in expenses" :key="index">
                        <td>{{indexf(index)}}</td>
                        <td>{{expense.account}}</td>
                        <td>{{expense.date}}</td>
                        <td>{{expense.vendor}}</td>
                        <td>{{parseFloat(expense.amount)+parseFloat(expense.tax_total)}}</td>
                        <td>
                            <i v-if="permission.expense_update || permission.expense_update_all" @click="editExpenseModal(expense,index)" class="icon-note icons actn"> </i>
                            <i @click="viewExpenseModal(expense)" class="icon-eye icons   actn"> </i>
                            <i v-if="permission.expense_delete || permission.expense_delete_all" @click="deleteExpense(index,expense.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="Object.assign({},expenses2)" @pagination-change-page="getResults"></pagination>
            </nav>
        </div>
        <ExpenseAddModal ref="add_expense_modal"></ExpenseAddModal>
        <ExpenseEditModal ref="edit_expense_modal"></ExpenseEditModal>
        <ExpenseViewModal ref="view_expense_modal"></ExpenseViewModal>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import Loader from '../common/Loader'
import pagination from 'laravel-vue-pagination'

import ExpenseAddModal from './ExpenseAddModal'
import ExpenseEditModal from './ExpenseEditModal'
import ExpenseViewModal from './ExpenseViewModal'
import axios from 'axios'
import { mapState,mapGetters } from "vuex"
import { ALL_PURPOSE,DELETE_EXPENSE,ALL_USER_ROLE2 } from '../../store/action.type';
export default {
    data(){
        return {
            vendors:[],
            loading:false,
            permission:'',
            search:{
                vendor:'',
                purpose:''
            },
            index2:0,
        }
    },
    methods:{
        indexf(index){
            return this.index2+index;
        },
        searchExpense(){
            this.loading = true
            var data = this.search
            var page = 1
            this.$store.dispatch('SEARCH_EXPENSE',{page,data})
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
                this.$store.dispatch('SEARCH_EXPENSE',{page,data})
                .then(response=>{
                    this.loading=false;
                    this.index2 = response.data.meta.from;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
            else{
                this.$store.dispatch('ALL_EXPENSE',page)
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
        },
        addExpenseModal(){
            this.$refs.add_expense_modal.openModal()
        },
        editExpenseModal(expense,index){
            this.$refs.edit_expense_modal.openModal(expense,index)
        },
        viewExpenseModal(expense){
            this.$refs.view_expense_modal.openModal(expense)
        },
        necessaryThings(){
            this.$store.dispatch('ALL_PURPOSE')
            var id = 5;
            this.$store.dispatch('ALL_ACCOUNT_TYPE2',id)
        },
        contactVendors(){
            return new Promise((resolve, reject) => {
                var type = 4
                axios.get("api/specific/contacts/"+type)
                .then(response => {
                    this.vendors = response.data
                    resolve(response)
                })
                .catch(error => {
                    reject(error)
                });
            });
        },
        deleteExpense(index,id){
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
                        self.$store.dispatch('DELETE_EXPENSE',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Expense Delated Successsfully"})
                            
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
        getPermission(){
            this.$store.dispatch('ALL_USER_ROLE2')
            .then(response=>{
                this.permission = response.data.permission
                console.log(this.permission)
            })
        }
    },
    mounted(){
        this.getResults()
        this.getPermission()
        this.contactVendors()
    },
    computed: {
        ...mapGetters(["getAccountType","expenses","expenses2","purposes"]),
    },
    components: {
        ExpenseAddModal,
        ExpenseEditModal,
        ExpenseViewModal,
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
