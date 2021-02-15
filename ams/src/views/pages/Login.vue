<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="8">
          <b-card-group>
            <b-card no-body class="p-4">
              <b-card-body>
                <b-form @submit.prevent="Login">
                  <h1>Login</h1>
                  <p class="text-muted">Sign In to your account</p>
                  <div v-if="loginNotification.error" class="help-block alert alert-danger">
                    <p>{{loginNotification.error}}</p>  
                  </div>
                  <b-input-group class="mb-3">
                    <b-input-group-prepend><b-input-group-text><i class="icon-user"></i></b-input-group-text></b-input-group-prepend>
                    <b-form-input v-validate="'required'" data-vv-as="email" name="email_field"  v-model="login.email" type="text" class="form-control" placeholder="Email" autocomplete="email" />
                  </b-input-group>
                  <p style="color:red !important" v-if="errors.has('email_field')" class="text-muted">* {{ errors.first('email_field') }}</p>
                  <b-input-group class="mb-4">
                    <b-input-group-prepend><b-input-group-text><i class="icon-lock"></i></b-input-group-text></b-input-group-prepend>
                    <b-form-input name="password" v-validate="'required|min:6|max:15'" v-model="login.password" type="password" class="form-control" placeholder="Password" autocomplete="current-password" />
                  </b-input-group>
                  <p style="color:red !important" v-if="errors.has('password')" class="text-muted">* {{ errors.first('password') }}</p>
                  <b-row>
                    <b-col cols="6">
                      <b-button v-if="! loader" type="submit" variant="primary" class="px-4"><i v-if="check" class="fa fa-check"></i> Login</b-button>
                      <button v-if="loader" class="btn btn-primary " type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Login...
                    </button>
                    </b-col>
                    <b-col cols="6" class="text-right">
                      <router-link :to="{ path: '/forgot-password'}">
                        <b-button variant="link" class="px-0">Forgot password?</b-button>
                      </router-link>
                    </b-col>
                  </b-row>
                </b-form>
              </b-card-body>
            </b-card>
            <b-card no-body class="text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <b-card-body class="text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <router-link :to="{ path: '/register'}">
                    <b-button variant="primary" class="active mt-3">Register Now!</b-button>
                  </router-link>
                </div>
              </b-card-body>
            </b-card>
          </b-card-group>
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
import {LOGIN_USER} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
  name: 'Login',
  data(){
    return{
      loader:false,
      check:false,
      login:{
        email:'',
        password:''
      }
    }
  },
  methods:{
    Login(){
      this.$validator.validateAll().then( result =>{
          if(result){
            var data = this.login
            this.loader=true
            this.$store.dispatch('LOGIN_USER',data)
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
    ...mapGetters(["loginNotification"])
  }
}
</script>
