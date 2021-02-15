import axios from "axios"
import { ALL_EXPENSE,ADD_EXPENSE,UPDATE_EXPENSE,DELETE_EXPENSE,SEARCH_EXPENSE} from "./action.type"
import { AFTER_ADD_EXPENSE,SET_EXPENSE,AFTER_UPDATE_EXPENSE,AFTER_DELETE_EXPENSE } from "./mutation.type"
const state = {
    expense:[],
    p_expense:[]
}

const getters = {
    expenses(state){
        return state.expense
    },
    expenses2(state){
        return state.p_expense
    }

}

const actions = {
    [ADD_EXPENSE]({commit},data) {
        console.log(data)
        return new Promise((resolve, reject) => {
            axios
            .post("/expense",data)
            .then(response => {
                commit(AFTER_ADD_EXPENSE,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_EXPENSE]({commit},page) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/expenses?page=' + page)
            .then(response => {
                commit(SET_EXPENSE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [SEARCH_EXPENSE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/expenses?page=' + data.page,data.data)
            .then(response => {
                commit(SET_EXPENSE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [UPDATE_EXPENSE]({commit},data) {
        console.log(data)
        return new Promise((resolve, reject) => {
            axios
            .put("/expense",data.data)
            .then(response => {
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_EXPENSE",{update_data,index});
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_EXPENSE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/expense/"+data.id)
            .then(response => {
                commit("AFTER_DELETE_EXPENSE",data.index);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_EXPENSE](state, data) 
    {
        state.expense = data.data;
        state.p_expense = data;
    },
    [AFTER_ADD_EXPENSE](state, data) 
    {
        state.expense.unshift(data);
    },
    [AFTER_UPDATE_EXPENSE](state,payload){
        state.expense.splice(payload.index,0,payload.update_data)
        state.expense.splice(payload.index+1,1)
    },
    [AFTER_DELETE_EXPENSE](state,index){
        state.expense.splice(index,1)
    }  
    
}
export default {
    state,
    actions,
    mutations,
    getters
};