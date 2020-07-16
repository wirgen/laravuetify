import Vue from 'vue'
import App from './views/App'
import router from './routes'
import './middleware'

Vue.config.productionTip = false

new Vue({
  el: '#app',
  components: { App },
  router,
})
