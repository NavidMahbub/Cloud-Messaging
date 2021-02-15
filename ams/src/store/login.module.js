import axios from "axios"
import { LOGIN_USER,AUTH_USER} from "./action.type"
import { SET_LOGIN_NOTIFIACTION,SET_USER_INFO,SET_AUTH_USER} from "./mutation.type"
import Vue from 'vue'
import Auth from '../packages/Auth'
import router from '../router'
Vue.use(Auth)
let auth = new Vue()
const state = {
    loginNotification:'',
    userinfo:{},
    authuser:{},
}

const getters = {
    authuser(state){
        return state.authuser
    },
    userinfo(state){
        return state.userinfo
    },
    loginNotification(state){
        return state.loginNotification
    }
}

const actions = {
    [LOGIN_USER]({commit},data) {
        return new Promise((resolve, reject) => {
            axios.post("api/login",data)
            .then(response => {
                auth.$auth.setToken(response.data.access_token, Date.parse(response.data.expires_at.date))
                axios.defaults.headers.common["Authorization"] = 'Bearer '+ response.data.access_token
                router.push("/dashboard")
                commit(SET_USER_INFO,response.data);
                resolve(response)
            })
            .catch(error => {
                commit(SET_LOGIN_NOTIFIACTION,error.response.data)
                reject(error)
            });
        });
    },
    [AUTH_USER]({commit}) {
        return new Promise((resolve, reject) => {
            axios.get("api/user/info")
            .then(response => {
                commit(SET_AUTH_USER,response.data);
                resolve(response)
            })
            .catch(error => {
                reject(error)
            });
        });
    },
    
}

const mutations = {
    [SET_LOGIN_NOTIFIACTION](state,payload){
        state.loginNotification = payload
    }, 
    [SET_USER_INFO](state,data){
        state.userinfo = data;
    },
    [SET_AUTH_USER](state,data){
        state.authuser = data;
    }

}
export default {
    state,
    actions,
    mutations,
    getters
};