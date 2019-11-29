/*
 |-------------------------------------------------------------------------------
 | routes.js
 |-------------------------------------------------------------------------------
 | Contains all of the routes for the application
 */

/**
 * Imports Vue and VueRouter to extend with the routes.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store.js';


/**
 * Extends Vue to use Vue Router
 */
Vue.use( VueRouter );
/**
 * Makes a new VueRouter that we will use to run all of the routes for the app.
 */

export default new VueRouter({
    // mode:'history',
    srcollBehavior(to,from,savedPosition){
        if(to.hash){
            return {
                selector:to.hash
            }
        }
    },
    routes: [
        {
            path: '/',
            redirect: {name: '首页'},
            name: 'Bob`s Blog',
            components: Vue.component( 'Layout', require( './pages/Layout' ) ),
            beforeEnter:requireConfigs,
            children: [
                {
                    path: 'index',
                    name: '首页',
                    components: Vue.component( 'Index', require( './pages/Index.vue' ) ),
                    children: [
                        {
                            path: 'comment/:comment',
                            name: '热门评论',
                            components: Vue.component( 'Index-Comment', require( './pages/Index.vue' ) )
                        },
                        {
                            path: 'category/:category',
                            name: '热门分类',
                            components: Vue.component( 'Index-Category', require( './pages/Index.vue' ) )
                        }
                    ]
                },
                {
                    path: 'edit',
                    name: '写作',
                    components: Vue.component( 'Edit', require( './pages/Edit' ) ),
                    beforeEnter: requireAuth,
                    children: [
                        {
                            path: 'art/:art',
                            name: '编辑文章',
                            components: Vue.component( 'Edit', require( './pages/Edit' ) ),
                        },
                    ]
                },
                {
                    path: 'blog',
                    name: '博客园',
                    components: Vue.component( 'Blog', require( './pages/Blog' ) ),
                    children: [
                        {
                            path: 'user/:user',
                            name: '用户文章',
                            components: Vue.component( 'Blog-User', require( './pages/Blog' ))
                        },
                        {
                            path: 'tag/:tag',
                            name: '标签文章',
                            components: Vue.component( 'Blog-Tag', require( './pages/Blog' ) )
                        },
                        {
                            path: 'category/:category',
                            name: '分类文章',
                            components: Vue.component( 'Blog-Category', require( './pages/Blog' ) )
                        },
                        {
                            path: 'search/:search',
                            name: '查找文章',
                            components: Vue.component( 'Blog-Category', require( './pages/Blog' ) )
                        },
                    ]
                },
                {
                    path: 'manager',
                    name: '文章管理',
                    components: Vue.component( 'Blog', require( './pages/user/Blog' ) ),
                    children: [
                        {
                            path: 'owner/:owner',
                            name: '我的文章',
                            components: Vue.component( 'Blog-MyBlog', require( './pages/user/Blog' ) ),
                            beforeEnter: requireAuth,
                        },
                        {
                            path: 'private/:private',
                            name: '私有文章',
                            components: Vue.component( 'Blog-Private', require( './pages/user/Blog' ) ),
                            beforeEnter: requireAuth,
                        },
                        {
                            path: 'draft/:draft',
                            name: '草稿箱',
                            components: Vue.component( 'Blog-Draft', require( './pages/user/Blog' ) ),
                            beforeEnter: requireAuth,
                        }
                    ]
                },
                {
                    path: 'art/:art_id',
                    name: '查看文章',
                    components: Vue.component( 'Article', require( './pages/Art' ) ),
                },
                {
                    path: 'archive/:user',
                    name: '归档',
                    components: Vue.component( 'Archive', require( './pages/Archive' ) ),
                },
                {
                    path: 'home/:user',
                    name: '主页',
                    components: Vue.component( 'Home', require( './pages/Home' ) ),
                },
                {
                    path: 'about',
                    name: '关于我',
                    components: Vue.component( 'About', require( './pages/About' ) ),
                },
            ]
        },
        {
            path: '*',
            name: 'error',
            components: Vue.component( 'error', require( './pages/Error/404' ) )
            ,
        }
    ]
});
