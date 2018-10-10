<?php namespace Crydesign\Socializer\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Db;
use VK\Client\VKApiClient;
use VK\OAuth\VKOAuth;
use VK\OAuth\VKOAuthDisplay;
use VK\OAuth\VKOAuthResponseType;
use VK\OAuth\Scopes\VKOAuthGroupScope;
use \CRYDEsigN\Socializer\Models\Settings as Setting;

class CrossPosting extends FormWidgetBase
{

  protected $defaultAlias = 'crossposting';

  public $og_title = null;
  public $og_image = null;

  public function init()
  {
      $this->fillFromConfig([
          'og_title',
      ]);
  }

  public function render() 
  {

    //echo get_class($this->model);
    //dd ($this);
    //$this->vars['model'] = $response;
    
    $this->vars['og_title'] = $this->model->attributes[$this->og_title];
    
    //print_r($this);
    return $this->makePartial('crossposting');
  }

  public function getSaveValue($value)
  {
    $vk = new VKApiClient(); 
    $access_token = Setting::instance()->vk_access_token;
    //dd($access_token);
    $response = $vk->wall()->post($access_token, [
        'owner_id' => -70589631,
        'from_group' => 1,
        'message' => 'Hello there test'
      ]
    );

    //Db::table('crydesign_socializer_crosspost')->insert(['post_type' => $browser_url, 'post_id' => $this->model->attributes['id']]);
  }
}

?>