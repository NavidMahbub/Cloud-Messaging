import axios from "axios"
import { All_PROJECT_CATEGORY,ADD_PROJECT_CATEGORY,UPDATE_PROJECT_CATEGORY,DELETE_PROJECT_CATEGORY,SEARCH_PROJECT_CATEGORY,ALL_P_PROJECT_CATEGORY} from "./action.type"
import { AFTER_ADD_PROJECT_CATEGORY,SET_PROJECT_CATEGORY,AFTER_UPDATE_PROJECT_CATEGORY,AFTER_DELETE_PROJECT_CATEGORY,SET_P_PROJECT_CATEGORY } from "./mutation.type"
const state = {
    project_category:[],
    project_p_category:[],
    project_p_category2:[]

}

const getters = {
    project_categories(state){
        return state.project_category
    },
    projectPcategories(state){
        return state.project_p_category
    },
    projectPcategories2(state){
        return state.project_p_category2
    }
}

const actions = {
    [ADD_PROJECT_CATEGORY]({commit},data) {
        console.log(data)
        return new Promise((resolve, reject) => {
            axios
            .post("/category",data)
            .then(response => {
                commit(AFTER_ADD_PROJECT_CATEGORY,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [All_PROJECT_CATEGORY]({commit}) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/project-category")
            .then(response => {
                commit(SET_PROJECT_CATEGORY,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_P_PROJECT_CATEGORY]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/projects?page=' + data.page,data.data)
            .then(response => {
                commit(SET_P_PROJECT_CATEGORY,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [SEARCH_PROJECT_CATEGORY]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/project-category/pagination?page='+ data.page,data.data)
            .then(response => {
                commit(SET_P_PROJECT_CATEGORY,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [UPDATE_PROJECT_CATEGORY]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .put("/category",data.data)
            .then(response => {
                var update_data = response.data
                var index = data.index
                commit("AFTER_UPDATE_PROJECT_CATEGORY",{update_data,index});
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [DELETE_PROJECT_CATEGORY]({commit},data) {
        return new Promise((resolve, reject) => {
            axios
            .delete("/category/"+data.id)
            .then(response => {
                commit("AFTER_DELETE_PROJECT_CATEGORY",data.index);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    
}

const mutations = {
    [SET_PROJECT_CATEGORY](state, data) 
    {
        state.project_category = data;
    },
    [AFTER_ADD_PROJECT_CATEGORY](state, data) 
    {
        state.project_category.unshift(data);
        state.project_p_category.unshift(data);
    },
    [AFTER_UPDATE_PROJECT_CATEGORY](state,payload){
        state.project_category.splice(payload.index,0,payload.update_data)
        state.project_category.splice(payload.index+1,1)

        state.project_p_category.splice(payload.index,0,payload.update_data)
        state.project_p_category.splice(payload.index+1,1)
    },
    [AFTER_DELETE_PROJECT_CATEGORY](state,index){
        state.project_category.splice(index,1)
        state.project_p_category.splice(index,1)
    },
    [SET_P_PROJECT_CATEGORY](state, data){
        state.project_p_category = data.data;
        state.project_p_category2 = data;
    }
    
    
    
}
export default {
    state,
    actions,
    mutations,
    getters
};