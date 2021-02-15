
import axios from "axios"
import iziToast from 'izitoast'


import { BILLS,ADD_BILL,DELETE_BILL } from "./action.type"
import { SET_BILLS,SET_ADD_BILL,SET_DELETE_BILL } from "./mutation.type"

const state = {
    bills: [],
};

const getters = {
    bills(state){
        return state.bills
    },
}

const actions = {
    [BILLS](context,id) {
        return new Promise((resolve, reject) => {
            axios
            .post("/api/bills")
            .then(response => {
                context.commit(SET_BILLS, response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ADD_BILL](context,data) {
        return new Promise((resolve, reject) => {
            if(data.id=='' || data.id==null){
                axios
                .post("/bills",data)
                .then(response => {
                    let response_data = {
                        data:response.data,
                        index:data.index,
                    };
                    context.commit(SET_ADD_BILL,response_data);
                    resolve(response);
                
                })
                .catch(function(error) {
                    reject(error);
                });
            }else{
                axios
                .put("/bills",data)
                .then(response => {
                    let response_data = {
                        data:response.data,
                        index:data.index,
                    };
                    context.commit(SET_ADD_BILL,response_data);
                    resolve(response);
                
                })
                .catch(function(error) {
                    reject(error);
                });
            }
            
        });
    },
    [DELETE_BILL](context,data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/bills/"+data.id)
            .then(response => {
                context.commit(SET_DELETE_BILL,data.index);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
}

const mutations = {
    [SET_BILLS](state, data) 
    {
        state.bills = data
        
    },
    [SET_ADD_BILL](state,data){
        if(data.index==''){
            state.bills.data.push(data.data);
        }else{
            state.bills.data[index](data.data);
        }
       
    },
    [SET_DELETE_BILL](state,index){
        state.bills.data.splice(index,1)
    }
    
};

export default {
    state,
    actions,
    mutations,
    getters
};