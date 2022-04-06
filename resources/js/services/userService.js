import axios from 'axios';

const oApiClient = axios.create({
    baseURL : '/api/user',
    headers : {
        Accept : 'application/json',
        'Content-Type' : 'application/json'
    }
});

export default {
    login(oCredentials) {
        return oApiClient.post('/login', oCredentials);
    }
}