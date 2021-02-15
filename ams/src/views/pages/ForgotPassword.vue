<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <b-form @submit.prevent="ForgotPassword">
                <h1>Reset</h1>
                <p class="text-muted">Reset your account</p>
                <div v-if="check" class="help-block alert alert-success">
                    <p>Please check your email.</p>  
                  </div>
                <div v-if="forgotPasswordNotification.error" class="help-block alert alert-danger">
                  <p>{{forgotPasswordNotification.error}}</p>  
                </div>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>@</b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input v-validate="'required'" data-vv-as="email" name="email_field"  v-model="forgot.email" type="text" class="form-control" placeholder="Email" autocomplete="email" />
                </b-input-group>
                <p style="color:red !important" v-if="errors.has('email_field')" class="text-muted">* {{ errors.first('email_field') }}</p>
                <b-button v-if="! loader" type="submit" variant="primary" class="px-4"><i v-if="check" class="fa fa-check"></i> Reset Account</b-button>
                      <button v-if="loader" class="btn btn-primary " type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Reset Account...
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
import {FORGOT_USER,CONFIRM_SMS_CODE} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
  name: 'ForgotPassword',
  data(){
    return{
      forgot:{
        email:'',
      },
      loader:false,
      check:false,
      mobile_no:''
    }
  },
  methods:{
    ForgotPassword(){
      this.$validator.validateAll().then( result =>{
          if(result){
            var data = this.forgot
            this.loader=true
            this.$store.dispatch('FORGOT_USER',data)
            .then(response=>{
                this.mobile_no = response.data.user_mobile_no;
                if(this.mobile_no !=null){
                  this.$router.push('/code-submit?mobile='+this.mobile_no)
                } 
                this.loader=false
                this.check=true
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
