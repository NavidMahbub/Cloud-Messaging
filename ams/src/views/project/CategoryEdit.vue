<template>
    <tr>
    <td>{{serial}}</td>
    <td v-if="!edit">
        {{project_category.name}}
    </td>
    <td v-if="edit">
        <input name="Category Name" v-model="project_category.name" v-validate="'required'"  type="text" class="form-control" id="inputPassword3" placeholder="Name">
        <p v-show="errors.has('Category Name')" style="color:red">* {{ errors.first('Category Name') }}</p>
    </td>
    <td v-if="!edit">
        {{project_category.status == 1 ? "Active":"Expired"}}
    </td>
    <td v-if="!edit">
        {{project_category.created_by}}
    </td>
    <td v-if="!edit">
        {{project_category.updated_by}}
    </td>
    <td v-if="edit">
        <div class="row">
            <div style="margin-left:15px;" class="custom-control custom-radio">
                <input v-model="project_category.status" type="radio" id="customRadio1" :name="project_category.name+project_category.id" class="custom-control-input" value="1">
                <label class="custom-control-label" for="customRadio1">Active</label>
            </div>
            <div style="margin-left:15px;" class="custom-control custom-radio">
                <input v-model="project_category.status" type="radio" id="customRadio2" :name="project_category.name+project_category.id"  class="custom-control-input" value="0" >
                <label class="custom-control-label" for="customRadio2">Expired</label>
            </div>
        </div>
    </td>
    <td v-if="!edit">
        <i v-if="permission.category_update || permission.category_update_all" @click="editField" class="icon-note icons actn"> </i>
        <i v-if="permission.category_delete || permission.category_delete_all" @click="deleteCategory(project_category.id)" class="icon-trash icons actn"> </i>
    </td>
    <td colspan="3" v-if="edit">
        <div class="pull-right">
            <button v-if="!editLoader" @click="updateCategory(project_category.id,project_category.name,project_category.status)"  class="btn btn-sm btn-success">Update</button>
            <button v-if="editLoader" class="btn btn-primary pull-right" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Submitting...
            </button>
            <button  v-if="!editLoader" @click="cancelEdit" style="margin-left:3px" class="btn btn-sm btn-primary">Cancel</button>
        </div>
    </td>
    </tr>
</template>

<script>
import { UPDATE_PROJECT_CATEGORY,DELETE_PROJECT_CATEGORY} from "../../store/action.type"
import Vue from 'vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate)
export default {
    props: ['project_category','serial','index'],
    data(){
        return {
            permission:'',
            edit:false,
            editLoader:false
        }
    },
    methods:{
        updateCategory(id,category_name,category_status){
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = {
                        category_id:id,
                        name:category_name,
                        status:category_status
                    }
                    var index = this.index
                    this.editLoader = true;
                    this.$store.dispatch('UPDATE_PROJECT_CATEGORY',{data,index})
                    .then(response=>{
                        this.editLoader = false;
                        this.edit = false 
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Category Updated Successsfully"})
                        
                    })
                    .catch(error=>{
                        this.editLoader = false; 
                        this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
                    });
                }
                
            })
        },
        editField(){
           this.edit = true
        },
        cancelEdit(){
           this.edit = false 
        },
        deleteCategory(id){
            var index = this.index
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
                        self.$store.dispatch('DELETE_PROJECT_CATEGORY',{index,id})
                        .then(response=>{
                            self.$iziToast.success({position:'topRight',title:'Ok',message:"Category Delated Successsfully"})
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
        this.getPermission()
    },

}
</script>

<style>

</style>
