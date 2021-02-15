<template>
    <div class="card">
        <div class="container-fluid">
            <button v-if="permission.role_create"  type="button" @click="openModal" class="btn btn-primary contct-b pull-left"><i class="icons icon-user-follow"></i> Add Employee</button>
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <select v-model="search.type" name="Type"  id="inputState" class="form-control" style="margin-right:10px" >
                    <option value="" >Select Type</option>
                    <option value="3">Employee</option>
                    <!-- <option value="2">Agent</option> -->
                </select>
                <input v-model="search.search_item" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button @click.prevent="searchContact" class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(contact,index) in allPContacts2.data" :key="index" >
                        <td>{{indexf()}}</td>
                        <td>{{contact.name}}</td>
                        <td>
                            {{contact.type == 1 ? 'Client':''}}
                            {{contact.type == 2 ? 'Agent':''}}
                            {{contact.type == 3 ? 'Employee':''}}
                            {{contact.type == 4 ? 'Vendor':''}}
                            {{contact.type == 5 ? 'Unknown':''}}
                        </td>
                        <td>{{contact.email}}</td>
                        <td>{{contact.mobile_number}}</td>
                        <td>{{contact.created_at.date.substr(0,10)}}</td>
                        <td>{{contact.role_name}}</td>
                        <td>
                            <i v-if="permission.role_update || permission.role_update_all" @click="openEditModal(contact,index)" class="icon-note icons actn"> </i>
                            <i @click="viewContact(contact)" class="icon-eye icons   actn"> </i>
                            <!-- <router-link  :to="{ name : 'ContactDetails', params: {id : contact.id}}" style="padding:5px">
                            <i  class="icon-eye icons   actn"> </i>
                            </router-link> -->
                            <i v-if="permission.role_delete || permission.contact_delete_all" @click="deleteContact(index,contact.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <pagination :data="allPContacts2" @pagination-change-page="getResults"></pagination>
            </nav>
            
            <AddContactModal ref="add_contact_modal"></AddContactModal>
            <EditContactModal ref="edit_contact_modal"></EditContactModal>
            <ViewContactModal ref="view_contact_modal"></ViewContactModal>
            <Loader v-if="loading"></Loader>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>

import pagination from 'laravel-vue-pagination'
import axios from 'axios'
import AddContactModal from './AddContactModal'
import EditContactModal from './EditContactModal'
import ViewContactModal from './ViewContactModal'
import Loader from '../common/Loader'
import { ALL_CONTACT,ALL_P_CONTACT,DELETE_CONTACT,SEARCH_CONTACT,ALL_USER_ROLE2 } from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
    name: 'AssignRole-',
    data(){
        return {
            largeModal2: false,
            contacts:[],
            permission:'',
            loading:false,
            search:{
                search_item:'',
                type:3,
            },
            index2:0,

        }
    },
    methods:{
        indexf(index){
            return this.index2+index;
        },
        deleteContact(index,id){
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
                        self.$store.dispatch('DELETE_CONTACT',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Contact Delated Successsfully"})
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
        viewContact(contact){
             this.$refs.view_contact_modal.openModal(contact)
        },
        openModal(){
            this.$refs.add_contact_modal.openModal()
        },
        openEditModal(contact,index){
            this.$refs.edit_contact_modal.openEditModal(contact,index)
        },
        getResults(page = 1) {
            this.loading = true;
            var data = this.search
            this.$store.dispatch('SEARCH_CONTACT',{page,data})
            .then(response=>{
                this.loading=false;
                this.index2=response.data.meta.from;
            })
            .catch(error=>{
                this.loading=true;        
            });
            
        },
        searchContact(){
            this.loading = true;
            var data = this.search
            var page = 1
            this.$store.dispatch('SEARCH_CONTACT',{page,data})
            .then(response=>{
                this.loading=false;
            })
            .catch(error=>{
                this.loading=true;        
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
        ...mapGetters(["allPContacts","allPContacts2"]),
    },
    components: {
        AddContactModal,
        EditContactModal,
        ViewContactModal,
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
