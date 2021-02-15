<template>
    <b-modal title="Contact" no-close-on-backdrop hide-footer size="xl"  v-model="modalOperate" @ok="largeModal = false">
        <form @submit.prevent="addContact">
            <div  class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">District {{modalOperate}} </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <select v-validate="'required'" name="District" @change="getSubdistrict" v-model="newContact.district_id" class="form-control" >
                            <option value="" >Select District</option>
                            <option v-for="(district,index) in districts" :key="index" :value="district.id">{{district.name}}</option>
                        </select>
                        <span v-if="districtLoader" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                            <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                        </span>
                    </div>
                    <p v-show="errors.has('District')"  style="color:red">* {{ errors.first('District') }}</p>
                </div>
            
                <label for="inputPassword3" class="col-sm-2 col-form-label">Subdistrict</label>
                <div class="col-sm-4 ">
                    <div class="input-group">
                        <select  v-validate="'required'" name="Subdistrict" v-model="newContact.subdistrict_id"  id="inputState" class="form-control" >
                            <option value="" >Select Subdistrict</option>
                            <option v-for="(subdistrict,index) in subdistricts" :key="index" :value="subdistrict.id">{{subdistrict.name}}</option>
                        </select>
                        <span v-if="subdistrictLoader" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                            <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                        </span>
                    </div>
                    <p v-show="errors.has('Subdistrict')"  style="color:red">* {{ errors.first('Subdistrict') }}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-4">
                    <select name="Type" @change="agentAdd" v-validate="'required'"  v-model="newContact.type" id="inputState" class="form-control" >
                        <option value="" >Select Type</option>
                        <option value="1">Client</option>
                        <option value="2">Agent</option>
                        <option value="4">Company</option>
                        <!-- <option value="3">Land Owner</option>
                        
                        <option value="5">Unknown</option> -->
                    </select>
                    <p v-show="errors.has('Type')"  style="color:red">* {{ errors.first('Type') }}</p>
                </div>
                <label  class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-4">
                    <div v-if="url" class="image_upload logo_upload">
                        <span class="removeImage" @click="RemoveImage">X</span>
                        <img  :src="url" class="fitimage">
                    </div>
                    <div v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
                        <p>Choose Image</p> <i class="fa fa-cloud-upload-alt"></i>
                        <input  type="file" ref="ImageFile" class="file-input" style="display: none" v-on:change="imageChanged">
                    </div>
                </div>
                    
                    
                <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-4">
                    <select name="Role" v-validate="'required'"  v-model="newContact.role_id" id="inputState" class="form-control" >
                        <option value="" >Select Role</option>
                        <option v-for="(user_role,index) in user_roles" :key="index" :value="user_role.id">{{user_role.name}}</option>
                    </select>
                    <p v-show="errors.has('Role')"  style="color:red">* {{ errors.first('Role') }}</p>
                </div> -->
                <!-- <label v-if="agent" for="inputPassword3" class="col-sm-2 col-form-label">Select Agent</label>
                <div v-if="agent" class="col-sm-4">
                    <div class="input-group">
                        <select name="Agent" v-model="newContact.agent_id" v-validate="'required'" class="form-control" >
                            <option value="" >Select Agent</option>
                            <option v-for="(specificContact,index) in specificContacts" :key="index" :value="specificContact.id">{{specificContact.name}}</option>
                        </select>
                        <span v-if="specificContacts.length <= 0" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                            <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                        </span>
                    </div>
                    <p v-show="errors.has('Agent')"  style="color:red">* {{ errors.first('Agent') }}</p>
                </div> -->
            </div>
            
            <div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-4">
                        <input name="Name" v-validate="'required'"   type="text"  v-model="newContact.name" class="form-control" id="inputPassword3" placeholder="Name">
                        <p v-show="errors.has('Name')"  style="color:red">* {{ errors.first('Name') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                    <input @keydown="errorClear('email')" type="text" v-validate="'required|email'" data-vv-as="email" name="email_field"  v-model="newContact.email" class="form-control" id="inputPassword3" placeholder="Email">
                    <p v-show="errors.has('email_field')"  style="color:red">* {{ errors.first('email_field') }}</p>
                    <p style="color:red;" v-for="(servererror,k) in servererrors.email" v-bind:key="'e'+k">{{servererror}}</p>
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.contact_number" class="form-control" id="inputPassword3" placeholder="Contact Number">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mobile Number</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.mobile_number" class="form-control" id="inputPassword3" placeholder="Mobile Number">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Company Name</label>
                    <div class="col-sm-4">
                        <input type="text" v-model="newContact.company_name" class="form-control" id="inputPassword3" placeholder="Company Name">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Designation</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.designation" class="form-control" id="inputPassword3" placeholder="Designation">
                    </div>
                    
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Occupation</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.occupation" class="form-control" id="inputPassword3" placeholder="Occupation">
                    </div>
                    
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Father Name</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.father_name" class="form-control" id="inputPassword3" placeholder="Father Name">
                    </div>
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Mother Name</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.mother_name" class="form-control" id="inputPassword3" placeholder="Father Name">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">NID</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.nid" class="form-control" id="inputPassword3" placeholder="NID">
                    </div>

                    <label for="inputPassword3" class="col-sm-2 col-form-label">Birthday</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.birthday" class="form-control" id="inputPassword3" placeholder="Birthday">
                    </div>
                    
                </div>
                <div  class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Spouse Name</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.spouse_name" class="form-control" id="inputPassword3" placeholder="Spouse Name">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Area Code</label>
                    <div class="col-sm-4">
                    <input type="number" v-model="newContact.area_code" class="form-control" id="inputPassword3" placeholder="Area Code">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Ward/Union</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.ward_union" class="form-control" id="inputPassword3" placeholder="Ward/Union">
                    </div>

                    <label for="inputPassword3" class="col-sm-2 col-form-label">Area/Village</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.area_village" class="form-control" id="inputPassword3" placeholder="Area/Village">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Street/Para</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.street_para" class="form-control" id="inputPassword3" placeholder="Street/Para">
                    </div>
                    
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Post Ofiice</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="newContact.post_ofiice" class="form-control" id="inputPassword3" placeholder="Post Ofiice">
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                <input type="submit" value="submit" v-if="!addContactLoader"  class="btn btn-primary pull-right">
                <button v-if="! addContactLoader" @click.prevent="close" class="btn btn-success pull-right" style="margin-right:5px;">Close</button>
                <button v-if="addContactLoader" class="btn btn-primary pull-right" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Submitting...
                </button>
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

import { ADD_CONTACT,ALL_DISTRICT ,ALL_SUBDISTRICT,OPEN_CONTACT_MODAL,CLOSE_CONTACT_MODAL,ALL_USER_ROLE,ALL_CONTACT} from "../../store/action.type"
import { ADD_CONTACT_LOADER} from "../../store/mutation.type"
import { mapState,mapGetters } from "vuex"
export default {
    data(){
        return{
            servererrors:{},
            agent:false,
            addContactLoader:false,
            specificContacts:[],
            url:'',
            newContact:{
                role_id:'',
                type:'',
                name: '',
                designation:'',
                father_name:'',
                mother_name:'',
                spouse_name:'',
                area_code:'',
                mobile_number:'',
                contact_number:'',
                email: '',
                occupation:'',
                nid:'',
                birthday:'',
                district_id:'',
                subdistrict_id:'',
                ward_union:'',
                area_village:'',
                street_para:'',
                post_ofiice:'',
                company_name:'',
                agent_id:'',
                image:'',
                not_edit_image:10
            }
        }
    },
    methods:{
        imageChanged(e) {
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
                this.newContact.image = e.target.result
                this.newContact.not_edit_image = 11
            }
            this.url = URL.createObjectURL(e.target.files[0]);
        },
        RemoveImage: function () {
                this.newContact.image = '';
                this.newContact.not_edit_image = 10;
                this.url = '';
        },
        errorClear(fields)
        {
            delete this.servererrors[fields];
        },
        close(){
            this.$store.dispatch(CLOSE_CONTACT_MODAL)
        },
        addContact () {
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.newContact
                    this.addContactLoader = true;
                    this.$store.dispatch('ADD_CONTACT',data)
                    .then(response=>{
                        this.addContactLoader=false;
                    })
                    .catch(error=>{
                        this.addContactLoader=false;  
                        this.servererrors = error.response.data.errors;    
                    });
                }
                
            })
            
        },
        clearInput(){
            this.newContact.type = ''
            this.newContact.agent_id = ''
            this.newContact.post_ofiice = ''
            this.newContact.company_name = ''
            this.newContact.street_para = ''
            this.newContact.ward_union = ''
            this.newContact.area_village = ''
            this.newContact.subdistrict_id = ''
            this.newContact.district_id = ''
            this.newContact.birthday = ''
            this.newContact.occupation = ''
            this.newContact.contact_number = ''
            this.newContact.mobile_number = ''
            this.newContact.area_code = ''
            this.newContact.spouse_name = ''
            this.newContact.mother_name = ''
            this.newContact.father_name = ''
            this.newContact.designation = ''
            this.newContact.name = ''
            this.newContact.email = ''
        },
        openModal(){
            this.$store.dispatch(OPEN_CONTACT_MODAL)
            this.clearInput()
        },
        getSubdistrict(){
            this.$store.dispatch('ALL_SUBDISTRICT',this.newContact.district_id)
        },
        allDistrict(){
            this.$store.dispatch('ALL_DISTRICT')
        },
        allRole(){
            this.$store.dispatch('ALL_USER_ROLE')
        },
        agentAdd(){
            if(this.newContact.type ==1 || this.newContact.type == 3){
                this.agent = true
                return new Promise((resolve, reject) => {
                    var type = 2
                    axios.get("api/specific/contacts/"+type)
                    .then(response => {
                        this.specificContacts = response.data
                        resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    });
                });
            }
            else{
                this.agent = false
            }
        }
    },
    mounted(){
        this.allDistrict()
        this.allRole()
    },
    computed:{
        ...mapGetters(["districts","subdistricts","districtLoader","subdistrictLoader","modalOperate","user_roles"]),
        modalOperate: {
            get () {
                return this.$store.getters.modalOperate
            },
            set (value) {
                this.$store.commit('SET_CONTACT_MODAL', value)
            }
        }
    }

}
</script>

<style>
.custom_modal_body{
    overflow: auto;
    min-height: 380px;
}
.logo_upload{
    border: 1px solid #ccc;
    width: 100%;
    height: 90px;
    background: #eceef0;
    text-align: center;
    cursor: pointer;
}
.image_upload p{
    margin-top: 10px;
    font-size: 12px;
}

.image_upload i{
    font-size: 34px;
}
.removeImage{
   position: absolute;
    right: 13px;
    top:  14px;
    color: var(--white);
    border: 1px solid;
    border-radius: 25px;
    padding: 4px 8px;
    background-color: #fb1212f5;
    font-size: 10px;
    font-family: cursive;
}
.fitimage {
    width: 32%;
    height: 100%;
    -o-object-fit: contain;
    object-fit: contain;
    background-color: #e6e6ef;
}
</style>
