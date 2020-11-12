import Vue from 'vue';
import ElementUI from 'element-ui';
import DeveloperTest from './components/DeveloperTest'

import 'element-ui/lib/theme-chalk/index.css';

require('./bootstrap');

Vue.config.productionTip = false;
Vue.config.runtimeCompiler = true;

Vue.use(ElementUI);

new Vue({
    el: '#app',
    template: '<DeveloperTest/>',
    components: { DeveloperTest }
});
