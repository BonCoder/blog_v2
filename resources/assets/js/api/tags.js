/**
 * Imports the LvBlog API URL from the config.
 */
import { Bob_CONFIG } from '../config.js';

export default {
    getTags: function(user_id){
        return axios.get(Bob_CONFIG.API_URL + '/tags/'+ user_id);
    },
    getAllTags: function(){
        return axios.get(Bob_CONFIG.API_URL + '/all/tags/');
    }
}