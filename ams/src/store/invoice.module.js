import axios from "axios"
import { ALL_INVOICE,ADD_INVOICE,UPDATE_INVOICE,DELETE_INVOICE,SEARCH_INVOICE} from "./action.type"
import { AFTER_ADD_INVOICE,SET_INVOICE,AFTER_UPDATE_INVOICE,AFTER_DELETE_INVOICE} from "./mutation.type"
const state = {
    invoice:[],
    invoice2:[]
}

const getters = {
    invoices(state){
        return state.invoice
    },
    invoices2(state){
        return state.invoice2
    }

}
const actions = {
    [ADD_INVOICE]({commit},data) {
        console.log(data);
        return new Promise((resolve, reject) => {
            axios
            .post("/invoice",data)
            .then(response => {
                commit(AFTER_ADD_INVOICE,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_INVOICE]({commit},page) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/invoices?page=' + page)
            .then(response => {
                commit(SET_INVOICE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [SEARCH_INVOICE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/invoices?page=' + data.page,data.data)
            .then(response => {
                commit(SET_INVOICE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [UPDATE_INVOICE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("/invoice",data.data)
            .then(response => {
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_INVOICE",{update_data,index});
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_INVOICE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/invoice/"+data.id)
            .then(response => {
                commit("AFTER_DELETE_INVOICE",data.index);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    }
    
}

const mutations = {
    [SET_INVOICE](state, data) 
    {
        state.invoice = data.data;
        state.invoice2 = data;
    },
    [AFTER_ADD_INVOICE](state, data) 
    {
        state.invoice.unshift(data);
    },
    [AFTER_UPDATE_INVOICE](state,payload){
        state.invoice.splice(payload.index,0,payload.update_data)
        state.invoice.splice(payload.index+1,1)
    },
    [AFTER_DELETE_INVOICE](state,index){
        state.invoice.splice(index,1)
    }
    
}
export default {
    state,
    actions,
    mutations,
    getters
};