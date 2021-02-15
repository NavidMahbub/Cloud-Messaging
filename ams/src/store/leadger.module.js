import axios from "axios"
import { CURRENT_LEADGER,SEARCH_LEADGER,REPORT,SEARCH_WORKERS} from "./action.type"
import { SET_CURRENT_LEADGER,SET_REPORT,SET_SEARCH_WORKERS} from "./mutation.type"
const state = {
    leadgerdatas:[],
    reports:[],
    workersreports:[],
}

const getters = {
    workersreports(state){
        return state.workersreports
    },
    leadgerdatas(state){
        return state.leadgerdatas
    },
    reports(state){
        return state.reports
    }
}

const actions = {
    
    [REPORT]({commit}) {
        return new Promise((resolve, reject) => {
            axios
            .get("api/reports")
            .then(response => {
                
                commit(SET_REPORT,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [CURRENT_LEADGER]({commit}) {
        return new Promise((resolve, reject) => {
            axios
            .get("api/current-leadger")
            .then(response => {
                
                commit(SET_CURRENT_LEADGER,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [SEARCH_LEADGER]({commit},data) {
        return new Promise((resolve, reject) => {
            console.log(data)
            axios
            .post("api/search-leadger",data)
            .then(response => {
                // console.log(response)
                commit(SET_CURRENT_LEADGER,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [SEARCH_WORKERS]({commit},data) {
        return new Promise((resolve, reject) => {
            console.log(data)
            axios
            .post("api/search-workers",data)
            .then(response => {
                // console.log(response)
                commit(SET_SEARCH_WORKERS,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_SEARCH_WORKERS](state, data) 
    {
        state.workersreports = data;
    },
    [SET_CURRENT_LEADGER](state, data) 
    {
        state.leadgerdatas = data;
    },
    [SET_REPORT](state, data) 
    {
        state.reports = data;
    } 
}
export default {
    state,
    actions,
    mutations,
    getters
};