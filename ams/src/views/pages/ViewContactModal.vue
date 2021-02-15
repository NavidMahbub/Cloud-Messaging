<template>
    <b-modal title="Contact"   no-close-on-backdrop hide-footer size="xl" v-model="largeModal" @ok="largeModal = false">
        <form>
            <div class="form-group row">
                <div class="col-sm-6">
                    <p><b>Name:</b> {{contact.name}}</p>
                </div>
                <div class="col-sm-6">
                    <p v-if="contact.agent"><b>Agent:</b> {{contact.agent}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Type:</b>
                        {{contact.type == 1 ? 'Client':''}}
                        {{contact.type == 2 ? 'Agent':''}}
                        {{contact.type == 3 ? 'Employee':''}}
                        {{contact.type == 4 ? 'Vendor':''}}
                        {{contact.type == 5 ? 'Unknown':''}}
                    </p>
                </div>
                <div class="col-sm-6">
                    <img height="120px;" :src="contact.image" alt="">
                </div>
                <div class="col-sm-6">
                    <p><b>District:</b> {{contact.district_name}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Subdistric:</b> {{contact.subdistrict_name}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Designation:</b> {{contact.designation}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Father Name:</b> {{contact.father_name}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Mother Name:</b> {{contact.mother_name}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Spouse Name:</b> {{contact.spouse_name}}</p>
                </div>
                <div class="col-sm-6">
                     <p><b>Area Code:</b> {{contact.area_code}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Mobile Number:</b> {{contact.mobile_number}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Contact Number:</b> {{contact.contact_number}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Email:</b> {{contact.email}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Occupation:</b> {{contact.occupation}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Nid:</b> {{contact.nid}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Birthday:</b> {{contact.birthday}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Ward/Union:</b> {{contact.ward_union}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Area/Village:</b> {{contact.area_village}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Street/Para:</b> {{contact.street_para}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Post Office:</b> {{contact.post_ofiice}}</p>
                </div>
                
                <div class="col-sm-6">
                    <p><b>Created By:</b> {{contact.created_by}}</p>
                </div>
                <div class="col-sm-6">
                    <p><b>Updated By:</b> {{contact.updated_by}}</p>
                </div>
            </div>
        </form>
    </b-modal>
</template>

<script>
export default {
    data(){
        return{
            largeModal:false,
            contact:'',
        }
    },
    methods:{
        openModal(contact){
            this.largeModal = true
            this.contact = contact
        }
    }

}
</script>

<style>

</style>
