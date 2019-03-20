import axios from 'axios'
import { Message, MessageBox } from 'element-ui'

// create an axios instance
const service = axios.create({
    baseURL: 'http://www.bob.com/', // api 的 base_url
    timeout: 5000, // request timeout
    // headers: {
    //     'Content-Type':'application/x-www-form-urlencoded',
    //     'X-Requested-With':'XMLHttpRequest'
    // }
})

// request interceptor
service.interceptors.request.use(
    config => {
        // Do something before request is sent
        config.headers['Content-Type'] = 'application/x-www-form-urlencoded'
        config.headers['X-Requested-With'] = 'XMLHttpRequest'
        return config
    },
    error => {
        // Do something with request error
        console.log(error) // for debug
        Promise.reject(error)
    }
)

// response interceptor
service.interceptors.response.use(
    // response => response,
    /**
     * 下面的注释为通过在response里，自定义code来标示请求状态
     * 当code返回如下情况则说明权限有问题，登出并返回到登录页
     * 如想通过 xmlhttprequest 来状态码标识 逻辑可写在下面error中
     * 以下代码均为样例，请结合自生需求加以修改，若不需要，则可删除
     */
    response => {
        return response
    },
    error => {
        if (!error.response) {
            Message({
                message: error.message,
                type: 'error',
                duration: 5 * 1000
            })
        } else {
            switch (error.response.status) {
                case 422:
                    Message({
                        message: error.response.data.message,
                        type: 'error',
                        duration: 5 * 1000
                    })
                    break
                case 401:
                    // 非法的token; 其他客户端登录了; Token 过期了;
                    MessageBox.alert('你已被登出，请重新登录', '系统提示', {
                        confirmButtonText: '重新登录',
                        type: 'warning',
                        showClose: false
                    }).then(() => {
                        store.dispatch('FedLogOut').then(() => {
                            location.reload() // 为了重新实例化vue-router对象 避免bug
                        })
                    })
                    break
                default:
                    Message({
                        message: error.message,
                        type: 'error',
                        duration: 5 * 1000
                    })
                    break
            }
            return Promise.reject(error)
        }
    }
)

export default service