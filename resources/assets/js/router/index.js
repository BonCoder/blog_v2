import Vue from 'vue';
import VueRouter from 'vue-router';

//引入模板
import hello from '../pages/hello.vue';

Vue.use(VueRouter);

//定义路由
const routes = [
    { path: '/',component:hello },
];

export default new VueRouter({
    routes,
    mode: 'hash',
});