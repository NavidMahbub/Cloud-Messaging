<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <b-form @submit.prevent="Register">
                <h1>Register</h1>
                <p class="text-muted">Create your account</p>
                <div v-if="registerNotification.error" class="help-block alert alert-danger">
                  <p>{{registerNotification.error}}</p>  
                </div>
                <div v-if="registerNotification.success" class="help-block alert alert-success">
                  <p>{{registerNotification.success}}</p>  
                </div>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-user"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input v-validate="'required|min:3|max:20'" data-vv-as="name" name="name_field"  v-model="register.name" type="text" class="form-control" placeholder="name" autocomplete="username" />
                </b-input-group>
                  <p style="color:red !important" v-if="errors.has('name_field')" class="text-muted">* {{ errors.first('name_field') }}</p>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>@</b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input v-validate="'required|email'" data-vv-as="email" name="email_field"  v-model="register.email" type="text" class="form-control" placeholder="Email" autocomplete="email" />
                </b-input-group>
                  <p style="color:red !important" v-if="errors.has('email_field')" class="text-muted">* {{ errors.first('email_field') }}</p>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input name="password" v-validate="'required|min:6|max:15'"  v-model="register.password" type="password" class="form-control" placeholder="Password" ref="password" />
                </b-input-group>
                <p style="color:red !important" v-if="errors.has('password')" class="text-muted">* {{ errors.first('password') }}</p>

                <b-input-group class="mb-4">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input v-validate="'required|confirmed:password'" name="password_confirmation" v-model="register.password2" type="password" class="form-control" placeholder="Repeat password" data-vv-as="password"  />
                </b-input-group>
                <p style="color:red !important" v-if="errors.has('password_confirmation')" class="text-muted">* {{ errors.first('password_confirmation') }}</p>
                
                <b-button v-if="!loader" type="submit" variant="success" block><i v-if="check" class="fa fa-check"></i> Create Account</b-button>
                <b-button v-if="loader" disabled type="submit" variant="success" block><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Create Account</b-button>
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
import {REGISTER_USER} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
  name: 'Register',
  data(){
    return{
      check:false,
      loader:false,
      register:{
        name:'',
        email:'',
        password:'',
      }
    }
  },
  methods:{
    Register(){
      this.$validator.validateAll().then( result =>{
          if(result){
            var data = this.register
            this.loader=true
            this.$store.dispatch('REGISTER_USER',data)
            .then(response=>{
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
        ...mapGetters(["registerNotification"])
  }
}
</script>
