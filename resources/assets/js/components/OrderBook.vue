<template>
    <panel title="معاملات">
        <div slot="body">
            <div>
                <div class="col-md-6">
                    <div class="table-responsive pre-scrollable">
                        <table class="table table-condensed">
                            <thead>
                            <tr class="bg-success">
                                <th>قیمت</th>
                                <th>مقدار</th>
                                <th>نوع معامله</th>
                                <th>تاریخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="orderBuy in orderBuys" class="bar-bids"
                                :style="{'background-size': getRandomInt()+'% '+'100%'}">
                                <td>{{orderBuy.price}}</td>
                                <td>{{orderBuy.amount - orderBuy.fill}}</td>
                                <td>{{orderBuy.pair.pair | uppercase}}</td>
                                <td>{{orderBuy.created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive pre-scrollable">
                        <table class="table table-condensed">
                            <thead>
                            <tr class="bg-danger">
                                <th>قیمت</th>
                                <th>مقدار</th>
                                <th>نوع معامله</th>
                                <th>تاریخ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="orderSell in orderSells" class="bar-asks"
                                :style="{'background-size': getRandomInt()+'% '+'100%'}">
                                <td>{{orderSell.price}}</td>
                                <td>{{orderSell.amount - orderSell.fill}}</td>
                                <td>{{orderSell.pair.pair | uppercase}}</td>
                                <td>{{orderSell.created_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </panel>
</template>

<script>
    export default {

        name: "order-book",

        data() {
            return {
                orderSells: [],
                orderBuys: [],
            }
        },


        mounted() {
            this.getSellsOrderBook();
            this.getBuysOrderBook();
        },

        created() {

            /**
             * Public Channel
             */
            window.Echo.channel('order-book').listen('OrderBook', e => {
                if (e.order.type == 'خرید') {
                    this.orderBuys.push(e.order);
                } else {
                    this.orderSells.push(e.order);
                }
            });

            window.Echo.channel('order-book-confirm').listen('OrderBookConfirm', () => {
                this.getSellsOrderBook();
                this.getBuysOrderBook();
            });
        },

        methods: {

            getSellsOrderBook() {
                axios.get('/api/v1/trade/orderbook/sell').then(response => this.orderSells = response.data);
            },

            getBuysOrderBook() {
                axios.get('/api/v1/trade/orderbook/buy').then(response => this.orderBuys = response.data);
            },

            getRandomInt() {
                return Math.floor(Math.random() * (100 - 10 + 1)) + 10;
            }
        }
    }
</script>

<style scoped>
    .bar-bids {
        background: linear-gradient(#1B5E20);
        background-repeat: no-repeat;
    }

    .bar-asks {
        background: linear-gradient(#B71C1C);
        background-repeat: no-repeat;
    }
</style>