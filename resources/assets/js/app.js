/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from "vue";
import VueDragTree from "vue-drag-tree";
import "vue-drag-tree/dist/vue-drag-tree.min.css";
import cncVueTree from "cnc-vue-jstree";

Vue.use(VueDragTree);

require("./bootstrap");

window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("test", require("./components/Test.vue"));
Vue.component("test2", require("./components/Test2.vue"));
Vue.component("cnc-vue-jstree", cncVueTree);
// Vue.component("vue-drag-tree", VueDragTree);
// Vue.component("vddl-list", Vddl);

new Vue({
    el: "#app"
});
