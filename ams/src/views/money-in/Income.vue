<template>
    <div class="card">
        <div class="container-fluid">
            <button v-if="permission.income_create" type="button" @click="addIncomeModal" class="btn btn-primary contct-b pull-left"><i class="fa fa-life-bouy"></i> Add Income</button>
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <select v-model="search.agent"   id="inputState" class="form-control" style="margin-right:10px" >
                    <option  value="" >Select Agent</option>
                    <option v-if="allContact.type == 2"  v-for="(allContact,index) in allContacts" :key="index" :value="allContact.id">{{allContact.name}}</option>
                </select>
                <select v-model="search.customer"   id="inputState" class="form-control" style="margin-right:10px" >
                    <option  value="" >Select Customer</option>
                    <option v-if="allContact.type == 1"  v-for="(allContact,index) in allContacts" :key="index" :value="allContact.id">{{allContact.name}}</option>
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
                    <th scope="col">Purpose</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Agent</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(income,index) in incomes" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{income.account}}</td>
                        <td>{{income.customer}}</td>
                        <td>{{income.agent}}</td>
                        <td>{{parseFloat(income.amount)}}</td>
                        <td>
                            <i v-if="permission.income_update || permission.income_update_all" @click="editIncomeModal(income,index)" class="icon-note icons actn"> </i>
                            <i @click="viewIncomeModal(income)" class="icon-eye icons   actn"> </i>
                            <i v-if="permission.income_delete || permission.income_delete_all" @click="deleteIncome(index,income.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="Object.assign({},incomes2)" @pagination-change-page="getResults"></pagination>
            </nav>
        </div>
        <IncomeAddModal ref="add_income_modal"></IncomeAddModal>
        <IncomeEditModal ref="edit_income_modal"></IncomeEditModal>
        <IncomeViewModal ref="view_income_modal"></IncomeViewModal>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import Loader from '../common/Loader'
import pagination from 'laravel-vue-pagination'

import IncomeAddModal from './IncomeAddModal'
import IncomeEditModal from './IncomeEditModal'
import IncomeViewModal from './IncomeViewModal'

import { mapState,mapGetters } from "vuex"
import { ALL_PURPOSE,DELETE_INCOME,ALL_USER_ROLE2 } from '../../store/action.type';
export default {
    data(){
        return {
            loading:false,
            permission:'',
            search:{
                agent:'',
                customer:'',
                purpose:''
            }
        }
    },
    methods:{
        searchIncome(){
            this.loading = true
            var data = this.search
            var page = 1
            this.$store.dispatch('SEARCH_INCOME',{page,data})
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
        },
        getResults(page =1){
            this.loading = true;
            var data = this.search
            if(data != ''){
                this.$store.dispatch('SEARCH_INCOME',{page,data})
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
            else{
                this.$store.dispatch('ALL_INCOME',page)
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
        },
        addIncomeModal(){
            this.$refs.add_income_modal.openModal()
        },
        editIncomeModal(income,index){
            this.$refs.edit_income_modal.openModal(income,index)
        },
        viewIncomeModal(income){
            this.$refs.view_income_modal.openModal(income)
        },
        allIncome(){
            this.$store.dispatch('ALL_INCOME')
        },
        deleteIncome(index,id){
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
                        self.$store.dispatch('DELETE_INCOME',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Income Delated Successsfully"})
                            
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
        ...mapGetters(["getAccountType","incomes","incomes2","purposes","allContacts"]),
    },
    components: {
        IncomeAddModal,
        IncomeEditModal,
        IncomeViewModal,
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
