
import Vue from 'vue'
import Vuex from 'vuex'
import login from './modules/login'
import contact from './modules/contact'
import specialistPopUp from './modules/specialistPopUp'
import specialistList from './modules/specialists'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    login,
    contact,
    specialistPopUp,
    specialistList
  },
})
