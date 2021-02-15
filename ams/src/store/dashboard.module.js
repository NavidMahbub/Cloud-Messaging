
import axios from "axios"
import iziToast from 'izitoast'

import { STATISTICS} from "./action.type"
import { SET_STATISTICS} from "./mutation.type"
const state = {
   statistics:[],
};

const getters = {
    statistics(state){
        return state.statistics
    }
}

const actions = {
   [STATISTICS]({commit}) {
        return new Promise((resolve, reject) => {
            axios.get("/api/statistics/workers")
            .then(response => {
                commit(SET_STATISTICS,response.data);
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    },
}

const mutations = {
    [SET_STATISTICS](state, data) 
    {
        state.statistics = data;
    },

};

export default {
    state,
    actions,
    mutations,
    getters
};