import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

export default new VueRouter({
  saveScrollPosition: true,
  routes: [{
      path: '/',
      redirect: '/contant'
    }, {
      name: 'login',
      path: '/login',
      components: {
        login: resolve => void(require(['../components/login.vue'], resolve))
      }
    },
    {
      name: 'contant',
      path: '/contant',
      component: resolve => void(require(['../components/contant.vue'], resolve))
    },
    {
      name: 'detail',
      path: '/detail',
      component: resolve => void(require(['../components/detail.vue'], resolve))
    }
  ]
});