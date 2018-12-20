/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('birthday-picker', require('./components/BirthdayPicker.vue').default);
Vue.component('exchange-viewer', require('./components/ExchangeViewer.vue').default);
Vue.component('past-response-list', require('./components/PastResponseList.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Global filter for date formatting
var moment = require('moment');
Vue.filter('readabledate', function(date) {
    return moment(date).format("Do MMMM YYYY");
});

window.addEventListener('load', function() {
    const app = new Vue({
        el: '#app',
        data: {
            allow_submission: true,
            api_result: null,
            past_submissions_result: null,
            api_down: false
        },
        methods: {
            enhanced_fetch_json: (url) => new Promise((resolve, reject) => fetch(url)
                .then((request) => request.json()
                    .then((json) => resolve(json))
                    .catch(reject)
                ).catch(reject)
            ),
            historical: function(day, month) {
                return this.enhanced_fetch_json(`/api/historical/${day}/${month}`)
                    .then(result => this.api_result = result)
                    .catch(error => this.api_down = true);
            },
            past_submissions: function() {
                return this.enhanced_fetch_json(`/api/historical`)
                    .then(data => this.past_submissions_result = data)
                    .catch(error => this.api_down = true);
            },
            birthday_submitted: function(event) {
                this.allow_submission = false;
                this.historical(event.day, event.month);
            },
            restart: function() {
                this.allow_submission = true;
                this.api_result = null;
                this.past_submissions_result = null;
                this.past_submissions();
            },
            open: function(date) {
                this.allow_submission = false;
                this.historical(date.split('-')[1], date.split('-')[2]);
            }
        },
        mounted: function() {
            this.past_submissions().then(data => this.past_submissions_result = data);
        }
    });
});