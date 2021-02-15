import axios from "axios"
import { ALL_INCOME,ADD_INCOME,UPDATE_INCOME,DELETE_INCOME,ALL_ACCOUNT_TYPE2,SEARCH_INCOME} from "./action.type"
import { AFTER_ADD_INCOME,SET_INCOME,AFTER_UPDATE_INCOME,AFTER_DELETE_INCOME,SET_ACCOUNT_TYPE2 } from "./mutation.type"
const state = {
    income:[],
    income2:[],
    accountType:[]
}

const getters = {
    incomes(state){
        return state.income
    },
    incomes2(state){
        return state.income2
    },
    getAccountType(){
        return state.accountType
    }

}

const actions = {
    [ADD_INCOME]({commit},data) {
        console.log(data)
        return new Promise((resolve, reject) => {
            axios
            .post("/income",data)
            .then(response => {
                commit(AFTER_ADD_INCOME,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_INCOME]({commit},page) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/incomes?page=' + page)
            .then(response => {
                commit(SET_INCOME,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [SEARCH_INCOME]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/incomes?page=' + data.page,data.data)
            .then(response => {
                console.log(response)
                commit(SET_INCOME,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [UPDATE_INCOME]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("/income",data.data)
            .then(response => {
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_INCOME",{update_data,index});
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_INCOME]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/income/"+data.id)
            .then(response => {
                commit("AFTER_DELETE_INCOME",data.index);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_ACCOUNT_TYPE2]({commit},id) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/account-type/"+id)
            .then(response => {
                commit(SET_ACCOUNT_TYPE2,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_INCOME](state, data) 
    {
        state.income = data.data;
        state.income2 = data;
    },
    [AFTER_ADD_INCOME](state, data) 
    {
        state.income.unshift(data);
    },
    [AFTER_UPDATE_INCOME](state,payload){
        state.income.splice(payload.index,0,payload.update_data)
        state.income.splice(payload.index+1,1)
    },
    [AFTER_DELETE_INCOME](state,index){
        state.income.splice(index,1)
    },
    [SET_ACCOUNT_TYPE2](state, data) 
    {
        state.accountType = data;
    }, 
    
}
export default {
    state,
    actions,
    mutations,
    getters
};