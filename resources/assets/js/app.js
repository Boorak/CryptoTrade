/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('noty', require('./components/Noty.vue'));
Vue.component('tickers', require('./components/Tickers'));
Vue.component('balance', require('./components/Balance.vue'));
Vue.component('order-buy', require('./components/OrderBuy.vue'));
Vue.component('order-sell', require('./components/OrderSell.vue'));
Vue.component('exchange', require('./components/Exchange.vue'));
Vue.component('order-history', require('./components/OrderHistory.vue'));
Vue.component('order-book', require('./components/OrderBook.vue'));
Vue.component('deposit', require('./components/Deposit.vue'));

/**
 * Widgets
 */

Vue.component('panel', require('./components/widget/Panel.vue'));

const app = new Vue({
    el: '#app',
});
