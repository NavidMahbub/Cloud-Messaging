import axios from "axios"
import { All_PROJECT,ADD_PROJECT,UPDATE_PROJECT,DELETE_PROJECT,SEARCH_PROJECT} from "./action.type"
import { AFTER_ADD_PROJECT,SET_PROJECT,AFTER_UPDATE_PROJECT,AFTER_DELETE_PROJECT } from "./mutation.type"
const state = {
    project:[],
    pProject:[]
}

const getters = {
    projects(state){
        return state.project
    },
    pProjects(state){
        return state.pProject
    }
}

const actions = {
    [ADD_PROJECT]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post("/project",data)
            .then(response => {
                commit(AFTER_ADD_PROJECT,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [All_PROJECT]({commit},page) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/projects?page=' + page)
            .then(response => {
                console.log(response)
                commit(SET_PROJECT,response.data)
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
    [SEARCH_PROJECT]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/projects?page=' + data.page,data.data)
            .then(response => {
                commit(SET_PROJECT,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [UPDATE_PROJECT]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("/project",data.data)
            .then(response => {
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_PROJECT",{update_data,index});
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_PROJECT]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/project/"+data.id)
            .then(response => {
                commit("AFTER_DELETE_PROJECT",data.index);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_PROJECT](state, data) 
    {
        state.project = data.data;
        state.pProject = data;
    },
    [AFTER_ADD_PROJECT](state, data) 
    {
        // state.pProject.push(data);
        state.project.unshift(data);
    },
    [AFTER_UPDATE_PROJECT](state,payload){
        state.project.splice(payload.index,0,payload.update_data)
        state.project.splice(payload.index+1,1)

        // state.pProject.splice(payload.index,0,payload.update_data)
        // state.pProject.splice(payload.index+1,1)
    },
    [AFTER_DELETE_PROJECT](state,index){
        state.project.splice(index,1)
        // state.pProject.splice(index,1)
    },
    
    
    
}
export default {
    state,
    actions,
    mutations,
    getters
};