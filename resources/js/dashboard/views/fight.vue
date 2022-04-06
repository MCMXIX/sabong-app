<template>
    <div class="fight w-4/5 mt-4 lg:mt-14 mx-auto container">
        <div
            class="fight__container--info bg-gray-dark shadow-lg rounded-lg p-2 lg:p-5 flex flex-col lg:flex-row justify-between">
            <div class="order-3 lg:order-1 meron__container">
                <p class="text--success label--sides mb-4 text-4xl">MERON</p>
                <div class="side--text--results">
                    <p class="total-bets">35,563</p>
                    <p class="winning-chance">187.16%</p>
                </div>
            </div>
            <div class=" order-1 flex flex-col lg:order-1 fight--info__container mb-4">
                <div class="fight-number text-center order-1 lg:order-2">
                    <p class="inline label text-center font-medium text-3xl">FIGHT #</p>
                    <p class="inline text-3xl font-medium">1</p>
                </div>
                <p class="text-green-med font-bold text-center text-3xl my-2 lg:mt-5 order-2 lg:order-2">OPEN</p>
            </div>
            <div class="order-2 lg:order-3  wala__container">
                <p class="text--warn label--sides mb-4 text-4xl">WALA</p>
                <div class="side--text--results ">
                    <p class="total-bets">35</p>
                    <p class="winning-chance">192.16%</p>
                </div>
            </div>
        </div>
        <div class="fight__buttons flex flex-col lg:flex-row lg:gap-0 gap-2 justify-evenly mt-7">
            <button class="button--primary">OPEN</button>
            <button class="button--warn">CLOSE</button>
            <button class="button--secondary" @click="doneFight();">DONE</button>
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
                                <button class="close__button" @click="doneFight()"> <span class="lg:icon ic-close"></span> </button>
                                <p class="text-4xl font-bold">RESULTS</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-black-dark px-4 py-3 sm:px-6 sm:flex flex-col w-full">
                        <div class="result__button--container flex justify-evenly gap-4 w-full">
                            <button class="button--primary py-2 text-3xl">MERON</button>
                            <button class="button--warn  text-3xl">WALA</button>
                        </div>
                        <div class="result__button--container flex mt-8 justify-evenly w-full">
                            <button class="button--robi py-2  text-3xl">DRAW</button>
                        </div>
                        <div class="result__button--container flex mt-8 justify-evenly w-full">
                            <button class="button--secondary py-2">Cancel <br/> Fight</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import FightResults from '../components/fightResults.vue'
export default {
    name: 'dashboard',
    components: { 
        FightResults,
    },
    data() {
        return {
            fightDone: true,
        }
    },
    computed: {

    },
    methods: {
            doneFight : function() {
            this.fightDone = !this.fightDone;
        }
    },
}
</script>
<style scoped>
.fight__label,
.fight-status {
    @apply flex flex-col lg:justify-start justify-between;
}
.label--sides,
.label {
    @apply text-center px-3;
}
.total-bets {
    @apply text-4xl
}
.fight--sides__label .label {
    @apply text-2xl font-bold;
}
.winning-chance {
    @apply text-gray-200;
}
.result__button--container button {
    @apply min-w-[8rem];
}
.fight-number {
    @apply p-4 bg-gray-med
}
.total-bets {
    @apply font-bold text-yellow-300;
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