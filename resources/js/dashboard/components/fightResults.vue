<template>
    <div class="table__container">
        <table class="table-fixed w-full">
            <thead>
                <tr>
                    <th>FIGHT NUMBER</th>
                    <th>WINNING SIDE</th>
                </tr>
            </thead>
        </table>
        <div class="results table-fixed w-full" id="table-container" style="max-height:210px;">
            <div class="fight--row__container" v-for="(oFightResult, iIndex) in this.aSetFightResult" :key="iIndex" :class="getFightResultClass(oFightResult.game_winner)">
                <p class="fight-number__text">#{{ oFightResult.fight_no }}</p>
                <p class="side-result__text">{{ oFightResult.game_winner }}</p>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'fightResults',
    data() {
        return {
        }
    },
    mounted() {
        this.getFightResults();
        //WEBSOCKET FOR FIGHT RESULTS
        window.Echo.channel('fightResults')
            .listen('FightResults', (aFightResults)=> {
                this.$store.commit('oFight/SET_FIGHT_RESULTS', aFightResults);
            });
            
    },
    computed : {
        ...mapGetters('oFight', ['aFightResults']),
        
        /**
         * aSetFightResult
         * @return array
         */
        aSetFightResult() {     
            let aFights = this.aFightResults;
            for (const iKey in aFights) {     
                switch(aFights[iKey].game_winner) {
                case 'M':
                    aFights[iKey].game_winner = 'MERON';
                    break;
                case 'W':
                    aFights[iKey].game_winner = 'WALA';
                    break;
                case 'D':
                    aFights[iKey].game_winner = 'DRAW';
                    break;
                default:
                    aFights[iKey].game_winner = 'CANCELLED';
                    break;
                }
            }
            return aFights;
        },
        
    },
    methods : {
        ...mapActions('oFight', ['getFightResults']),

        /**
         * getFightResultClass
         * @param {string} sFightResult
         * @return string
         */
        getFightResultClass(sFightResult) {
            this.goDown();
            switch (sFightResult) {
                case 'MERON' :
                    return 'results--meron--winner';
                case 'WALA':
                    return 'results--wala--winner';
                default:
                    return 'results--draw--winner';
            }
        },
        goDown() {
            var container = this.$el.querySelector("#table-container");
            container.scrollTop = container.scrollHeight;
        }
        
    }, updated() {
        this.goDown();
    }
}
</script>
<style scoped>
.table__container {
    @apply rounded border-2
}
tbody {
    @apply overflow-hidden min-w-full;
}
thead tr {
    background: linear-gradient(180deg, #1371FF 0%, #0066FF 100%);
    @apply mt-5;
}
th {
    @apply py-4 top-0 ;
}
.results {
    @apply overflow-auto snap-proximity scroll-auto;
    
}
.fight--row__container {
    @apply flex snap-start
}
.fight--row__container *{
    @apply inline w-full text-center py-2 border-t-2
}
.side-results__text {
    @apply font-bold;
}
.results--meron--winner {
    background: linear-gradient(180deg, #17AC42 0%, rgba(23, 172, 66, 0.85) 50%, #17AC42 100%);
} 
.results--wala--winner {
    background: linear-gradient(180deg, #941925 0%, rgba(148, 25, 37, 0.85) 50%, #941925 100%);
} 
.results--draw--winner {
    background: linear-gradient(180deg, #17AC42 0%, #3E403E 0.01%, #4A4B49 50%, #3E403E 100%);
}
</style>