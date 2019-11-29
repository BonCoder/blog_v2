/**
 * Imports the LvBlog API URL from the config.
 */
import { Bob_CONFIG } from '../config.js';

export default {
    getArchives: function(user){
        return axios.get(Bob_CONFIG.API_URL + '/archives/'+ user+'?include=user',{

        });
    },
}