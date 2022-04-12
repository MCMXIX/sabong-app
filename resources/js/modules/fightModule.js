import oFightService from '../services/fightService';

const oInitialState = {
    oFightInfo : {},
    aFightResults : []
}

const mutations = {
    /**
     * SET_FIGHT_INFO
     * @param {object} state
     * @param {object} oFightInfo 
     */
    SET_FIGHT_INFO(state, oFightInfo) {
        state.oFightInfo = oFightInfo;
    },

    /**
     * SET_FIGHT_RESULTS
     * @param {object} state 
     * @param {object} aFightResults 
     */
    SET_FIGHT_RESULTS(state, aFightResults) {
        state.aFightResults = aFightResults;
    }
}

const actions = {
    /**
     * updateFight
     * @param object commit
     * @param {object} oParameters 
     */
    async updateFight({ commit }, oParameters)  {
        await oFightService.updateFight(oParameters)
            .then(oResponse => {
                commit('SET_FIGHT_INFO', oResponse.data);
            })
            .catch((oError) => {
                if (oError.response.status === 404 || oError.response.status === 400) {
                    alert(oError.response.data.message);
                    return;
                }

                alert('Something wen\'t wrong updating the fight, please refresh the browser.');
            });
    },

    /**
     * getFightResults
     * @param object commit
     */
    async getFightResults({ commit }) {
        await oFightService.getFightResults()
            .then(oResponse => {
                commit('SET_FIGHT_RESULTS', oResponse.data);
            })
            .catch(() => {
                alert('Something wen\'t wrong retrieving fight results, please refresh the browser.');
            });
    },

    /**
     * getFightInfo
     * @param object commit
     */
    async getFightInfo({ commit }) {
        await oFightService.getFightInfo()
            .then(oResponse => {
                commit('SET_FIGHT_INFO', oResponse.data);
            })
    }
}

const getters = {
    /**
     * oFightInfo
     * @param {object} state
     * @returns object
     */
    oFightInfo(state) {
        return state.oFightInfo;
    },

    /**
     * aFightResults
     * @param {object} state 
     * @return array
     */
    aFightResults(state) {
        return state.aFightResults;
    }
}

export default {
    state : oInitialState,
    mutations,
    actions,
    getters,
    namespaced: true
}