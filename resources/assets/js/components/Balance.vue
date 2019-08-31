<template>
    <panel title="کیف پول">
        <div slot="body">
            <div class="table-responsive pre-scrollable">
                <table class="table table-condensed">
                    <thead>
                    <tr class="v-bg-dark">
                        <th></th>
                        <th>واحد</th>
                        <th class="text-center">موجودی</th>
                    </tr>
                    </thead>
                    <tbody v-if="signedIn">
                    <tr v-for="balance in balances">
                        <td>
                            <img :src="'images/logo/' + balance.ac.symbol.toUpperCase() + '.svg'" alt="دلار"
                                 class="v-tiny-svg">
                        </td>
                        <td>{{balance.ac.symbol | uppercase}}</td>
                        <td>
                            <table class="table table-borderless table-condensed"
                                   style="background: #263238;">
                                <tbody>
                                <tr>
                                    <td>{{balance.amount}}</td>
                                </tr>
                                <tr>
                                    <td>{{balance.available}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div v-if="!signedIn" class="row">
                    <p class="text-center">
                        داده‌ای موجود نیست لطفا وارد شوید
                    </p>
                </div>
            </div>
        </div>
    </panel>
</template>

<script>
    export default {

        name: "balance",

        data() {
            return {
                balances: '',
            }
        },

        created() {

            if (this.signedIn) {

                this.getUserBalance();
                this.updateUserBalanceOnEventTrigger();

                window.Echo.channel('order-confirm.' + window.App.user.id).listen('OrderConfirm', () => {
                    this.getUserBalance();
                });

            }

        },

        methods: {

            getUserBalance() {
                axios.get('api/v1/trade/user/balance')
                    .then(response => this.balances = response.data)
                ;
            },

            updateUserBalanceOnEventTrigger() {
                Event.$on('orderApplied', () => this.getUserBalance());
                Event.$on('orderDeleted', () => this.getUserBalance());
            },
        },

        computed: {

            /**
             * @returns {computed.signedIn|signedIn}
             */
            signedIn() {
                return window.App.signedIn;
            },
        },
    }
</script>

<style scoped>

</style>