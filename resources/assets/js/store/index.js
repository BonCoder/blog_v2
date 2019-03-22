import Vue from 'vue'
import Vuex from 'vuex'
import state from './state'
import getters from './getters'
import mutations from './mutations'

const syncStorageCart = store => {
  store.subscribe((mutation, state) => {
    window.localStorage.setItem('xxxxx-cart', JSON.stringify(state.cart))
  })
}

const syncUser = store => {
  store.subscribe((mutation, state) => {
    window.localStorage.setItem('xxxxx-user', JSON.stringify(state.user))
  })
}

Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  state,
  getters,
  plugins: [syncStorageCart, syncUser],
  mutations
})
