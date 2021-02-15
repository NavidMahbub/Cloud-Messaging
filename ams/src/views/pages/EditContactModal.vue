<template>
    <b-modal title="Employee Edit"  no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form @submit.prevent="updateContact">
            
            <div  class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">District</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <select v-validate="'required'" name="District" @change="getSubdistrict" v-model="editContact.district_id" class="form-control" >
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
                        <select v-validate="'required'" name="Subdistrict" v-model="editContact.subdistrict_id"  class="form-control" >
                            <option value="" >Select Subdistrict</option>
                            <option v-for="(subdistrict,index) in subdistricts"  :key="index+1000" :value="subdistrict.id">{{subdistrict.name}}</option>
                        </select>
                        <span v-if="subdistrictLoader" style="background: #e0ebeb;padding-left:10px;padding-right:10px;" class="input-group-addon">
                            <i style="margin-top:10px;" class="fa fa-refresh fa-spin"></i>
                        </span>
                    </div>
                    <p v-show="errors.has('Subdistrict')"  style="color:red">* {{ errors.first('Subdistrict') }}</p>
                </div>
            </div>
            <div class="form-group row">
                <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-4">
                    <select v-validate="'required'" name="Type" @change="agentAdd" v-model="editContact.type" id="inputState" class="form-control" >
                        <option value="" >Select Type</option>
                        <option value="1">Client</option>
                        <option value="2">Agent</option>
                        <option value="3">Land Owner</option>
                        <option value="4">Vendor</option>
                        <option value="5">Unknown</option>
                    </select>
                    <p v-show="errors.has('Type')"  style="color:red">* {{ errors.first('Type') }}</p>
                </div> -->
                <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-4">
                    <select name="Role" v-validate="'required'"  v-model="editContact.role_id" id="inputState" class="form-control" >
                        <option value="" >Select Role</option>
                        <option v-for="(user_role,index) in user_roles" :key="index" :value="user_role.id">{{user_role.name}}</option>
                    </select>
                    <p v-show="errors.has('Role')"  style="color:red">* {{ errors.first('Role') }}</p>
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
                <!-- <label v-if="agent" for="inputPassword3" class="col-sm-2 col-form-label">Select Agent</label>
                <div v-if="agent" class="col-sm-4">
                    <div class="input-group">
                        <select v-validate="'required'" name="Agent" v-model="editContact.agent_id" class="form-control" >
                            <option value="" >Select Agent</option>
                            <option v-if="contact.id != editContact.contact_id" v-for="(contact,index) in specificContacts" :key="index" :value="contact.id" >{{contact.name}}</option>
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
                        <input name="Name" v-validate="'required'" type="text" v-model="editContact.name" class="form-control" id="inputPassword3" placeholder="Name">
                        <p v-show="errors.has('Name')"  style="color:red">* {{ errors.first('Name') }}</p>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                    <input @keydown="errorClear('email')" name="Email" v-validate="'required|email'" data-vv-as="email" type="text" v-model="editContact.email" class="form-control" id="inputPassword3" placeholder="Email">
                    <p v-show="errors.has('Email')"  style="color:red">* {{ errors.first('Email') }}</p>
                    <p style="color:red;" v-for="(servererror,k) in servererrors.email" v-bind:key="'e'+k">{{servererror}}</p>
                    </div>
                    
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mobile Number</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.mobile_number" class="form-control" id="inputPassword3" placeholder="Mobile Number">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.contact_number" class="form-control" id="inputPassword3" placeholder="Contact Number">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Company Name</label>
                    <div class="col-sm-10">
                    <input type="text" v-model="editContact.company_name" class="form-control" id="inputPassword3" placeholder="Company Name">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Designation</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.designation" class="form-control" id="inputPassword3" placeholder="Designation">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Occupation</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.occupation" class="form-control" id="inputPassword3" placeholder="Occupation">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Father Name</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.father_name" class="form-control" id="inputPassword3" placeholder="Father Name">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mother Name</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.mother_name" class="form-control" id="inputPassword3" placeholder="Father Name">
                    </div>
                </div>
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">NID</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.nid" class="form-control" id="inputPassword3" placeholder="NID">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Birthday</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.birthday" class="form-control" id="inputPassword3" placeholder="Birthday">
                    </div>
                </div> 
                
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Spouse Name</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.spouse_name" class="form-control" id="inputPassword3" placeholder="Spouse Name">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Area Code</label>
                    <div class="col-sm-4">
                    <input type="number" v-model="editContact.area_code" class="form-control" id="inputPassword3" placeholder="Area Code">
                    </div>
                </div>
                
                 
                
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Ward/Union</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.ward_union" class="form-control" id="inputPassword3" placeholder="Ward/Union">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Area/Village</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.area_village" class="form-control" id="inputPassword3" placeholder="Area/Village">
                    </div>
                </div> 
                <div  class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Street/Para</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.street_para" class="form-control" id="inputPassword3" placeholder="Street/Para">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Post Ofiice</label>
                    <div class="col-sm-4">
                    <input type="text" v-model="editContact.post_ofiice" class="form-control" id="inputPassword3" placeholder="Post Ofiice">
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                <input type="submit" value="Update" v-if="! updateContactLoader"  class="btn btn-primary pull-right">
                <button v-if="! updateContactLoader" @click.prevent="close" class="btn btn-success pull-right" style="margin-right:5px;">Close</button>
                <button v-if="updateContactLoader" class="btn btn-primary pull-right" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Updating...
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

