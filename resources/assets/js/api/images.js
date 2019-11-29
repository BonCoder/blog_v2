/**
 * Imports the LvBlog API URL from the config.
 */
import { Bob_CONFIG } from '../config.js';

export default {
    upLoadImages: function(data){
        return axios.post(Bob_CONFIG.API_URL + '/images',data);
    }
}