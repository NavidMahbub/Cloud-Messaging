<template>
    <div class="card">
        <div class="container-fluid">
            <button v-if="permission.project_create" type="button" @click="addProjectModal" class="btn btn-primary contct-b pull-left"><i class="fa fa-life-bouy"></i> Add Project</button>
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <input v-model="search.search_item" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button @click.prevent="searchProject" class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Updated By</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(project,index) in projects" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{project.name}}</td>
                        <td>{{project.category}}</td>
                        <td>{{project.type != 1 ? 'Flat':'Plot'}}</td>
                        <td>{{project.status == 1 ? 'Active':'Expired'}}</td>
                        <td>{{project.created_by}}</td>
                        <td>{{project.updated_by}}</td>
                        <td>
                            <i v-if="permission.project_update || permission.project_update_all" @click="editProjectModal(project,index)" class="icon-note icons actn"> </i>
                            <i @click="viewProjectModal(project)" class="icon-eye icons   actn"> </i>
                            <i v-if="permission.project_delete || permission.project_delete_all" @click="deleteProject(index,project.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="Object.assign({},pProjects)" @pagination-change-page="getResults"></pagination>
            </nav>
        </div>
        <AddProjectModal ref="add_project_modal"></AddProjectModal>
        <EditProjectModal ref="edit_project_modal"></EditProjectModal>
        <ViewProjectModal ref="view_project_modal"></ViewProjectModal>
        <Loader v-if="loading"></Loader>
    </div>
</template>

<script>
import AddProjectModal from './AddProjectModal'
import EditProjectModal from './EditProjectModal'
import ViewProjectModal from './ViewProjectModal'

import pagination from 'laravel-vue-pagination'
import Loader from '../common/Loader'

import { mapState,mapGetters } from "vuex"
import { All_PROJECT,DELETE_PROJECT,SEARCH_PROJECT,ALL_USER_ROLE2 } from '../../store/action.type';
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
        addProjectModal(){
            this.$refs.add_project_modal.openModal()
        },
        editProjectModal(project,index){
            this.$refs.edit_project_modal.openModal(project,index)
        },
        viewProjectModal(project){
            this.$refs.view_project_modal.openModal(project)
        },
        searchProject(){
            this.loading = true
            var data = this.search
            var page = 1
            this.$store.dispatch('SEARCH_PROJECT',{page,data})
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
                this.$store.dispatch('SEARCH_PROJECT',{page,data})
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
            else{
                this.$store.dispatch('All_PROJECT',page)
                .then(response=>{
                    this.loading=false;
                })
                .catch(error=>{
                    this.loading=true;        
                });
            }
        },
        deleteProject(index,id){
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
                        self.$store.dispatch('DELETE_PROJECT',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Project Delated Successsfully"})
                            
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
        ...mapGetters(["projects","pProjects"]),
    },
    components: {
        AddProjectModal,
        EditProjectModal,
        ViewProjectModal,
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
