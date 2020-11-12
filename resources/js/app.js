import Vue from 'vue';
import DeveloperTest from './components/DeveloperTest'

require('./bootstrap');

Vue.config.productionTip = false;
Vue.config.runtimeCompiler = true;

new Vue({
    el: '#app',
    template: '<DeveloperTest/>',
    components: { DeveloperTest }
});
