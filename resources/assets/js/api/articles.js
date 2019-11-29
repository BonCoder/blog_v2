/**
 * Imports the LvBlog API URL from the config.
 */
import { Bob_CONFIG } from '../config.js';

export default {
    getArticles: function(page){
        return axios.get(Bob_CONFIG.API_URL + '/article'+'?include=user,category&page='+page ,{

        });
    },
    getUserArticles: function(user,page){

        return axios.get(Bob_CONFIG.API_URL + '/users/'+user+'/articles'+'?include=user,category&page='+page ,{

        });
    },
    getUserTagArticles: function(tag,page){
        return axios.get(Bob_CONFIG.API_URL + '/tags/'+tag+'/articles'+'?include=user,category&page='+page ,{

        });
    },
    getDraftArticles: function(data){
        return axios.get(Bob_CONFIG.API_URL + '/drafts/articles'+'?include=user,category&page='+data.page );
    },
    getPrivateArticles: function(data){
        return axios.get(Bob_CONFIG.API_URL + '/privates/articles'+'?include=user,category&page='+data.page );
    },
    getUserCategoryArticles: function(data){

        return axios.get(Bob_CONFIG.API_URL + '/categories/'+data.category+'/articles'+'?include=user,category&page='+data.page ,{

        });
    },
    getArticle: function(art_id){
        return axios.get(Bob_CONFIG.API_URL + '/article/'+art_id+'?include=user',{

        });
    },
    postArticle: function(title,body,tags,category_id,excerpt,target){
        return axios.post(Bob_CONFIG.API_URL + '/articles',{
            title:title,
            body:body,
            tags:tags,
            category_id:category_id,
            excerpt:excerpt,
            target:target,
        });
    },
    patchArticle: function(data){
        return axios.get(Bob_CONFIG.API_URL + '/article/'+data.id,{
            title:data.title,
            body:data.body,
            tags:data.tags,
            category_id:data.category_id,
            excerpt:data.excerpt,
            target:data.target,
        });
    },
    deleteArticle: function(data){
        return axios.delete(Bob_CONFIG.API_URL + '/article/'+data.id);
    },
    getRecommendArticles: function () {
        return axios.get(Bob_CONFIG.API_URL + '/article/recommend')
    },
    searchArticles :function(data){
        return axios.post(Bob_CONFIG.API_URL + '/search/articles' +'?include=user,category&page='+data.page,{
            search:data.search,
        })
    }
}