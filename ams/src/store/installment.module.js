import axios from "axios"
import { ALL_INSTALLMENT_INVOICE} from "./action.type"
import { SET_INVOICE} from "./mutation.type"
const state = {
    invoice:[],
    invoice2:[]
}

const getters = {
    invoiceInstallments(state){
        return state.invoice
    },
    invoiceInstallments2(state){
        return state.invoice2
    }

}
const actions = {
    
    [ALL_INSTALLMENT_INVOICE]({commit},page) {
        return new Promise((resolve, reject) => {
            axios
            .post('/api/installment-invoices?page=' + page)
            .then(response => {
                commit(SET_INVOICE,response.data);
                
                resolve(response);
            })
            .catch(function(error) {
                reject(error);
            });
        });
    }
    
}

const mutations = {
    [SET_INVOICE](state, data) 
    {
        state.invoice = data.data;
        state.invoice2 = data;
    }
    
}
export default {
    state,
    actions,
    mutations,
    getters
};