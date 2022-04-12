import axios from 'axios';

const oApiClient = axios.create({
    baseURL : '/api/fight',
    headers : {
        Accept : 'application/json',
        'Content-Type' : 'application/json'
    }
});

export default {
    /**
     * updateFight
     * @param {object} oParameters
     * @returns object
     */
    updateFight(oParameters) {
        return oApiClient.post('/', oParameters);
    },

    /**
     * getFightInfo
     * @return object
     */
    getFightInfo() {
        return oApiClient.get('/');
    },

    /**
     * getFightResults
     * @return object
     */
     getFightResults() {
        return oApiClient.get('/results');
    }
}