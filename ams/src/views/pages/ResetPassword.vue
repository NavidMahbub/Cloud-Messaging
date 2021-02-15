<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="6" sm="8">
          <b-card no-body class="mx-4">
            <b-card-body class="p-4">
              <b-form @submit.prevent="Reset">
                <h1>Reset Password</h1>
                <p class="text-muted">Reset your password</p>
                <div v-if="resetPasswordNotification.error" class="help-block alert alert-danger">
                  <p>{{resetPasswordNotification.error}}</p>  
                </div>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input name="password" v-validate="'required|min:6|max:15'"  v-model="reset.password" type="password" class="form-control" placeholder="Password" ref="password" />
                </b-input-group>
                <p style="color:red !important" v-if="errors.has('password')" class="text-muted">* {{ errors.first('password') }}</p>

                <b-input-group class="mb-4">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"></i></b-input-group-text>
                  </b-input-group-prepend>
                  <b-form-input v-validate="'required|confirmed:password'" name="password_confirmation" v-model="reset.password2"  type="password" class="form-control" placeholder="Repeat password" data-vv-as="password"  />
                </b-input-group>
                <p style="color:red !important" v-if="errors.has('password_confirmation')" class="text-muted">* {{ errors.first('password_confirmation') }}</p>
                <b-button v-if="! loader" type="submit" variant="primary" class="px-4"><i v-if="check" class="fa fa-check"></i> Reset Password</b-button>
                      <button v-if="loader" class="btn btn-primary " type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Reset Password...
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
import {RESET_USER} from "../../store/action.type"
import { mapState,mapGetters } from "vuex"
export default {
  name: 'ResetPassword',
  data(){
    return{
      loader:false,
      check:false,
      reset:{
        code:this.$route.params.code,
        email:this.$route.params.email,
        password:'',
      }
    }
  },
  methods:{
    Reset(){
      this.$validator.validateAll().then( result =>{
          if(result){SVGComponentTransferFunctionElement
            var data = this.reset
            this.loader=true
            this.$store.dispatch('RESET_USER',data)
            .then(response=>{ 
                this.loader=false
                this.check=true
                this.$router.push("/login")
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
        ...mapGetters(["resetPasswordNotification"])
  }
}
</script>
