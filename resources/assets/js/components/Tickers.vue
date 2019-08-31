<template>
    <div>
        <ticker-screen></ticker-screen>
        <panel title="نرخ ارزها">
            <div slot="body">
                <div class="table-responsive pre-scrollable">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="v-bg-dark">
                            <th>نماد</th>
                            <th>ارز</th>
                            <th class="text-center">تغییرات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="ticker in tickers">
                            <td>
                                <img :src="'images/logo/'+ ticker.symbol.toUpperCase() + '.svg'" alt="بیتکوین"
                                     class="v-tiny-svg">
                            </td>
                            <td>{{ticker.symbol | uppercase }}</td>
                            <td>
                                <table class="table table-borderless table-condensed table-hover"
                                       style="background: #263238;">
                                    <tbody>
                                    <tr v-for="currency in ticker.currencies" @click="onPairs(ticker,currency)"
                                        style="cursor: pointer;">
                                        <td>
                                            {{currency.symbol | uppercase }}
                                        </td>
                                        <td>
                                            {{currency.price | currency('') }}
                                        </td>
                                        <td :style="{color: currency.percent_color}">
                                            %{{currency.percent_change}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </panel>
    </div>
</template>

<script>

    import TickerScreen from './TickerScreen.vue';

    export default {

        name: "tickers",

        components: {TickerScreen},

        data() {

            return {
                tickers: [],
            }

        },

        created() {

            this.getTickers();

            /**
             * Fetch all tickers
             *
             * Public Channel
             */
            window.Echo.channel('ticker').listen('Ticker', (e) => {
                this.getTickers();
            });
        },

        methods: {

            getTickers() {
                axios.get('api/v1/trading/tickers').then(response => this.tickers = response.data);
            },

            onPairs(asset, currency) {
                Event.$emit('onSelectedPair', {
                    asset: asset,
                    currency: currency,
                });
            },
        },

        filters: {

            round: function (num) {
                return Math.round(num);
            }

        },
    }
</script>

<style scoped>

</style>