import { ADD_CONTACT,ALL_DISTRICT ,ALL_SUBDISTRICT,UPDATE_CONTACT,ALL_CONTACT,ALL_USER_ROLE} from "../../store/action.type"
import { UPDATE_CONTACT_LOADER,SET_CONTACT_MODAL2} from "../../store/mutation.type"
import { mapState,mapGetters } from "vuex"
export default {
    data(){
        return{
            servererrors:{},
            specificContacts:[],
            id2:2,
            largeModal:false,
            updateContactLoader:false,
            agent:false,
            contact:'',
            index:'',
            editContact:{
                role_id:'',
                old_role_id:'',
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
                contact_id:'',
                image:'',
            },
            url:'',
        }
    },
    methods:{
        imageChanged(e) {
            // console.log(e.target.files[0])
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
                this.editContact.image = e.target.result
                this.editContact.not_edit_image = 11
            }
            this.url = URL.createObjectURL(e.target.files[0])
            
        },
        RemoveImage: function () {
                this.editContact.image = '';
                this.editContact.not_edit_image = 10;
                this.url = '';
        },
        close(){
            this.largeModal = false
        },
        errorClear(fields)
        {
            delete this.servererrors[fields];
        },
        updateContact () {
            this.$validator.validateAll().then( result =>{
                if(result){
                    var data = this.editContact
                    var index = this.index
                    this.updateContactLoader = true;
                    this.$store.dispatch('UPDATE_CONTACT',{data,index})
                    .then(response=>{
                        this.updateContactLoader=false;
                        this.largeModal = false
                    })
                    .catch(error=>{
                        this.updateContactLoader=false; 
                        this.servererrors = error.response.data.errors;     
                    });
                }
                
            }) 
        },
        openEditModal(contact,index){
            this.largeModal = true
            this.editContact.old_role_id = contact.role_id
            this.editContact.role_id = contact.role_id
            this.editContact.name = contact.name
            this.editContact.district_id = contact.district_id
            this.editContact.subdistrict_id = contact.subdistrict_id
            this.editContact.type = contact.type
            this.editContact.designation = contact.designation
            this.editContact.father_name = contact.father_name
            this.editContact.mother_name = contact.mother_name
            this.editContact.spouse_name = contact.spouse_name
            this.editContact.area_code = contact.area_code
            this.editContact.mobile_number = contact.mobile_number
            this.editContact.contact_number = contact.contact_number
            this.editContact.email = contact.email
            this.editContact.occupation = contact.occupation
            this.editContact.nid = contact.nid
            this.editContact.birthday = contact.birthday
            this.editContact.ward_union = contact.ward_union
            this.editContact.area_village = contact.area_village
            this.editContact.street_para = contact.street_para
            this.editContact.post_ofiice = contact.post_ofiice
            this.editContact.company_name = contact.company_name
            this.editContact.contact_id = contact.contact_id
            this.index = index
            this.url = contact.image
            this.editContact.image = contact.image
            this.$store.dispatch('ALL_SUBDISTRICT',contact.district_id)
            if(contact.type ==1 || contact.type ==3){
                this.agent = true
                this.editContact.agent_id = contact.agent_id
            }
            else{
                this.agent = false
            }
        },
        getSubdistrict(){
            this.$store.dispatch('ALL_SUBDISTRICT',this.editContact.district_id)
        },
        allDistrict(){
            this.$store.dispatch('ALL_DISTRICT')
        },
        allRole(){
            this.$store.dispatch('ALL_USER_ROLE')
        },
        specificContact(){
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
        },
        agentAdd(){
            if(this.editContact.type == 1 || this.editContact.type == 3){
                this.agent = true
            }
            else{
                this.agent = false
            }
        }
    },
    mounted(){
        this.allDistrict()
        this.allRole()
        this.specificContact()
    },
    computed:{
        ...mapGetters(["districts","subdistricts","districtLoader","subdistrictLoader","allContacts","user_roles"])
    }

}
</script>

<style>
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
