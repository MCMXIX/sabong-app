import Vue from 'vue';
import Vuex from 'vuex';
import oUser from './modules/userModule';
import oFight from './modules/fightModule';
import oBet from './modules/betModule';

Vue.use(Vuex);
export default new Vuex.Store({
    modules : {
        oUser,
        oFight,
        oBet
    }
});