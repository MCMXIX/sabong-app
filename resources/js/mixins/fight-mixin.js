export const fightMixin = {
    methods: {
        /**
         * getFightStatus
         * @param {string} sStatus 
         * @return string
         */
        getFightStatus(sStatus) {
            switch(sStatus) {
                case 'O': 
                    return 'OPEN';
                case 'C':
                    return 'CLOSED';
                default:
                    return '----';
            }
        },

        /**
         * getStatusTextColor
         * @param {string} sStatus 
         * @return string
         */
        getStatusTextColor(sStatus) {
            return ((sStatus === 'O') ? 'text-green-med' : 'text-gray-med');
        },

        /**
         * getFormattedTotalBet
         * @param {int} iAmount 
         * @returns 
         */
        getFormattedTotalBet(iAmount) {
            return (!!iAmount === false) ? iAmount : iAmount.toLocaleString();
        }
    }
}