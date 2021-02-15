import axios from "axios"
import router from '../router'
import { FORGOT_USER,RESET_USER } from "./action.type"
import { SET_FORGOT_PASSWORD_NOTIFIACTION,SET_RESET_PASSWORD_NOTIFIACTION } from "./mutation.type"
const state = {
    forgotPasswordNotification:'',
    resetPasswordNotification:''
}

const getters = {
    forgotPasswordNotification(state){
        return state.forgotPasswordNotification
    },
    resetPasswordNotification(state){
        return state.resetPasswordNotification
    }
}

const actions = {
    [FORGOT_USER]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post("/api/forgot-password",data)
            .then(response => {
                resolve(response)
            })
            .catch(error => {
                commit(SET_FORGOT_PASSWORD_NOTIFIACTION,error.response.data)
                reject(error)
            });
        });
    },
    [RESET_USER]({commit},data) {
        console.log(data)
        return new Promise((resolve, reject) => {
            axios
            .post("/api/reset-password/"+data.email+"/"+data.code,data)
            .then(response => {
                resolve(response)
            })
            .catch(error => {
                commit(SET_RESET_PASSWORD_NOTIFIACTION,error.response.data)
                reject(error)
            });
        });
    },
    
}

const mutations = {
    [SET_FORGOT_PASSWORD_NOTIFIACTION](state,payload){
        state.forgotPasswordNotification = payload
    } ,
    [SET_RESET_PASSWORD_NOTIFIACTION](state,payload){
        state.resetPasswordNotification = payload
    } 

}
export default {
    state,
    actions,
    mutations,
    getters
};