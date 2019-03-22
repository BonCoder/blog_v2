export default {
  totalCount (state) {
    return state.cart.reduce((result, item) => {
      result += item.count
      return result
    }, 0)
  },
  totalCheckedCount (state) {
    return state.cart.reduce((result, item) => {
      if (item.isChecked === true) {
        result += item.count
      }
      return result
    }, 0)
  },
  isAllChecked (state) {
    return state.cart.every(item => item.isChecked === true)
  }
}
