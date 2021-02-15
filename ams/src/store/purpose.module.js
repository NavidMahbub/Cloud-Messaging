import axios from "axios"
import {ALL_PARENT_ACCOUNT, ALL_PURPOSE,ADD_PURPOSE,UPDATE_PURPOSE,DELETE_PURPOSE,ALL_ACCOUNT_TYPE,ALL_P_PURPOSE,SEARCH_PURPOSE} from "./action.type"
import { AFTER_ADD_PURPOSE,SET_PURPOSE,AFTER_UPDATE_PURPOSE,AFTER_DELETE_PURPOSE,SET_PARENT_ACCOUNT,SET_ACCOUNT_TYPE,SET_P_PURPOSE } from "./mutation.type"
const state = {
    purpose:[],
    parent_account:[],
    account_type:[],
    p_purpose:[],
    p_purpose2:[],
}

const getters = {
    purposes(state){
        return state.purpose
    },
    parentAccounts(state){
        return state.parent_account
    },
    accountTypes(state){
        return state.account_type
    },
    pPurposes(state){
        return state.p_purpose
    },
    pPurposes2(state){
        return state.p_purpose2
    },
}

const actions = {
    [ALL_PARENT_ACCOUNT]({commit}) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/parent-account")
            .then(response => {
                commit(SET_PARENT_ACCOUNT,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_ACCOUNT_TYPE]({commit},id) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/account-type/"+id)
            .then(response => {
                commit(SET_ACCOUNT_TYPE,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ADD_PURPOSE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post("/purpose",data)
            .then(response => {
                commit(AFTER_ADD_PURPOSE,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_PURPOSE]({commit}) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/purpose")
            .then(response => {
                commit(SET_PURPOSE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_P_PURPOSE]({commit},page) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/purpose/pagination?page=' + page)
            .then(response => {
                commit(SET_P_PURPOSE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [SEARCH_PURPOSE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/purpose/pagination?page=' + data.page,data.data)
            .then(response => {
                commit(SET_P_PURPOSE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [UPDATE_PURPOSE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("/purpose",data.data)
            .then(response => {
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_PURPOSE",{update_data,index});
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_PURPOSE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/purpose/"+data.id)
            .then(response => {
                commit("AFTER_DELETE_PURPOSE",data.index);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_PARENT_ACCOUNT](state, data) 
    {
        state.parent_account = data;
    },
    [SET_ACCOUNT_TYPE](state, data) 
    {
        state.account_type = data;
    },
    [SET_PURPOSE](state, data) 
    {
        state.purpose = data;
    },
    [AFTER_ADD_PURPOSE](state, data) 
    {
        state.purpose.unshift(data);
        state.p_purpose.unshift(data);
    },
    [AFTER_UPDATE_PURPOSE](state,payload){
        state.purpose.splice(payload.index,0,payload.update_data)
        state.purpose.splice(payload.index+1,1)

        state.p_purpose.splice(payload.index,0,payload.update_data)
        state.p_purpose.splice(payload.index+1,1)
    },
    [AFTER_DELETE_PURPOSE](state,index){
        state.purpose.splice(index,1)
        state.p_purpose.splice(index,1)
    },
    [SET_P_PURPOSE](state, data) 
    {
        state.p_purpose = data.data;
        state.p_purpose2 = data;
    },  
}
export default {
    state,
    actions,
    mutations,
    getters
};