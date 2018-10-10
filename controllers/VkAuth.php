<?php namespace Crydesign\Socializer\Controllers;

use Backend;
use Backend\Classes\Controller;
use Redirect;
use Url;
use VK\OAuth\VKOAuth;
use \CRYDEsigN\Socializer\Models\Settings as Setting;

class VkAuth extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (isset($_GET['code'])) {
            $oauth = new VKOAuth();
            $settings = Setting::instance();
            $client_id = $settings->vk_client_id;
            $client_secret = $settings->vk_client_sekret;
            $redirect_uri = Url::to('/vk_auth');
            $code = $_GET['code'];

            $response = $oauth->getAccessToken($client_id, $client_secret, $redirect_uri, $code);
            
            $settings->set('vk_access_token', $response['access_token']);

            return Redirect::to(Backend::url('crydesign/socializer/settings'));

        }

        return "
    <body></body>
    <script>
    if( document.location.hash != '' ) {
      var token = /access_token=([^&]+)/.exec(document.location.hash)[1];

      if ( token != '' ) {
        console.log( 'access_token', token );
      } else {
        alert( 'Ошибка получения токена!' );
      }
     } else {
       alert( 'Ошибка получения токена!' );
     }

     function post(path, params, method) {

      method = method || 'post'; // Set method to post by default if not specified.

      // The rest of this code assumes you are not using a library.
      // It can be made less wordy if you use one.
      var form = document.createElement('form');
      form.setAttribute('method', method);
      form.setAttribute('action', path);

      for(var key in params) {
        console.log('params', key, params[key]);
          if(params.hasOwnProperty(key)) {
              var hiddenField = document.createElement('input');
              hiddenField.setAttribute('type', 'hidden');
              hiddenField.setAttribute('name', key);
              hiddenField.setAttribute('value', params[key]);

              form.appendChild(hiddenField);
          }
          console.log('post')
      }

      document.body.appendChild(form);
      form.submit();
    }

    post('http://fw.octobercms.loc/vk_auth', {access_token: token});
    </script>
    ";
    }

    public function getToken()
    {
        $token = $_POST['access_token'];
        $settings = Setting::instance();
        $settings->set('vk_access_token', $token);
        return Redirect::to(Backend::url('crydesign/socializer/settings'));
    }

}
