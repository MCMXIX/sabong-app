<template>
    <div class="lg:max-w-[30%] mx-auto">
        <div class=" order-1 flex flex-col lg:order-1 fight--info__container mt-4 mb-4 lg:mt-6 ">
            <div class="text-center order-1 lg:order-2 bg-gray-med max-w-max mx-auto p-5">
                <p class="inline label text-center font-medium text-3xl">FIGHT #</p>
                <p class="inline text-3xl font-medium">1</p>
            </div>
            <p class="text-green-med font-bold text-center text-3xl lg:text-4xl my-2 lg:mt-5 order-2 lg:order-2">OPEN</p>
        </div>
        <div class="betting__container--radio">
            <label>
                <input type="radio" class="hidden" name="sidePicker" id="">
                <span class="side--checkmark--radio meron--radio">MERON</span>
            </label>
            <label>
                <input type="radio" class="hidden"  name="sidePicker" id="">
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
            min="100" v-model="iAmount">
            <p class="block text-red-high text-sm text-center" :class="{'hidden': errAmount}">Amount has to be greater than or equal to 100</p>
            <button 
            class="absolute right-0 top-0 rounded-[0] bg-green-med h-11 rounded-r px-3 hover:bg-green-low ease-in-out transition-colors duration-200" @click="getAmount()">SUBMIT</button>
        </div>
        <div class="betting__container--amount mt-8">
            <div class="bet__button--row">
                <button class="button--amount" :disabled="{disableButtonAmount}">100</button>
                <button class="button--amount">200</button>
                <button class="button--amount">300</button>
            </div>
            <div class="bet__button--row">
                <button class="button--amount">500</button>
                <button class="button--amount">1000</button>
                <button class="button--amount">2000</button>
            </div>
        </div>
        
    </div>
</template>
<script>
export default {
    name: 'betting',
    data() {
        return {
            iAmount: "",
            errAmount:true,
        }
    },
    methods: {
        getAmount: function() {
            if ( this.iAmount < 100 || this.iAmount === null){
                return this.errAmount = false;
            } else {
                return this.errAmount = true;
            }
        },
        
    },
}
</script>
<style scoped>
.betting__container--radio {
    @apply flex flex-row items-center justify-between gap-4 lg:gap-14 lg:mt-11
} 
.betting__container--counter {
    @apply flex flex-row items-center gap-4 lg:gap-14 justify-between 
}
.bet__button--row {
    @apply flex flex-row justify-evenly w-full mt-4 gap-2;
}
.button--amount {
    @apply w-24 h-16 bg-blue-med rounded border-2 border-blue-high text-2xl font-bold transition-colors duration-200 ease-in-out focus:outline-blue-high focus:outline-none outline-1 focus:bg-blue-white hover:bg-blue-white
}
.button--amount:disabled {
    @apply bg-gray-high border-black-high;
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