<template>
    <div class="card">
        <div class="container-fluid">
            <button v-if="permission.purpose_create" type="button" @click="addProjectModal" class="btn btn-primary contct-b pull-left"><i class="fa fa-life-bouy"></i> Add Purpose</button>
            
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <input v-model="search.search_item" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button @click.prevent="searchPurpose" class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Account Type</th>
                    <th scope="col">Parent Account</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Updated By</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(purpose,index) in pPurposes" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{purpose.name}}</td>
                        <td>{{purpose.account_type}}</td>
                        <td>{{purpose.parent_account}}</td>
                        <td>{{purpose.created_by}}</td>
                        <td>{{purpose.updated_by}}</td>
                        <td>
                            <i v-if="permission.purpose_update || permission.purpose_update_all" @click="editPurposeModal(purpose,index)" class="icon-note icons actn"> </i>
                            <i @click="viewProjectModal()" class="icon-eye icons   actn"> </i>
                            <i v-if="permission.purpose_delete || permission.purpose_delete_all" @click="deletePurpose(index,purpose.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="Object.assign({},pPurposes2)" @pagination-change-page="getResults"></pagination>
            </nav>
        </div>
        <PurposeAddModal ref="add_purpose_modal"></PurposeAddModal>
        <PurposeEditModal ref="edit_purpose_modal"></PurposeEditModal>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import Loader from '../common/Loader'
import pagination from 'laravel-vue-pagination'

import PurposeAddModal from './PurposeAddModal'
import PurposeEditModal from './PurposeEditModal'

import { mapState,mapGetters } from "vuex"
import { SEARCH_PURPOSE,DELETE_PURPOSE,ALL_P_PURPOSE,ALL_USER_ROLE2} from '../../store/action.type';
export default {
    data(){
        return {
           loading:false,
           permission:'',
            search:{
                search_item:''
            }
        }
    },
    methods:{
        searchPurpose(){
            this.loading = true
            var data = this.search
            var page = 1
            this.$store.dispatch('SEARCH_PURPOSE',{page,data})
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
                this.$store.dispatch('SEARCH_PURPOSE',{page,data})
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
            else{
                this.$store.dispatch('ALL_P_PURPOSE',page)
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
        },
        addProjectModal(){
            this.$refs.add_purpose_modal.openModal()
        },
        editPurposeModal(project,index){
            this.$refs.edit_purpose_modal.openModal(project,index)
        },
        viewProjectModal(){
            this.$refs.view_project_modal.openModal()
        },
        deletePurpose(index,id){
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
                        self.$store.dispatch('DELETE_PURPOSE',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Purpose Deleted Successsfully"})
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
            })
        }
    },
    mounted(){
        this.getResults()
        this.getPermission()
    },
    computed: {
        ...mapGetters(["pPurposes","pPurposes2"]),
    },
    components: {
        PurposeAddModal,
        PurposeEditModal,
        pagination,
        Loader
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
