import Vue from "vue"
import Vuex from "vuex"
import contact from "./contact.module"
import districtSubdistrict from "./districtSubdistrict.module"
import projectCategory from "./projectCategory.module"
import project from "./project.module"
import purpose from "./purpose.module"
import income from "./income.module"
import expense from "./expense.module"
import paymentMade from "./paymentMade.module"
import bills from "./bills.module"
import recruiting from "./recruiting.module"
import register from "./register.module"
import login from "./login.module"
import forgotAndResetPassword from "./forgotAndResetPassword.module"
import role from "./role.module"
import rolePermission from "./rolePermission.module"
import leadger from "./leadger.module"
import dashboard from "./dashboard.module"
import invoice from "./invoice.module"
import messaging from "./messaging.module"
import paymentReceive from "./paymentReceive.module"
import installment from "./installment.module"
Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    contact,
    districtSubdistrict,
    projectCategory,
    project,
    messaging,
    purpose,
    income,
    expense,
    recruiting,
    register,
    login,
    forgotAndResetPassword,
    role,
    rolePermission,
    leadger,
    dashboard,
    invoice,
    paymentReceive,
    installment,
    bills,
    paymentMade
  }
})
