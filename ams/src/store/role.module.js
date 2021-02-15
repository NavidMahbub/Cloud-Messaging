import axios from "axios"
import { ALL_USER_ROLE,ALL_USER_ROLE2,ADD_USER_ROLE,UPDATE_USER_ROLE,DELETE_USER_ROLE,ALL_USER_ROLE_INFO,UPDATE_ASSIGN_USER_ROLE} from "./action.type"
import { AFTER_ADD_USER_ROLE,SET_USER_ROLE,SET_USER_ROLE2,AFTER_UPDATE_USER_ROLE,AFTER_DELETE_USER_ROLE,SET_USER_ROLE_INFO,AFTER_UPDATE_ASSIGN_USER_ROLE } from "./mutation.type"
const state = {
    user_role:[],
    user_role2:[],
    user_role_info:[],
    permission:[],
    user:{},

}

const getters = {
    user_roles(state){
        return state.user_role
    },
    user_roles2(state){
        return state.user_role2
    },
    user_role_infos(state){
        return state.user_role_info
    },
    user(state){
        return state.user;
    }
}

const actions = {
    [ADD_USER_ROLE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post("/role",data)
            .then(response => {
                commit(AFTER_ADD_USER_ROLE,response.data)
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_USER_ROLE]({commit}) {
        return new Promise((resolve, reject) => {
            axios
            .get("api/user-role")
            .then(response => {
                commit(SET_USER_ROLE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_USER_ROLE2]({commit}) {
        return new Promise((resolve, reject) => {
            axios
            .get("api/user-role2")
            .then(response => {
                commit(SET_USER_ROLE2,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_USER_ROLE_INFO]({commit}) {
        return new Promise((resolve, reject) => {
            axios
            .get("api/assign-role")
            .then(response => {
                commit(SET_USER_ROLE_INFO,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },

    [UPDATE_USER_ROLE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("/role",data.data)
            .then(response => {
                console.log(response)
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_USER_ROLE",{update_data,index});
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [UPDATE_ASSIGN_USER_ROLE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("/api/assign-role",data.data)
            .then(response => {
                var update_data = response.data[0]
                var index = data.index
                commit("AFTER_UPDATE_ASSIGN_USER_ROLE",{update_data,index});
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_USER_ROLE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/role/"+data.id)
            .then(response => {
                commit("AFTER_DELETE_USER_ROLE",data.index);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_USER_ROLE](state, data) 
    {
        state.user_role = data;
    },
    [SET_USER_ROLE2](state,data) 
    {
        state.user_role2 = data;
        state.user = data;
    },
    [SET_USER_ROLE_INFO](state, data) 
    {
        state.user_role_info = data;
    },
    [AFTER_ADD_USER_ROLE](state, data) 
    {
        state.user_role.unshift(data);
    },
    [AFTER_UPDATE_USER_ROLE](state,payload){
        state.user_role.splice(payload.index,0,payload.update_data)
        state.user_role.splice(payload.index+1,1)
    },
    [AFTER_DELETE_USER_ROLE](state,index){
        state.user_role.splice(index,1)
    },
    [AFTER_UPDATE_ASSIGN_USER_ROLE](state,payload){
        
        state.user_role_info.splice(payload.index,0,payload.update_data)
        state.user_role_info.splice(payload.index+1,1)
    },
    
    
}
export default {
    state,
    actions,
    mutations,
    getters
};