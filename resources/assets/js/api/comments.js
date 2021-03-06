/**
 * Imports the LvBlog API URL from the config.
 */
import { Bob_CONFIG } from '../config.js';

export default {
    getComments: function(data){
        return axios.get(Bob_CONFIG.API_URL + '/comments/articles/'+data.art_id+'?include=reply',{

        });
    },
    postComment: function (data) {
        return axios.post(Bob_CONFIG.API_URL + '/articles/'+data.art_id+'/comments',{
            contents:data.contents,
        });
    },
    postReply: function (data) {
        return axios.post(Bob_CONFIG.API_URL + '/comments/'+data.comment_id+'/replies',{
            contents:data.contents,
            toUser:data.toUser,
        });
    },
    patchLikeComment :function (data) {
        return axios.patch(Bob_CONFIG.API_URL + '/comments/' + data.comment_id + '/like')
    },
    deleteComment :function (data) {
        return axios.delete(Bob_CONFIG.API_URL + '/comments/' + data.comment_id)
    },
    deleteReply :function (data) {
        return axios.delete(Bob_CONFIG.API_URL + '/comments' + '/replies/'  + data.reply_id )
    }
}