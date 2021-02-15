
<template>
    <div class="card">
        <div class="container-fluid">
            
            <form class="form-inline contct my-2 my-lg-0 pull-right">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" >Search</button>
            </form>
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Role Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="(user_role_info,index) in user_role_infos" :key="index" >
                        <td>{{index+1}}</td>
                        <td >{{user_role_info.role_name}}</td>
                        <td >{{user_role_info.user_name}}</td>
                        <td >{{user_role_info.email}}</td>
                        <td>
                            <i @click="editModal(user_role_info,index)" class="icon-note icons actn"> </i>
                            <i @click="deleteRole(index,user_role.id)" class="icon-trash icons   actn"> </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm">
                    
                </ul>
            </nav>
           <AssignRoleEditModal  ref="edit_assign_role_modal"></AssignRoleEditModal>
        </div>
    </div>
</template>

<script>
import AssignRoleEditModal from './AssignRoleEditModal'
import { mapState,mapGetters } from "vuex"
import { ALL_USER_ROLE_INFO,DELETE_USER_ROLE } from '../../store/action.type';
export default {
    data(){
        return {
            // edit:false,
        }
    },
    methods:{
        allUserRoleInfo(){
            this.$store.dispatch('ALL_USER_ROLE_INFO')
        },
        editModal(user_role_info,index){
            this.$refs.edit_assign_role_modal.openModal(user_role_info,index)
        }
        
    },
    mounted(){
        this.allUserRoleInfo()
    },
    computed: {
        ...mapGetters(["user_role_infos"]),
    },
    components:{
        AssignRoleEditModal
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
