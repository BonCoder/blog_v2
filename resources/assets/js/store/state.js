const initUser = {
  isLogin: false,
  username: '',
  token: ''
}
export default {
  cart: JSON.parse(window.localStorage.getItem('xxxxx-cart')) || [],
  user: JSON.parse(window.localStorage.getItem('xxxxx-user')) || initUser,
  isSubpage: false,
  pageTitle: '首页',
  addressProvince: '四川',
  addressCity: '成都',
  cityPickerVisible: false
}
