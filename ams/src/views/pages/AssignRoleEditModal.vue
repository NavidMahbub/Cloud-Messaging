<template>
    <b-modal title="Role" no-close-on-backdrop hide-footer size="xl"  v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="addRole" >
            <div>
                
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Nmae</label>
                    <div class="col-sm-4">
                        <p>{{editAssignRole.user_name}}</p>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Role</label>
                    <div class="col-sm-4">
                        <select name="Role" v-model="editAssignRole.role_id" class="form-control" >
                            <option value="" >Select Role</option>
                            <option  v-for="(user_role,index) in user_roles" :key="index" :value="user_role.id">{{user_role.name}}</option>
                        </select>
                        <div v-show="errors.has('Role')" class="help-block alert alert-danger">
                            {{ errors.first('Role') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                <input type="submit" value="Submit" class="btn btn-primary pull-right"/>
                <button  @click.prevent="close" class="btn btn-success pull-right" style="margin-right:5px;">Close</button>
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
import { Switch as cSwitch } from '@coreui/vue'
import axios from 'axios'
import Vue from 'vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate)

import {UPDATE_ASSIGN_USER_ROLE} from "../../store/action.type"
// import { ADD_CONTACT_LOADER} from "../../store/mutation.type"
import { mapState,mapGetters } from "vuex"

export default {
    data(){
        return{
            largeModal:false, 
            index:'',
            editAssignRole:{
                role_id:'',
                old_role_id:'',
                user_id:'',
                user_name:''
            }
        }
    },
    methods:{
        addRole () {
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.editAssignRole
                    var index = this.index
                    this.$store.dispatch('UPDATE_ASSIGN_USER_ROLE',{data,index})
                }
                
            })
            
        },
        allRole(){
            this.$store.dispatch('ALL_USER_ROLE')
        },
        openModal(user_role_info,index){
            this.largeModal = true
            this.index = index
            this.editAssignRole.user_name = user_role_info.user_name
            this.editAssignRole.role_id = user_role_info.role_id
            this.editAssignRole.old_role_id = user_role_info.role_id
            this.editAssignRole.user_id = user_role_info.user_id
        },
        close(){
            this.largeModal = false
        }

    },
    mounted(){
        this.allRole()
    },
    computed: {
        ...mapGetters(["user_roles"]),
    },
    components:{
        cSwitch
    }
}
</script>

<style>

</style>
