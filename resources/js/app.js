/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from "vue";

import router from "./router";
import App from "./App.vue";

window.axios = require("axios");

Vue.config.productionTip = false;


window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
// http://www.o-zn.com/
// http://www.bone-ozone.com/

window.axios.interceptors.request.use(
    function(config) {
        // Do something before request is sent
        const AUTH_TOKEN = localStorage.getItem('auth.token');

        if (AUTH_TOKEN) {
            config.headers.common["Authorization"] = `Bearer ${AUTH_TOKEN}`;
        }
        config.headers["Content-Type"] = "application/json";
       
        return config;
    },
    function(error) {
        // Do something with request error
        return Promise.reject(error);
    }
);



new Vue({
    router,
    render: (h) => h(App),
}).$mount("#app");
