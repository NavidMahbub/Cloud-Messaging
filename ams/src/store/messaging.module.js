import axios from "axios"
const state = {
    messages:[],
    topics:[],
    categorys:[],
    logedUser:''
}

const getters = {
    message_list(state){
        return state.messages  
    },
    topic_list(state){
        return state.topics
    },
    loged_user(state){
        return state.logedUser
    },
    category_list(state){
        return state.categorys
    },

} 

const actions = {

    ['FETCH_LOGED_IN_USER']({commit}){
        return new Promise((resolve,reject)=>{
            axios.get('/api/communication/messaging/loged/user').then(response=>{
                resolve(response)
                commit('LOGGED_USER',response.data)
            }).catch(error=>{
                reject(error)
            })
        })
    },

    ['FETCH_TOPICS']({commit}){
        return new Promise((resolve,reject)=>{
            axios.get('/api/communication/topic/list').then(response=>{
                resolve(response)
                commit('SET_TOPICS',response.data)
            }).catch(error=>{
                reject(error)
            })
        })
    },
    ['FETCH_MESSAGES']({commit},id){
        console.log("asce")
        return new Promise((resolve,reject)=>{
            axios.get('/api/communication/messaging/'+id).then(response=>{
                resolve(response)
                commit('SET_MESSAGES',response.data)
            }).catch(error=>{
                reject(error)
            })
        })
    },

    ['FETCH_CATEGORY']({commit}){       
        return new Promise((resolve,reject)=>{
            axios.get('/api/communication/messaging/category').then(response=>{
                resolve(response)
                commit('SET_CATEGORY',response.data)
            }).catch(error=>{
                reject(error)
            })
        })
    },


    ['DELETE_TOPICS']({commit},id) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/api/communication/topic/delete/"+id)
            .then(response => {
                // commit("AFTER_DELETE_TOPIC",data.index);   
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },

   
    ['ADD_MESSAGES']({commit},payload){
        return new Promise((resolve,reject)=>{
           console.log(payload)
            axios.post('/api/communication/messaging',payload).then(response=>{
                resolve(response)
            }).catch(error=>{
                reject(error)
            })
        })
    },
}

const mutations = {
    ['SET_MESSAGES'](state,payload){
        state.messages = payload
    },
    ['SET_TOPICS'](state,payload){
        state.topics = payload
    },
    ['LOGGED_USER'](state,payload){
        state.logedUser = payload
    },
    ['SET_CATEGORY'](state,payload){
        state.categorys = payload
    }
}

export default {
    state,
    getters,
    actions,
    mutations,
}