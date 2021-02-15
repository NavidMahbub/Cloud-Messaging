
import axios from "axios"
import iziToast from 'izitoast'

import { ALL_VISA,ADD_VISA,DELETE_VISA,GETLASTID,CUSTOMER_VISA } from "./action.type"
import { SET_ALL_VISA,SET_ADD_VISA,SET_DELETE_VISA,SET_GETLASTID,SET_CUSTOMER_VISA} from "./mutation.type"
const state = {
   visas:[],
   lastid:'',
   customervisas:[],
};

const getters = {
    visas(state){
        return state.visas
    },
    lastid(state){
        return state.lastid
    },
    customervisas(state){
        return state.customervisas
    }
}

const actions = {
   [CUSTOMER_VISA]({commit},id){
        return new Promise((resolve, reject) => {
            axios.get("api/invoice/customer/visa/"+id)
            .then(response => {
                 console.log(response.data);
                commit(SET_CUSTOMER_VISA,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
   },
   [GETLASTID]({commit},type) {
        return new Promise((resolve, reject) => {
            axios.get("/api/visa/getlastid/"+type)
            .then(response => {
                commit(SET_GETLASTID,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
   },
   [ALL_VISA]({commit},data) {
        return new Promise((resolve, reject) => {
            axios.post("/api/visa?page="+data.page,data.data)
            .then(response => {

                commit(SET_ALL_VISA,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ADD_VISA]({commit},data) {
        return new Promise((resolve, reject) => {
            axios.post("/api/visa/store",data)
            .then(response => {
                if(data.id==''){
                  commit(SET_ADD_VISA,response.data);
                }
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_VISA]({commit},data) {
        return new Promise((resolve, reject) => {
            axios.get("/api/visa/delete/"+data.id)
            .then(response => {
                commit(SET_DELETE_VISA,data.index);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
}

const mutations = {
    [SET_CUSTOMER_VISA](state,data){
        console.log(data);
        state.customervisas = data;
        console.log(state.customervisas);

    },
    [SET_ALL_VISA](state, data) 
    {
        state.visas = data;
    },
    [SET_ADD_VISA](state,data){
        state.visas.data.unshift(data);
    },
    [SET_DELETE_VISA](state,index){
        state.visas.data.splice(index,1)
        iziToast.success({position:'topRight',title:'Ok',message:"Delated Successsfully"})
    },
    [SET_GETLASTID](state,data){
        state.lastid = data;
    }

};

export default {
    state,
    actions,
    mutations,
    getters
};