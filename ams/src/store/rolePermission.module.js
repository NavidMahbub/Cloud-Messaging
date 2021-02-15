import axios from "axios"
import { ROLE_PERMISSION,ROLE_PERMISSION_UPDATE} from "./action.type"
import { AFTER_UPDATE_ROLE_PERMISSION,SET_ROLE_PERMISSION } from "./mutation.type"
const state = {
    role_permission:''
}

const getters = {
    role_permission(state){
        return state.role_permission
    }
}

const actions = {
    [ROLE_PERMISSION_UPDATE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post("/api/role-permission",data)
            .then(response => {
                var data = response.data
                console.log(data)
                commit("AFTER_UPDATE_ROLE_PERMISSION",data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ROLE_PERMISSION]({commit},id) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/role-permission/"+id)
            .then(response => {
                var data = response.data
                commit("SET_ROLE_PERMISSION",data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_ROLE_PERMISSION](state, data) 
    {
        state.role_permission = data;
    },
    [AFTER_UPDATE_ROLE_PERMISSION](state,data){
        state.role_permission = data;
    } 
}
export default {
    state,
    actions,
    mutations,
    getters
};