
import axios from "axios"
import iziToast from 'izitoast'

import { PAYMENT_MADES,ADD_PAYMENT_MADE,DELETE_PAYMENT_MADE } from "./action.type"
import { SET_PAYMENT_MADES,SET_ADD_PAYMENT_MADE,SET_DELETE_PAYMENT_MADE } from "./mutation.type"

const state = {
    payments: [],
};

const getters = {
    payments(state){
        return state.payments
    },
}

const actions = {
    [PAYMENT_MADES](context,id) {
        return new Promise((resolve, reject) => {
            axios
            .post("/api/payment-mades")
            .then(response => {
                context.commit(SET_PAYMENT_MADES, response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ADD_PAYMENT_MADE](context,data) {
        console.log('datassss');
        console.log(data);
        return new Promise((resolve, reject) => {
            if(data.id=='' || data.id==null){
                axios
                .post("/payment-mades",data)
                .then(response => {
                    let response_data = {
                        data:response.data,
                        index:data.index,
                    };
                   
                    context.commit(SET_ADD_PAYMENT_MADE,response_data);
                
                    resolve(response);
                
                })
                .catch(function(error) {
                    reject(error);
                });
                
            }else{
                axios
                .put("/payment-mades",data)
                .then(response => {
                    let response_data = {
                        data:response.data,
                        index:data.index,
                    };
                    context.commit(SET_ADD_PAYMENT_MADE,response_data);
                    resolve(response);
                
                })
                .catch(function(error) {
                    reject(error);
                });
               
            }
            
        });
    },
    [DELETE_PAYMENT_MADE](context,data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/payment-mades/"+data.id)
            .then(response => {
                context.commit(SET_DELETE_PAYMENT_MADE,data.index);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
}

const mutations = {
    [SET_PAYMENT_MADES](state, data) 
    {
        state.payments = data
        
    },
    [SET_ADD_PAYMENT_MADE](state,data){
        if(data.index=='' || data.index==null){
            state.payments.data.push(data.data);
        }else{
            state.payments.data[index](data.data);
            
        }
       
    },
    [SET_DELETE_PAYMENT_MADE](state,index){
        state.payments.data.splice(index,1)
    }
    
};

export default {
    state,
    actions,
    mutations,
    getters
};