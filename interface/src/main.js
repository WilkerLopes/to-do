import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { BootstrapVue } from 'bootstrap-vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { dom, library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'

dom.watch()
library.add(fas)

import './styles/main.scss'

Vue.use(BootstrapVue)
Vue.component('font-icon', FontAwesomeIcon)
Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: function(h) { return h(App) }
}).$mount('#app')