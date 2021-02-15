
import axios from "axios"
import iziToast from 'izitoast'

import { CONTACT_DETAILS ,ALL_CONTACT,ALL_P_CONTACT,DELETE_CONTACT,ADD_CONTACT,UPDATE_CONTACT,OPEN_CONTACT_MODAL,CLOSE_CONTACT_MODAL,SEARCH_CONTACT } from "./action.type"
import { SET_CONTACT_DETAILS, SET_CONTACT,SET_P_CONTACT,AFTER_DELETE_CONTACT,AFTER_ADD_CONTACT,AFTER_UPDATE_CONTACT,SET_CONTACT_MODAL } from "./mutation.type"

const state = {
    contacts: [],
    contactDetails:{},
    p_contacts: [],
    p_contacts2: [],
    modal:false,
};

const getters = {
    allContacts(state){
        return state.contacts
    },
    contactDetails(state){
        return state.contactDetails
    },
    allPContacts(state){
        return state.p_contacts
    },
    allPContacts2(state){
        return state.p_contacts2
    },
    modalOperate(state){
        return state.modal
    }
}

const actions = {
    [CONTACT_DETAILS](context,id) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/contacts/details/change/"+id)
            .then(response => {
                context.commit(SET_CONTACT_DETAILS, response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_CONTACT](context) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/contacts")
            .then(response => {
                context.commit(SET_CONTACT, response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_P_CONTACT](context,page) {
        return new Promise((resolve, reject) => {
            axios
            .post('api/contacts/pagination?page=' + page)
            .then(response => {
                context.commit(SET_P_CONTACT, response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [SEARCH_CONTACT](context,data) {
        return new Promise((resolve, reject) => {
            axios
            .post('api/contacts/pagination?page=' + data.page,data.data)
            .then(response => {
                context.commit(SET_P_CONTACT, response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_CONTACT]({commit},id_index) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/contacts/"+id_index.id)
            .then(response => {
                commit(AFTER_DELETE_CONTACT,id_index.index);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ADD_CONTACT]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post("/contacts",data)
            .then(response => {
                commit(AFTER_ADD_CONTACT,response.data);
                resolve(response);
            })
            .catch(function(error) {
                state.add_contact_loader = false

                reject(error);
            });
        });
    },
    [UPDATE_CONTACT]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("/contacts",data.data)
            .then(response => {
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_CONTACT",{update_data,index});
                resolve(response);
            })
            .catch(function(error) {
                state.update_contact_loader = false
                reject(error);
            });
        });
    },
    [OPEN_CONTACT_MODAL](context){

        context.commit(SET_CONTACT_MODAL,true);
    },
    [CLOSE_CONTACT_MODAL](context){
        context.commit(SET_CONTACT_MODAL,false);
    },
}

const mutations = {
    [SET_CONTACT_DETAILS](state, data) 
    {
        state.contactDetails = data
        
    },
    [SET_CONTACT](state, data) 
    {
        state.contacts = data
        
    },
    [SET_P_CONTACT](state, data) 
    {
        state.p_contacts = data.data;
        state.p_contacts2 = data;
        
    },
    [AFTER_DELETE_CONTACT](state,index){
        state.contacts.splice(index,1)
        state.p_contacts.splice(index,1)
        // iziToast.success({position:'topRight',title:'Ok',message:"Contact Delated Successsfully"})
    },
    [AFTER_ADD_CONTACT](state,data){
        state.contacts.unshift(data)
        state.p_contacts.unshift(data)
        state.modal = false
        iziToast.success({position:'topRight',title:'Ok',message:"Contact Added Successsfully"})
    },
    [AFTER_UPDATE_CONTACT](state,payload){
        state.contacts.splice(payload.index,0,payload.update_data)
        state.contacts.splice(payload.index+1,1)

        state.p_contacts.splice(payload.index,0,payload.update_data)
        state.p_contacts.splice(payload.index+1,1)
        iziToast.success({position:'topRight',title:'Ok',message:"Contact Updated Successsfully"})
    },
    [SET_CONTACT_MODAL](state,payload){
        state.modal = payload
    }
    
};

export default {
    state,
    actions,
    mutations,
    getters
};