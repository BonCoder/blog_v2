/**
 * Imports the LvBlog API URL from the config.
 */
import { Bob_CONFIG } from '../config.js';

export default {
    getConfigs: function(){
        return axios.get(Bob_CONFIG.API_URL + '/site');
    },
    getFriends: function () {
        return axios.get(Bob_CONFIG.API_URL + '/links');
    }
}