import axios from "axios"
import { ALL_DISTRICT,ALL_SUBDISTRICT } from "./action.type"
import { SET_DISTRICT,SET_SUBDISTRICT,SUBDISTRICT_LOADER,DISTRICT_LOADER } from "./mutation.type"
const state = {
    districts: [],
    subdistricts: [],
    district_loader:true,
    subdistrict_loader:true,
}

const getters = {
    districts(state){
        return state.districts
    },
    subdistricts(state){
        return state.subdistricts
    },
    districtLoader(state){
        return state.district_loader
    },
    subdistrictLoader(state){
        return state.subdistrict_loader
    },
}

const actions = {
    [ALL_DISTRICT](context) {
        return new Promise((resolve, reject) => {
            axios
            .get("/api/district")
            .then(response => {
                context.commit(SET_DISTRICT, response.data);
                context.commit(DISTRICT_LOADER);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
    [ALL_SUBDISTRICT]({commit},id) {
        commit(SUBDISTRICT_LOADER, true);
        return new Promise((resolve, reject) => {
            axios
            .get("/api/upazila/"+id)
            .then(response => {
                commit(SET_SUBDISTRICT, response.data);
                commit(SUBDISTRICT_LOADER, false);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
}

const mutations = {
    [SET_DISTRICT](state, data) 
    {
        state.districts = data;
    },
    [SET_SUBDISTRICT](state, data) 
    {
        state.subdistricts = data;
    },
    [SUBDISTRICT_LOADER](state,data) 
    {
        state.subdistrict_loader = data;
    },
    [DISTRICT_LOADER](state) 
    {
        state.district_loader = false;
    }
    
}
export default {
    state,
    actions,
    mutations,
    getters
};