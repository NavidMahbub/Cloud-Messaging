<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <b-form @submit.prevent="SubmitCode">
                <h1>Submit</h1>
                <p class="text-muted">Submit your code</p>
                <b-input-group class="mb-3">
                  <b-form-input v-validate="'required'" data-vv-as="text" name="sms_code"  v-model="forgot.code" type="text" class="form-control" placeholder="Code" />
                </b-input-group>
                <p style="color:red !important" v-if="errors.has('sms_code')" class="text-muted">* {{ errors.first('sms_code') }}</p>
                <b-button v-if="! loader" type="submit" variant="primary" class="px-4"><i v-if="check" class="fa fa-check"></i> Submit</b-button>
                      <button v-if="loader" class="btn btn-primary " type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        code Submitting...
                    </button>
              </b-form>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Vue from 'vue'
import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)
import {FORGOT_USER} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
  name: 'SmsCodeSubmit',
  data(){
    return{
      forgot:{
        code:'',
        mobile: this.$route.query.mobile,
      },
      loader:false,
      check:false,
      get_url:''
    }
  },
  methods:{
    SubmitCode(){
      this.$validator.validateAll().then( result =>{
          if(result){
            var data = this.forgot
            this.loader=true
            axios.post("/api/code-check",data)
            .then(response=>{ 
                this.loader=false
                this.check=true
                this.get_url = response.data.url;
                window.location = this.get_url;
            })
            .catch(error=>{
                this.loader=false
                this.check=false      
            });
          }  
      })
    }
  },
  computed:{
        ...mapGetters(["forgotPasswordNotification"])
  }
}
</script>
