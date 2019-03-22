export default {
  toggleCityPickerVisible (state) {
    state.cityPickerVisible = !state.cityPickerVisible
  },
  changeCurrentAddress (state, address) {
    state.addressProvince = address[0]
    state.addressCity = address[1]
  },
  changePageTitle (state, title) {
    state.pageTitle = title
  },
  toggleIsSubpage (state, isSubpage = false) {
    state.isSubpage = isSubpage
  },
  toggleItemChecked (state, id) {
    state.cart = state.cart.map(item => {
      if (item.id === id) {
        item.isChecked = !item.isChecked
      }
      return item
    })
  },
  toggleCheckAll (state, e) {
    const { checked } = e.target
    // const checked = !this.getters.isAllChecked
    state.cart = state.cart.map(item => {
      item.isChecked = checked
      return item
    })
  },
  reduceCartItem (state, id) {
    state.cart = state.cart.map(item => {
      if (item.id === id) {
        item.count--
      }
      return item
    })
  },
  addToCart (state, item) {
    const {
      id,
      cateID
    } = item
    const isInCart = state.cart.some((cartItem) => {
      return cartItem.id === id && cartItem.cateID === cateID
    })
    if (isInCart) {
      this.commit('addCartItem', id)
    } else {
      state.cart.push({
        ...item,
        count: 1,
        isChecked: false
      })
    }
  },
  addCartItem (state, id) {
    state.cart = state.cart.map(item => {
      if (item.id === id) {
        item.count++
      }
      return item
    })
  },
  loginSuccess (state, user) {
    state.user = {
      ...user,
      isLogin: true
    }
  }
}
