<template>
    <div class="card">
        <div class="container-fluid">
            <button v-if="permission.category_create" type="button" @click="openModal"  class="btn btn-primary contct-b pull-left"><i class="fa fa-institution"></i> Add Category</button>
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <input v-model="search.search_item" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button @click.prevent="searchProjectCategory" class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Project Category Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Updated By</th>
                    <th v-if="permission.category_update || permission.category_update_all || permission.category_delete || permission.category_delete_all" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody >
                    <EditCategory v-for="(project_category,index) in projectPcategories" :key="index" :index="index"  :serial="index+1" :project_category="project_category"></EditCategory>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="Object.assign({},projectPcategories2)" @pagination-change-page="getResults"></pagination>
            </nav>
            <AddCategoryModal ref="add_category_modal"></AddCategoryModal>
            <Loader v-if="loading"></Loader>
        </div>
    </div>
</template>

<script>
import Loader from '../common/Loader'
import pagination from 'laravel-vue-pagination'

import AddCategoryModal from './AddCategoryModal'
import EditCategory from './CategoryEdit'
import { mapState,mapGetters } from "vuex"
import { All_PROJECT_CATEGORY,ALL_USER_ROLE2 } from '../../store/action.type';
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
        searchProjectCategory(){
            this.loading = true
            var data = this.search
            var page = 1
            this.$store.dispatch('SEARCH_PROJECT_CATEGORY',{page,data})
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
                this.$store.dispatch('SEARCH_PROJECT_CATEGORY',{page,data})
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
            else{
                this.$store.dispatch('ALL_P_PROJECT_CATEGORY',page)
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
        },
        
        openModal(){
            this.$refs.add_category_modal.openModal()
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
        ...mapGetters(["projectPcategories","projectPcategories2"]),
    },
    components:{
        AddCategoryModal,
        EditCategory,
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
