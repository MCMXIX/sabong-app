<template>
    <div class="fight w-4/5 mx-auto container lg:h-[calc(100vh-96px)]">
        <div
            class="fight__container--info mt-4 lg:mt-14 bg-gray-dark shadow-lg rounded-lg p-2 lg:p-5 flex flex-col lg:flex-row justify-between">
            <div class="order-3 lg:order-1 meron__container">
                <p class="text--success label--sides mb-4 text-4xl">MERON</p>
                <div class="side--text--results">
                    <p class="total-bets">{{ getFormattedTotalBet(oFightInfo.meron_bets) }}</p>
                    <p class="winning-chance">187.16%</p>
                </div>
            </div>
            <div class=" order-1 flex flex-col lg:order-1 fight--info__container mb-4">
                <div class="fight-number text-center order-1 lg:order-2">
                    <p class="inline label text-center font-medium text-3xl">FIGHT #</p>
                    <p class="inline text-3xl font-medium"> {{ oFightInfo.fight_no }} </p>
                </div>
                <p :class="[getStatusTextColor(oFightInfo.status), 'font-bold text-center text-3xl my-2 lg:mt-5 order-2 lg:order-2']">{{ getFightStatus(oFightInfo.status) }}</p>
            </div>
            <div class="order-2 lg:order-3  wala__container">
                <p class="text--warn label--sides mb-4 text-4xl">WALA</p>
                <div class="side--text--results ">
                    <p class="total-bets">{{ getFormattedTotalBet(oFightInfo.wala_bets) }}</p>
                    <p class="winning-chance">192.16%</p>
                </div>
            </div>
        </div>
        <div class="fight__buttons flex flex-col lg:flex-row lg:gap-0 gap-2 justify-evenly mt-7">
            <button @click="updateFightResult('O')" class="button--primary">OPEN</button>
            <button @click="updateFightResult('C')" class="button--warn">CLOSE</button>
            <button @click="toggleFightResult()" class="button--secondary">DONE</button>
        </div>
        <div class="fight__container--results mt-7 w-4/5 mx-auto">
            <fight-results />
        </div>
        <div class="fixed z-[60] inset-0 overflow-y-auto" :class="{'hidden' : fightDone}" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                    Background overlay, show/hide based on modal state.
                    Entering: "ease-out duration-300"
                        From: "opacity-0"
                        To: "opacity-100"
                    Leaving: "ease-in duration-200"
                        From: "opacity-100"
                        To: "opacity-0"
                -->
                <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <!--
                Modal panel, show/hide based on modal state.
                Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div class="relative inline-block align-bottom bg-black-dark rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-black-dark px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <button @click="toggleFightResult()" class="close__button"> <span class="lg:icon ic-close"></span> </button>
                                <p class="text-4xl font-bold">RESULTS</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-black-dark px-4 py-3 sm:px-6 sm:flex flex-col w-full">
                        <div class="result__button--container flex justify-evenly gap-4 w-full">
                            <button @click="updateFightResult('D', 'M')" class="button--primary py-2 text-3xl">MERON</button>
                            <button @click="updateFightResult('D', 'W')" class="button--warn  text-3xl">WALA</button>
                        </div>
                        <div class="result__button--container flex mt-8 justify-evenly w-full">
                            <button @click="updateFightResult('D', 'D')" class="button--robi py-2  text-3xl">DRAW</button>
                        </div>
                        <div class="result__button--container flex mt-8 justify-evenly w-full">
                            <button @click="updateFightResult('D', 'E')" class="button--secondary py-2">Cancel <br/> Fight</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import {fightMixin} from '../../mixins/fight-mixin';
import FightResults from '../components/fightResults.vue'

export default {
    name: 'dashboard',
    components: { 
        FightResults,
    },
    mixins: [fightMixin],
    data() {
        return {
            fightDone: true,
            iFightNo : 1,
        }
    },
    mounted() {
        this.getFightInfo();
        
        //WEBSOCKET FOR FIGHT INFO
        window.Echo.channel('bets')
            .listen('Bets', (oFightInfo)=> {
                this.$store.commit('oFight/SET_FIGHT_INFO', oFightInfo);
            });
    },
    computed: {
        ...mapGetters('oFight', ['oFightInfo'])
    },
    methods : {
        ...mapActions('oFight', ['updateFight', 'getFightInfo']),

        /**
         * toggleFightResult
         */
        toggleFightResult() {
            this.fightDone = !this.fightDone;
        },

        /**
         * updateFightResult
         */
        updateFightResult(sStatus, mGameWinner = null) {
            let oParameters = {
                fight_no : this.oFightInfo.fight_no,
                status : sStatus
            };

            if (mGameWinner !== null) {
                oParameters['game_winner'] = mGameWinner
            }

            if (this.oFightInfo.fight_no === 1 && !!this.oFightInfo.status === false) {
                delete oParameters.status;
            }

            this.updateFight(oParameters);
            this.fightDone = true;
        },
    }  
}
</script>
<style scoped>
.label--sides,
.label {
    @apply text-center px-3;
}
.fight--sides__label .label {
    @apply text-2xl font-bold;
}
.result__button--container button {
    @apply min-w-[8rem];
}
.fight-number {
    @apply p-4 bg-gray-med
}
.side--text--results {
    @apply text-center;
}
.fight__buttons button{
    @apply text-3xl font-medium py-4 px-7;
}
.result__modal--done {
    @apply fixed top-0 left-0 w-full h-full z-[60]
}
/* Modal */
.modal--backdrop {
    @apply w-full h-full bg-black bg-opacity-70 absolute;
}
.modal--small--centered {
    @apply min-h-[40%] rounded-md  min-w-[20%] max-w-[920px] bg-black-dark relative top-1/2 left-1/2 ;
}
.close__button {
    @apply w-8 h-8 absolute right-5 top-3;
}
.ic-close::before,
.ic-close::after {
    top: 0;
    left: 50%;
}
</style>