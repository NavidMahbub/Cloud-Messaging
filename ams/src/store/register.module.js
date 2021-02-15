import axios from "axios"
import { REGISTER_USER } from "./action.type"
import { SET_REGISTER_NOTIFIACTION } from "./mutation.type"
const state = {
    registerNotification:'',
}

const getters = {
    registerNotification(state){
        return state.registerNotification
    },
}

const actions = {
    [REGISTER_USER]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post("/api/registers",data)
            .then(response => {
                commit(SET_REGISTER_NOTIFIACTION,response.data)
                resolve(response)
            })
            .catch(error => {
                commit(SET_REGISTER_NOTIFIACTION,error.response.data)
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_REGISTER_NOTIFIACTION](state,payload){
        state.registerNotification = payload
    } 
}
export default {
    state,
    actions,
    mutations,
    getters
};