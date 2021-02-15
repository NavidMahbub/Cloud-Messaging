<template>
    
    <div class="card">
        <div class="container-fluid">
            <div  style="padding-top:10px;padding-bottom:10px;" slot="header">
                <i class="fa fa-align-justify"></i> Update permission for<strong> {{role}} </strong>
            </div>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Module</th>
                        <th scope="col">View</th>
                        <th scope="col">Create</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody >
                    <tr>
                        <td>Contact</td>
                        <td ><c-switch  class="mx-1" color="info" label outline="alt" variant="pill"  v-model="contact.contact_view"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="contact.contact_create"  /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="contact.contact_update" /></td>
                        <td><c-switch class="mx-1" color="info"  label outline="alt" variant="pill"  v-model="contact.contact_delete"  /></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" @click="updateContact" value="Update Permission" class="btn btn-success pull-left">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios"
import { mapState,mapGetters } from "vuex"
import { ALL_USER_ROLE,ROLE_PERMISSION_UPDATE } from '../../store/action.type';
import { Switch as cSwitch } from '@coreui/vue'
export default {
    data(){
        return {
            contact:{
                contact_view:false,
                contact_create:false,
                contact_update:false,
                contact_delete:true,
                role_id:''
            }
        }
    },
    methods:{
        allRole(){
            this.$store.dispatch('ALL_USER_ROLE')
        },
        updateContact(){
            this.$store.dispatch('ROLE_PERMISSION_UPDATE',this.contact)
        },
        permission(){
            return new Promise((resolve, reject) => {
                axios
                .get("http://localhost:8000/api/role-permission/"+this.contact.role_id)
                .then(response => {
                    var data = response.data
                    this.set(data)
                    resolve(response);
                })
                .catch(function(error) {
                    reject(error);
                });
            });
        },
        set(data){
            this.contact.contact_view = data.contact_view,
            this.contact.contact_create = data.contact_create,
            this.contact.contact_update = data.contact_update,
            this.contact.contact_delete = data.contact_delete
        }
    },
    mounted(){
        
        this.allRole()
    },
    computed: {
        ...mapGetters(["user_roles"]),
        role(){
            this.contact.role_id = this.$route.params.id
            var roleName = ''
            this.user_roles.forEach(element => {
                if(element.id == this.$route.params.id){
                    this.roleName = element.name
                    this.permission()
                }
            });
            return this.roleName
        }
    },
    components:{
        cSwitch
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
