<template>
    <panel title="تاریخچه معاملات">
        <div slot="body">
            <div>
                <div class="table-responsive pre-scrollable table-condensed">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="v-bg-dark">
                            <th>معامله</th>
                            <th>میزان</th>
                            <th>قیمت</th>
                            <th>پر شده</th>
                            <th>نوع معامله</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody v-if="signedIn">
                        <tr v-for="order in sortedOrders">
                            <td>{{order.type}}</td>
                            <td>{{order.amount | round}}</td>
                            <td>{{order.price | currency}}</td>
                            <td>{{(order.fill * 100) / order.amount}} %</td>
                            <td>{{order.pair.pair | uppercase}}</td>
                            <td>{{order.created_at}}</td>
                            <td v-if="order.status == 'confirmed'">
                                <span class="label bg-success">انجام شده</span>
                            </td>
                            <td v-else>
                                <span class="label bg-info">در انتظار</span>
                            </td>
                            <td v-if="order.status != 'confirmed'">
                                <ul class="icons-list" style="color: #CFD8DC;">
                                    <!--<li>-->
                                    <!--<a @click="update(order)">-->
                                    <!--<i class="icon-pencil7"></i>-->
                                    <!--</a>-->
                                    <!--</li>-->
                                    <li>
                                        <a @click="destroy(order)">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                            <td v-else>
                                -
                                <!--Just show Empty column-->
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
                <!--<div id="modal_default" class="modal fade">-->
                <!--<div class="modal-dialog">-->
                <!--<div class="modal-content">-->
                <!--<div class="modal-header">-->
                <!--<button type="button" class="close text-white" data-dismiss="modal">&times;</button>-->
                <!--</div>-->
                <!--<div class="modal-body">-->
                <!--<form class="form-horizontal" @submit.prevent="onSubmit"-->
                <!--@keydown="errors.clear($event.target.name)">-->
                <!--<div class="panel ng-bg-dark">-->
                <!--<div class="panel-heading">-->
                <!--<h5 class="panel-title">-->
                <!--{{selectedOrder.type}}-->
                <!--</h5>-->
                <!--</div>-->
                <!--<div class="panel-body">-->
                <!--<div class="form-group">-->
                <!--<label class="col-lg-3 control-label">قیمت:</label>-->
                <!--<div class="col-lg-9">-->
                <!--<input type="text" class="form-control js-order-price" name="price"-->
                <!--v-model="price = selectedOrder.price">-->
                <!--<span class="text-danger help-block" v-if="errors.has('price')"-->
                <!--v-text="errors.get('price')"></span>-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="form-group">-->
                <!--<label class="col-lg-3 control-label">مقدار:</label>-->
                <!--<div class="col-lg-9">-->
                <!--<input type="text" class="form-control js-order-amount"-->
                <!--name="amount"-->
                <!--v-model="amount = selectedOrder.amount">-->
                <!--<span class="text-danger help-block" v-if="errors.has('amount')"-->
                <!--v-text="errors.get('amount')"></span>-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="form-group">-->
                <!--<label class="col-lg-3 control-label">کل مبلغ:</label>-->
                <!--<div class="col-lg-9">-->
                <!--<input type="text" class="form-control js-order-total"-->
                <!--:value="price * amount">-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="text-right">-->
                <!--<button type="submit" class="btn btn-success" :disabled="errors.any()">-->
                <!--ویرایش <i-->
                <!--class="icon-arrow-left13 position-right"></i></button>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</form>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <!-- /basic modal -->
            </div>
        </div>
    </panel>
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

        name: "order-history",

        data() {

            return {
                orders: [],
                selectedOrder: '',
                uriAction: '',
                errors: new Errors(),
            }

        },

        created() {

            if (this.signedIn) {

                this.getOrderHistory();
                Event.$on('orderApplied', () => this.getOrderHistory());
                window.Echo.channel('order-confirm.' + window.App.user.id).listen('OrderConfirm', () => {
                    this.getOrderHistory();
                });

            }
        },

        methods: {

            /**
             * Fetch all user orders
             */
            getOrderHistory() {
                axios.get('/api/v1/trade/user/orders/history')
                    .then(response => this.orders = response.data)
                    .catch(error => console.log(error.response.data))
                ;
            },

            destroy(order) {
                this.selectedOrder = order;
                this.setOrderType();
                axios.delete('api/v1/trade/' + this.uriAction + '/' + this.selectedOrder.id + '/delete')
                    .then(() => {
                        this.onSuccessDelete(order);
                    });
            },

            setOrderType() {
                if (this.selectedOrder.type == 'خرید') {
                    this.uriAction = "orderbuy";
                } else {
                    this.uriAction = "ordersell";
                }
            },

            removeOrderFromList() {
                var index = this.orders.indexOf(this.selectedOrder);
                this.orders.splice(index, 1);
            },

            onSuccessDelete(order) {
                this.removeOrderFromList(order);
                notify('info', 'سفارش با موفقیت حذف شد.');
                Event.$emit('orderDeleted');
            },

            // update(order) {
            //     this.selectedOrder = order;
            //     this.showModal();
            // },


            // onSubmit() {
            //     this.checkOrderType();
            //     axios.patch('api/v1/trade/' + this.uriAction + '/' + this.selectedOrder.id + '/update', this.$data)
            //         .then(this.onSuccess)
            //         .catch(error => this.errors.record(error.response.data))
            //     ;
            // },


            // showModal() {
            //     $("#modal_default").modal('show');
            // },


            // onSuccess(response) {
            //     this.removeOrderFromList();
            //     this.orders.push(response.data);
            //     this.price = '';
            //     this.amount = '';
            //     $("#modal_default").modal('hide');
            //     notify('info', 'سفارش با موفقیت ویرایش شد.')
            // },
        },

        computed: {

            signedIn() {
                return window.App.signedIn;
            },

            sortedOrders() {
                return _.orderBy(this.orders, ['id'], ['desc']);
            },
        },

        filters: {

            round(num) {
                return num;
            },

        },
    }
</script>

<style scoped>

</style>