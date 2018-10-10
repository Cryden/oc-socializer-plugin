<?php namespace Crydesign\Socializer\Controllers;

use Backend;
use BackendMenu;
use Backend\Classes\Controller;
use Redirect;
use System\Classes\SettingsManager;
use VK\OAuth\Scopes\VKOAuthUserScope;
use VK\OAuth\VKOAuth;
use VK\OAuth\VKOAuthDisplay;
use VK\OAuth\VKOAuthResponseType;
use \CRYDEsigN\Socializer\Models\Settings as Setting;


class Settings extends Controller
{

    public function __construct()
    {
        parent::__construct();

        SettingsManager::setContext('Crydesign.Socializer', 'settings');
        BackendMenu::setContext('October.System', 'system', 'settings');
    }

    public function index()
    {
        $settings = Setting::first();

        if (empty($settings)) {
            return Redirect::to(Backend::url('crydesign/socializer/settings/create'));
        } else {
            return Redirect::to(Backend::url('crydesign/socializer/settings/update/' . $settings->id));
        }
    }

    public function create()
    {
        $settings = Setting::first();

        if (empty($settings)) {
            $settings = new Setting;
            $settings->save();
            $settings = Setting::first();
        }

        return Redirect::to(Backend::url('crydesign/socializer/settings/update/' . $settings->id));

    }

    public function update($id = null)
    {
        $config = $this->makeConfig('$/crydesign/socializer/models/settings/fields.yaml');
        $config->model = Setting::find($id);
        $widget = $this->makeWidget('Backend\Widgets\Form', $config);
        $this->vars['widget'] = $widget;



    }

    public function onUpdate($id)
    {
        $data = post();

        $settings = Setting::instance();

        foreach ($data as $key => $value) {
            trace_log($key, $value);
            $settings->set($key, $value);
        }

        \Flash::success('Settings done!');
    }

    public function onGetVkAccessToken()
    {
        $settings = Setting::instance();

        $oauth = new VKOAuth();
        $client_id = $settings->get('vk_client_id');
        $redirect_uri = 'https://oauth.vk.com/blank.html';
        $display = VKOAuthDisplay::PAGE;
        $scope = array(VKOAuthUserScope::WALL, VKOAuthUserScope::GROUPS, VKOAuthUserScope::OFFLINE);
        $state = $settings->get('vk_client_sekret');
        $revoke_auth = true;

        $browser_url = $oauth->getAuthorizeUrl(VKOAuthResponseType::TOKEN, $client_id, $redirect_uri, $display, $scope, $state, null, $revoke_auth);

        return ['browser_url' => $browser_url];
    }
}
