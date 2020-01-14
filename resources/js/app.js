import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import VueAxios from 'vue-axios'
import Axios from 'axios'
import FormUpload from '~/components/FormUpload'

import '~/plugins'
import '~/components'

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  VueAxios,
  Axios,
  FormUpload,
  ...App
})

Vue.prototype.$axios =  Axios
