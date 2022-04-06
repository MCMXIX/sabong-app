import oUserService from '../services/userService';

const oInitialState = {
    bLoginError : true,
    sLoginErrorMessage : ''
}

const mutations = {
    /**
     * SET_LOGIN_ERROR
     * @param {object} state 
     * @param {bool} bLoginError 
     */
    SET_LOGIN_ERROR(state, bLoginError) {
        state.bLoginError = bLoginError;
    },

    /**
     * SET_LOGIN_ERROR_MESSAGE
     * @param {object} state 
     * @param {string} sErrorMessage 
     */
    SET_LOGIN_ERROR_MESSAGE(state, sErrorMessage) {
        state.sLoginErrorMessage = sErrorMessage;
    }
}

const actions = {
    /**
     * login
     * @param object commit
     * @param {object} oCredentials 
     */
    async login({ commit }, oCredentials) {
        await oUserService.login(oCredentials)
            .then(() => {
                location.replace('/');
                commit('SET_LOGIN_ERROR', true);
            })
            .catch(oError => {
                commit('SET_LOGIN_ERROR', false);
                commit('SET_LOGIN_ERROR_MESSAGE', oError.response.data);
            });
    }
}

const getters = {
    /**
     * bLoginError
     * @param {object} state 
     * @return bool
     */
    bLoginError(state) {
        return state.bLoginError;
    },

    /**
     * sLoginErrorMessage
     * @param {object} state 
     * @return string
     */
    sLoginErrorMessage(state) {
        return state.sLoginErrorMessage;
    }
}

export default {
    state : oInitialState,
    mutations,    
    actions,
    getters,
    namespaced : true
}