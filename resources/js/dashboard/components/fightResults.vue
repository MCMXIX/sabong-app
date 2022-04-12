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
        <div class="results table-fixed w-full os-theme-dark" style="max-height:210px;">
            <table class="table-fixed w-full">
            
                <thead class="hidden">
                    <tr>
                        <th>FIGHT NUMBER</th>
                        <th>WINNING SIDE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(oFightResult, iIndex) in this.aSetFightResult" :key="iIndex" :class="getFightResultClass(oFightResult.game_winner)">
                        <td class="fight--number">#{{ oFightResult.fight_no }}</td>
                        <td class="side--results">{{ oFightResult.game_winner }}</td>
                    </tr>
                </tbody>
            </table>
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
        }
    },
    methods : {
        ...mapActions('oFight', ['getFightResults']),

        /**
         * getFightResultClass
         * @param {string} sFightResult
         * @return string
         */
        getFightResultClass(sFightResult) {
            switch (sFightResult) {
                case 'MERON':
                    return 'results--meron--winner';
                case 'WALA':
                    return 'results--wala--winner';
                default:
                    return 'results--draw--winner';
            }
        }
    }
}
</script>
<style scoped>
.table__container {
    @apply rounded border-2
}
tbody {
    @apply overflow-hidden min-w-full
}
thead tr {
    background: linear-gradient(180deg, #1371FF 0%, #0066FF 100%);
    @apply mt-5;
}
th {
    @apply py-4 top-0 ;
}
tbody td {
    @apply py-2 text-center uppercase w-1/2;
}
tbody tr{
    @apply  border-t-2 w-full snap-start;
}
.results {
    @apply overflow-auto snap-proximity scroll-auto;
    
}
.side--results {
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