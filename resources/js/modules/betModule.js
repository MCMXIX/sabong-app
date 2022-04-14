import oBetService from '../services/betService';

const oInitialState  = {

}

const mutations = {

}

const actions = {
    /**
     * addNewBet
     * @param object commit
     * @param {object} oParameters 
     */
    async addNewBet({ commit }, oParameters) {
        await oBetService.addNewBet(oParameters)
            .then(oResponse => {
                alert(oResponse.data.message);
            })
            .catch(oError => {
                alert(oError.response.data.message);
            });
    }
}

const getters = {

}

export default {
    state : oInitialState,
    mutations,
    actions,
    getters,
    namespaced: true
}