/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the WebConfigs
*/

import WebAPI from '../api/web';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const web = {
    state: {
        //网站配置信息初始化
        configs:{
            data:{
                IMG_API: "https://s0.xinger.ink/acgimg/acgurl.php?",
                author: "Mozilan",
                contact: "https://mozilan.geekadpt.cn/img/custom/wechat_pub.png",
                contact_bak: "https://mozilan.geekadpt.cn//img/custom/wechat2.png",
                copyright: "© 2019-2022·蓝默空间·版权所有",
                message: "欢迎来到蓝默空间～",
                notice: "LvBlog 是我们应用的名称，“L” 是 Laravel 的缩写 , “v” 是 Vue 的缩写，本项目是基于 Laravel 5.8 + Vue 2 开发， 实现了 API 驱动和前后端分离、响应式的单页面博客类 WEB 应用。",
                record: "吉ICP备16007022号-5",
                time: "2019-10-25 00:00:00",
                title: "蓝默空间のLvBlog",
                urgent_message: null
            }
        },
        configsLoadStatus:0,
        friends:{
            data:{
                name:'',
                avatar:'',
                description:'',
                owner:'',
            }
        },
        setFriendsLoadStatus:''
    },
    actions:{
        loadConfigs({commit}){
            commit('setConfigsLoadStatus',1);
            WebAPI.getConfigs()
                .then(function (response) {
                    commit('setConfigs', response.data);
                    commit('setConfigsLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setConfigsLoadStatus', 3);
                });
        },
        loadFriends({commit}){
            commit('setFriendsLoadStatus',1);
            WebAPI.getFriends()
                .then(function (response) {
                    commit('setFriends', response.data);
                    commit('setFriendsLoadStatus', 2);
                })
                .catch(function (error){
                    commit('setFriendsLoadStatus', 3);
                });
        },
    },
    mutations:{
        setConfigsLoadStatus(state,status){
            state.configsLoadStatus = status;
        },
        setConfigs(state,configs){
            state.configs = configs;
        },
        setFriendsLoadStatus(state,status){
            state.friendsLoadStatus = status;
        },
        setFriends(state,friends){
            state.friends = friends;
        },
    },
    getters:{
        getConfigs(state){
            return state.configs
        },
        getConfigsLoadStatus(state){
            return function () {
                return state.configsLoadStatus;
            }
        },
        getFriends(state){
            return state.friends;
        },
        getFriendsLoadStatus(state){
            return state.setFriendsLoadStatus;
        },
    }
};