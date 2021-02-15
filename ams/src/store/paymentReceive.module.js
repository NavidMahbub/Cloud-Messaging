import axios from "axios"
import {UNPAID_INVOICE,ALL_PAYMENT_RECEIVE,ADD_PAYMENT_RECEIVE,UPDATE_PAYMENT_RECEIVE,DELETE_PAYMENT_RECEIVE} from "./action.type"
import {SET_UNPAID_INVOICE,SET_ADD_PAYMENT_RECEIVE,SET_ALL_PAYMENT_RECEIVE,AFTER_UPDATE_PAYMENT,AFTER_DELETE_PAYMENT} from "./mutation.type"
const state = {
    unpaidInvoices:[],
    paymentreceives:[],

}

const getters = {
    unpaidInvoices(state){
        return state.unpaidInvoices;
    },
    paymentreceives(state){
        return state.paymentreceives;
    }

}
const actions = {
    [UNPAID_INVOICE]({commit},id){
        return new Promise((resolve, reject) => {
            axios
            .get("/api/unpaid/invoice/"+id)
            .then(response => {
                commit(SET_UNPAID_INVOICE,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ADD_PAYMENT_RECEIVE]({commit},data){
        return new Promise((resolve, reject) => {
            axios
            .post("payment-receive",data)
            .then(response => {
                commit(SET_ADD_PAYMENT_RECEIVE,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_PAYMENT_RECEIVE]({commit},data){
        return new Promise((resolve, reject) => {
            axios
            .post("api/payment-receive/all?page="+data.page,data.data)
            .then(response => {
                commit(SET_ALL_PAYMENT_RECEIVE,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [UPDATE_PAYMENT_RECEIVE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("payment-receive",data.data)
            .then(response => {
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_PAYMENT",{update_data,index});
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_PAYMENT_RECEIVE]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("payment-receive/"+data.id)
            .then(response => {
                commit("AFTER_DELETE_PAYMENT",data.index);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    }
}

const mutations = {
    [SET_UNPAID_INVOICE](state, data) 
    {
        state.unpaidInvoices = data;
    },
    [SET_ADD_PAYMENT_RECEIVE](state,data){
        state.paymentreceives.data.unshift(data);
    },
    [SET_ALL_PAYMENT_RECEIVE](state,data){
        state.paymentreceives=data;
    },
    [AFTER_UPDATE_PAYMENT](state,payload){
        state.paymentreceives.data.splice(payload.index,0,payload.update_data)
        state.paymentreceives.data.splice(payload.index+1,1)
    },
    [AFTER_DELETE_PAYMENT](state,index){
        state.paymentreceives.data.splice(index,1)
    }
}
export default {
    state,
    actions,
    mutations,
    getters
};