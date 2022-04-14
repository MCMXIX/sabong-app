import axios from 'axios';

const oApiClient = axios.create({
    baseURL : '/api/bet',
    headers : {
        Accept : 'application/json',
        'Content-Type' : 'application/json'
    }
});

export default {
    /**
     * addNewBet
     * @param {object} oParameters 
     * @returns 
     */
    addNewBet(oParameters) {
        return oApiClient.post('/', oParameters);
    }
}