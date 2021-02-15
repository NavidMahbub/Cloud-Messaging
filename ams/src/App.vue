<template>
  <router-view></router-view>
</template>
<script>

import { mapState,mapGetters } from "vuex"
import { ALL_VISA,DELETE_VISA,GETLASTID,ALL_USER_ROLE2,ADD_VISA } from '@/store/action.type';
export default {
  name: 'app',
  mounted(){
  },
  methods:{
    
  }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">
  // CoreUI Icons Set
  @import '~@coreui/icons/css/coreui-icons.min.css';
  /* Import Font Awesome Icons Set */
  $fa-font-path: '~font-awesome/fonts/';
  @import '~font-awesome/scss/font-awesome.scss';
  /* Import Simple Line Icons Set */
  $simple-line-font-path: '~simple-line-icons/fonts/';
  @import '~simple-line-icons/scss/simple-line-icons.scss';
  /* Import Flag Icons Set */
  @import '~flag-icon-css/css/flag-icon.min.css';
  /* Import Bootstrap Vue Styles */
  @import '~bootstrap-vue/dist/bootstrap-vue.css';
  // Import Main styles for this application
  @import 'assets/scss/style';
  @import 'static/toast.min.css';
</style>
