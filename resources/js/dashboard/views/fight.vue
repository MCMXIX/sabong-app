<template>
    <div class="fight w-4/5 mt-4 lg:mt-14 mx-auto container">
        <div class="fight__container--info bg-gray-dark shadow-lg rounded-lg p-2 lg:p-5 flex flex-col lg:flex-row justify-between">
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
            <button class="button--secondary">DONE</button>
        </div>
        <div class="fight__container--results mt-7 w-4/5 mx-auto">
            <fight-results/>
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
        }
    },
    computed: {

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
</style>