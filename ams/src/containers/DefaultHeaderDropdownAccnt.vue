<template>
  <AppHeaderDropdown right no-caret>
    <template slot="header">
      {{authuser.name}}
      <img v-if="authuser.image==null || authuser.image==''"
        src="img/avatars/8.jpg"
        class="img-avatar"
        alt="" />
        <img v-else
        :src="authuser.image"
        class="img-avatar"
        alt="" />
    </template>\
    <template slot="dropdown">
      <b-dropdown-header tag="div" class="text-center"><strong>{{authuser.name}}</strong></b-dropdown-header>
      <b-dropdown-item> Profile
      </b-dropdown-item>
      <!--  <b-dropdown-item><i class="fa fa-envelope-o" /> Messages
        <b-badge variant="success">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-tasks" /> Tasks
        <b-badge variant="danger">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-comments" /> Comments
        <b-badge variant="warning">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-header
        tag="div"
        class="text-center">
        <strong>Settings</strong>
      </b-dropdown-header>
      <b-dropdown-item><i class="fa fa-user" /> Profile</b-dropdown-item>
      <b-dropdown-item><i class="fa fa-wrench" /> Settings</b-dropdown-item>
      <b-dropdown-item><i class="fa fa-usd" /> Payments
        <b-badge variant="secondary">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-item><i class="fa fa-file" /> Projects
        <b-badge variant="primary">{{ itemsCount }}</b-badge>
      </b-dropdown-item>
      <b-dropdown-divider />
      <b-dropdown-item></b-dropdown-item>  -->
      <b-dropdown-item @click="logout"><i class="fa fa-lock" /> Logout</b-dropdown-item>
    </template>
  </AppHeaderDropdown>
</template>

<script>
import { HeaderDropdown as AppHeaderDropdown } from '@coreui/vue'
import { AUTH_USER } from "../store/action.type"
import router from '../router'
import { mapState,mapGetters } from "vuex"
export default {
  name: 'DefaultHeaderDropdownAccnt',
  components: {
    AppHeaderDropdown
  },
  data: () => {
    return { itemsCount: 42 }
  },
  computed: {
    ...mapGetters(["user","authuser"]),
  },
  mounted(){
      this.getauthuser()
  },
  methods:{
    logout(){
      this.$auth.destroyToken()
      setTimeout(()=>{
          router.push("/login")
      },500)
    },
    getauthuser() {
      this.$store.dispatch('AUTH_USER')
      .then(response=>{
          
      })
      .catch(error=>{    
      });
    },
  }
}
</script>
