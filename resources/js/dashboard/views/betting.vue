<template>
    <div class="lg:max-w-[30%] mx-auto lg:h-[calc(100vh-96px)]">
        <div class=" order-1 flex flex-col lg:order-1 fight--info__container mt-4 mb-4 lg:mt-6 ">
            <div class="text-center order-1 lg:order-2 bg-gray-med max-w-max mx-auto p-5">
                <p class="inline label text-center font-medium text-3xl">FIGHT #</p>
                <p class="inline text-3xl font-medium">1</p>
            </div>
            <p class="text-green-med font-bold text-center text-3xl lg:text-4xl my-2 lg:mt-5 order-2 lg:order-2">OPEN</p>
        </div>
        <p class="block text-red-high text-sm text-center lg:mt-11" :class="{'invisible': noSideChosed}">Choose a Side</p>
        <div class="betting__container--radio">
            <label>
                <input type="radio" class="hidden" name="sidePicker" value="Meron" id="" v-model="aBetDetails.sSideValue">
                <span class="side--checkmark--radio meron--radio">MERON</span>
            </label>
            <label>
                <input type="radio" class="hidden" name="sidePicker" value="Wala" id="" v-model="aBetDetails.sSideValue">
                <span class="side--checkmark--radio wala--radio">WALA</span>
            </label>
        </div>
        <div class="betting__container--counter meron">
            <div class="fight-status w-1/2 text-center">
                <p class="total-bets number">35,035</p>
                <p class="winning-chance number">197.6%</p>
            </div>
            <div class="fight-status w-1/2 text-center">
                <p class="total-bets number">35</p>
                <p class="winning-chance number">182.6%</p>
            </div>
        </div>
        <div class="relative h-max mt-4 top-0">
            <input type="number" 
            class="w-full rounded h-11
            text-black font-medium 
            focus:outline-none relative top-0 uppercase
            focus:ring focus:border-cyan-400 pl-2 pr-20"
            min="100" @keyup="getInputAmountValue();" v-model="inputBetAmount">
            <p class="block text-red-high text-sm text-center" :class="{'invisible': errAmount}">Amount has to be greater than or equal to 100</p>
            <button 
            class="absolute right-0 top-0 rounded-[0] bg-green-med h-11 rounded-r px-3 hover:bg-green-low ease-in-out transition-colors duration-200" @click="checkinputAmount()">SUBMIT</button>
        </div>
        <div class="betting__container--amount mt-8">
            <div class="bet__button--row">
                <input type="button" class="button--amount" value="100" @click="setBetAmount(100)" :disabled="oDisableButton"/>
                <input type="button" class="button--amount" value="200" @click="setBetAmount(200)" :disabled="oDisableButton"/>
                <input type="button" class="button--amount" value="300" @click="setBetAmount(300)" :disabled="oDisableButton"/>
            </div>
            <div class="bet__button--row">
                <input type="button" class="button--amount" value="500" @click="setBetAmount(500)" :disabled="oDisableButton"/>
                <input type="button" class="button--amount" value="1000" @click="setBetAmount(1000)" :disabled="oDisableButton"/>
                <input type="button" class="button--amount" value="2000" @click="setBetAmount(2000)" :disabled="oDisableButton"/>
            </div>
        </div>
        <div class="fixed z-[60] inset-0 overflow-y-auto" :class="{'hidden' : oShowModal}" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
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
                    <div class="bg-black-dark px-4 py-3 sm:px-6 sm:flex flex-col w-full">
                        <div class="flex flex-col">
                            <div class="bet--results text-center gap-4">
                                <div class="fight--number__container">
                                    <h3>FIGHT</h3>
                                    <h3>#1</h3>
                                </div>
                                <div class="bet--amount__container">
                                    <h3 class="bet__label">AMOUNT</h3>
                                    <h3 class="uppercase font-bold">{{ aBetDetails.iAmount }}</h3>
                                </div>
                                <div class="bet--side__container t">
                                    <h3>SIDE</h3>
                                    <h3 class="uppercase font-bold modal--side" >{{ aBetDetails.sSideValue }}</h3>
                                </div>
                                <div class="bet--confirm__buttons mt-5">
                                    <button class="button--secondary py-2 px-4 mr-2" @click="submitBet();">Cancel</button>
                                    <button class="button--primary py-2 px-4">Confirm</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'betting',
    data() {
        return {
            
            iButtonAmount:"",
            errAmount: true,
            noSideChosed: true,
            oShowModal: true,
            oDisableButton: false,
            inputBetAmount:"",
            aBetDetails: { 
                iAmount: "",
                sSideValue:""
            }
        }
    },
    methods: {
        submitBet: function() {  
            this.oShowModal = !this.oShowModal;
        },
        checkSides: function() {
            if ( this.aBetDetails.sSideValue === "Meron" || this.aBetDetails.sSideValue === "Wala") {
                this.noSideChosed = true;
                this.submitBet();
            } else {
                this.noSideChosed = !this.noSideChosed;
            }
        },
        setBetAmount: function(betAmount) {
            this.aBetDetails.iAmount = betAmount;
            this.checkSides();
        },
        checkinputAmount: function() {
            if (this.inputBetAmount < 100) {
                this.errAmount = false;
            } else {
                this.aBetDetails.iAmount = this.inputBetAmount;
                this.errAmount = true;
                this.checkSides();
            }
        },
        getInputAmountValue: function() {
            if ( this.inputBetAmount.length > 0 ) {
                this.oDisableButton = true;
            } else {
                this.oDisableButton = false;
            }
        },
    },
}
</script>
<style scoped>
.betting__container--radio {
    @apply flex flex-row items-center justify-between gap-4 lg:gap-14 
} 
.betting__container--counter {
    @apply flex flex-row items-center gap-4 lg:gap-14 justify-between 
}
.bet__button--row {
    @apply flex flex-row justify-evenly w-full mt-4 gap-2;
}
.button--amount {
    @apply w-24 h-16 bg-blue-med rounded border-2 border-blue-high cursor-pointer text-2xl font-bold transition-colors duration-200 ease-in-out focus:outline-blue-high focus:outline-none outline-1 focus:bg-blue-white hover:bg-blue-white
}
.button--amount:disabled {
    @apply bg-gray-high border-black-high cursor-not-allowed;
}
.bet--results {
    @apply flex flex-col
}
.bet--results h3 {
    @apply inline uppercase mr-4
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}

</style>