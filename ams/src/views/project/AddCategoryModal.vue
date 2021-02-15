<template>
    <b-modal title="Category" hide-footer size="lg" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="addCategory" >
             <div class="container custom_modal_body">
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                    <input name="Name" v-validate="'required'" v-model="newCategory.name" type="text" class="form-control" id="inputPassword3" placeholder="Category Name">
                    <div v-show="errors.has('Name')" class="help-block alert alert-danger">
                        {{ errors.first('Name') }}
                    </div>
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div style="margin-left:15px" class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" v-model="newCategory.status"   class="custom-control-input" value="1" >
                                <label class="custom-control-label" for="customRadio1">Active</label>
                            </div>
                            <div style="margin-left:15px" class="custom-control custom-radio">
                                <input  v-model="newCategory.status" type="radio" id="customRadio2"  class="custom-control-input" value="0">
                                <label class="custom-control-label" for="customRadio2">Expired</label>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                <input v-if="!addLoader" type="submit" value="Submit" class="btn btn-primary pull-right"/>
                <button v-if="addLoader" class="btn btn-primary pull-right" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Submitting...
                </button>
                <button v-if="!addLoader"  @click.prevent="close" class="btn btn-success pull-right" style="margin-right:5px;">Close</button>
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
import axios from 'axios'
import Vue from 'vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate)

import { ADD_PROJECT_CATEGORY} from "../../store/action.type"
// import { ADD_CONTACT_LOADER} from "../../store/mutation.type"
import { mapState,mapGetters } from "vuex"

export default {
    data(){
        return{
            largeModal:false,
            addLoader:false,
            newCategory:{
                name:'',
                status:1
            }
        }
    },
    methods:{
        
        addCategory () {
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.newCategory
                    this.addLoader = true
                    this.$store.dispatch('ADD_PROJECT_CATEGORY',data)
                    .then(response=>{
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Category Added Successsfully"})
                        
                    })
                    .catch(error=>{
                        this.addLoader = false; 
                        this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
                    });
                }
                
            })
            
        },
        openModal(){
            this.largeModal = true
            this.newCategory.name =''
        },
        close(){
            this.largeModal = false
        }

    },

}
</script>

<style>

</style>
