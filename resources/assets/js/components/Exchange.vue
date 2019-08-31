<template>
    <panel title="فرم سفارش">
        <div slot="body" class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <order-buy></order-buy>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <order-sell></order-sell>
            </div>
        </div>
    </panel>
</template>

<script>

    export default {

        name: "exchange",

        created() {

            if (this.signedIn) {
                window.Echo.channel('order-confirm.' + window.App.user.id).listen('OrderConfirm', (e) => {
                    notify('info', this.sendConfirmOrderMsg(e.order, e.price));
                });
            }

        },

        methods: {

            /**
             * @param $order
             * @param $price
             * @returns {string}
             */
            sendConfirmOrderMsg($order, $price) {
                return "سفارشی با مقدار " + $order.amount + " روی قیمت " + $price + " انجام شد. ";
            },

        },

        computed: {

            signedIn() {
                return window.App.signedIn;
            }

        },
    }
</script>

<style scoped>

</style>