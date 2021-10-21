import moment from 'moment';

export default {
    data() {
        return {
            defaultCurrency: 'USD'
        }
    },

    methods: {
        createMoment(date) {
            return moment(date)
        },

        formatAmount(amount, currency) {
            return  `${currency ? currency : this.defaultCurrency} ${new Intl.NumberFormat().format(amount)}`
        }

    }
}