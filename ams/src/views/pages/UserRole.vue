<template>
    <div class="card">
        <div class="container-fluid">
            <button type="button" v-if="permission.role_create" @click="openModal"  class="btn btn-primary contct-b pull-left"><i class="fa fa-institution"></i> Add User Role</button>
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Role Name</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="(user_role,index) in user_roles" :key="index" >
                        <td>{{index+1}}</td>
                        <td >{{user_role.name}}</td>
                        <td>
                            <i v-if="permission.role_update || permission.role_update_all" @click="editModal(user_role,index)" class="icon-note icons actn"> </i>
                            <i v-if="permission.role_delete || permission.role_delete_all" @click="deleteRole(index,user_role.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
           <UserRoleAddModal  ref="add_user_role_modal"></UserRoleAddModal>
           <UserRoleEditModal ref="edit_user_role_modal"></UserRoleEditModal>
        </div>
    </div>
</template>

<script>
import UserRoleAddModal from './UserRoleAddModal'
import UserRoleEditModal from './UserRoleEditModal'
import { mapState,mapGetters } from "vuex"
import { ALL_USER_ROLE,DELETE_USER_ROLE } from '../../store/action.type';
export default {
    data(){
        return {
            // edit:false,
            permission:'',
        }
    },
    methods:{
        allRole(){
            this.$store.dispatch('ALL_USER_ROLE')
        },
        
        openModal(){
            this.$refs.add_user_role_modal.openModal()
        },
        editModal(user_role,index){
            this.$refs.edit_user_role_modal.openModal(user_role,index)
        },
        deleteRole(index,id){
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
                        self.$store.dispatch('DELETE_USER_ROLE',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Role Delated Successsfully"})
                            
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
        this.allRole();
        this.getPermission();
    },
    computed: {
        ...mapGetters(["user_roles"]),
    },
    components:{
        UserRoleAddModal,
        UserRoleEditModal
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
