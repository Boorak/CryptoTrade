<template>
    <form class="form-horizontal" @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)"
          autocomplete="off">
        <div class="panel ng-bg-dark">
            <div class="panel-heading">
                <h5 class="panel-title text-center">فروش</h5>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div>
                        <label>{{'قیمت '+currencyName}}</label>
                        <input type="text" class="form-control" name="price" v-model="price">
                        <span class="text-danger help-block" v-if="errors.has('price')"
                              v-text="errors.get('price')"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label>{{'مقدار '+assetName}}</label>
                        <input type="text" class="form-control" name="amount" v-model="amount">
                        <span class="text-danger help-block" v-if="errors.has('amount')"
                              v-text="errors.get('amount')"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label>جمع کل</label>
                        <input type="text" class="form-control" :value="price * amount">
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <button v-if="signedIn" type="submit" class="btn btn-danger btn-block" :disabled="errors.any()">
                            فروش
                        </button>
                        <a href="/login" v-else="signedIn" class="btn btn-primary btn-block">ورود</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>

    class Errors {

        constructor() {
            this.errors = {};
        }

        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }

        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        any() {
            return Object.keys(this.errors).length > 0;
        }

        record(errors) {
            this.errors = errors;
        }

        clear(field) {
            delete this.errors[field];
        }

    }

    export default {
        name: "order-sell",
        data() {
            return {
                price: '',
                amount: '',
                currency_id: 1, //Default Currency ID
                asset_id: 2, //Default Asset ID
                asset: 'BTC', //Default Asset Symbol
                currency: 'USD', //Default Currency Symbol
                errors: new Errors(),
            }
        },

        created() {
            Event.$on('onSelectedPair', data => {
                this.currency_id = data.currency.id;
                this.asset_id = data.asset.id;
                this.asset = data.asset.symbol;
                this.currency = data.currency.symbol;
            });
        },

        methods: {

            onSubmit() {
                axios.post('api/v1/trade/ordersell ', this.$data)
                    .then(this.onSuccess)
                    .catch(error => {
                        this.errors.record(error.response.data)
                        if (error.response.status == 403) {
                            this.onError();
                        }
                    })
                ;
            },

            onSuccess() {
                notify('success', 'سفارش خرید با موفقیت ثبت شد.');
                this.price = '';
                this.amount = '';
                Event.$emit('orderApplied')
            },

            onError() {
                notify('error', 'موجودی کافی نیست.');
                this.price = '';
                this.amount = '';
            }
        },

        computed: {

            /**
             * @returns {computed.signedIn|signedIn}
             */
            signedIn() {
                return window.App.signedIn;
            },

            /**
             * @returns {string}
             */
            assetName: function () {
                return this.asset.toUpperCase();
            },

            /**
             * @returns {string}
             */
            currencyName: function () {
                return this.currency.toUpperCase();
            }

        },
    }
</script>

<style scoped>

</style>