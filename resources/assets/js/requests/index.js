import axios from 'axios'

const $http = axios.create({
  baseURL: 'http://www.blog.com'
})

$http.interceptors.request.use(config => {
  return config
})

$http.interceptors.response.use(resp => {
  return resp
})

export default $http