<template>
    <b-modal title="Purpose" no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="addPurpose">
            <div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Parent Account</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select @change="getAccountType" v-validate="'required'"  name="Parent Account" v-model="parent_account_id"  class="form-control" >
                                <option value="" >Select Parent Account</option>
                                <option  v-for="(parentAccount,index) in parentAccounts" :key="index" :value="parentAccount.id">{{parentAccount.name}}</option>
                            </select>
                            <span v-if="parentAccounts.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Parent Account')" style="color:red">* {{ errors.first('Parent Account') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Account Type</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <select v-validate="'required'" name="Account Type" v-model="newPurpose.account_type_id"  class="form-control" >
                                <option value="" >Select Account Type</option>
                                <option  v-for="(accountType,index) in accountTypes" :key="index" :value="accountType.id">{{accountType.name}}</option>
                            </select>
                            <span v-if="accountTypes.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                                <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                            </span>
                        </div>
                        <p  v-show="errors.has('Account Type')" style="color:red">* {{ errors.first('Account Type') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-4">
                    <input v-validate="'required'" name="Name" v-model="newPurpose.name" type="text" class="form-control" id="inputPassword3" placeholder="Purpose Name">
                        <p  v-show="errors.has('Name')" style="color:red">* {{ errors.first('Name') }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea v-model="newPurpose.description" type="text" class="form-control" id="inputPassword3" placeholder="Description" cols="30" rows="5"></textarea>
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
import Vue from 'vue'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate)
import { ADD_PROJECT,All_PROJECT_CATEGORY,All_PARENT_ACCOUNT,ALL_ACCOUNT_TYPE} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
    data(){
        return{
            largeModal:false,
            addLoader:false,
            parent_account_id:'',
            newPurpose:{
                name:'',
                account_type_id:'',
                decription:''
            }
        }
    },
    methods:{
        openModal(){
            this.largeModal = true
        },
        addPurpose(){
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.newPurpose
                    this.addLoader = true
                    this.$store.dispatch('ADD_PURPOSE',data)
                    .then(response=>{
                        this.addLoader = false;
                        this.largeModal = false
                        this.$iziToast.success({position:'topRight',title:'Ok',message:"Purpose Added Successsfully"})
                        
                    })
                    .catch(error=>{
                        this.addLoader = false; 
                        this.$iziToast.error({position:'topRight',title:'Error',message:"Something Wrong !!"})       
                    });
                }
                
            })
        },
        allPrentAccount(){
            this.$store.dispatch('ALL_PARENT_ACCOUNT')
        },
        getAccountType(){
            this.$store.dispatch('ALL_ACCOUNT_TYPE',this.parent_account_id)
        },
        close(){
            this.largeModal = false
        }
    },
    mounted(){
        this.allPrentAccount()
    },
    computed:{
        ...mapGetters(["parentAccounts","accountTypes"]),
        
    }
}
</script>

<style>
#preview {
        height: 120px;
        width: 70%;
    }
    #preview img{
        height: 100%;
        width: 100%;
    }
</style>
