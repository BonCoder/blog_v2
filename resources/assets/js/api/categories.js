/**
 * Imports the LvBlog API URL from the config.
 */
import { Bob_CONFIG } from '../config.js';

export default {
    getCategories: function(user_id){
        return axios.get(Bob_CONFIG.API_URL + '/categories/'+ user_id);
    },
    postCategories: function(name){
        return axios.post(Bob_CONFIG.API_URL + '/categories',{
            name:name,
        });
    }
}