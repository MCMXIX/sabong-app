<template>
    <div class="absolute w-full left-0 bg-black-dark h-screen top-0 pt-[96px]">
        <div class="game--status--left  pt-4">
            <div class="text-center shadow-lg bg-gray-med w-1/4 py-5 mx-auto">
                <p class="inline label text-center font-medium text-4xl">FIGHT #</p>
                <p class="inline text-4xl font-medium">1</p>
            </div>
            <div class="status--betting w-full mt-4">
                <h1 class="text-center text-green-med">OPEN</h1>
            </div>
            <div class="bet--status w-full mt-24">
                <div class="bet--status--sides flex">
                    <h1 class="w-full text-center bg-green-med py-4">MERON</h1>
                    <h1 class="w-full text-center bg-red-med py-4">WALA</h1>
                </div>
                <div class="bet--status--stake">
                    <div class="side--text--results flex text-center mt-8">
                        <div class="meron--stake--result w-full">
                            <p class="total-bets text-8xl">35,563</p>
                            <p class="winning-chance text-4xl">192.16%</p>
                        </div>
                        <div class="meron--stake--result w-full">
                            <p class="total-bets text-8xl">35</p>
                            <p class="winning-chance text-4xl">187.16%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="game--status--right bg-gray-dark mt-4">
            <fight-results/>
        </div>
    </div>
</template>

<script>
import FightResults from '../components/fightResults.vue'
export default {
    name: 'home',
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
.content__container {
    min-height: -webkit-fill-available;
    @apply lg:h-screen flex flex-col max-w-[1280px] lg:bg-black-dark mx-auto lg:shadow-lg;
}
</style>