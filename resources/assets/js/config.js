/**
 * Defines the URL we are using.
 */
var url = '';
var api_url = '';

switch( process.env.NODE_ENV ){
    case 'development':
        url = 'http://www.blog.com';
        api_url = 'http://www.blog.com/api/v1';
        break;
    case 'production':
        url = 'https://www.mozilan.com';
        api_url = 'https://www.mozilan.com/api';
        break;
}
export const Bob_CONFIG = {
    URL:url,
    API_URL: api_url,
};