<?php namespace Crydesign\Socializer\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Url;
use VK\Client\VKApiClient;
use \Crydesign\Socializer\Models\Settings as Setting;

class CrossPosting extends FormWidgetBase
{

    protected $defaultAlias = 'crossposting';

    public $page_preview = null;

    public function init()
    {
        $this->fillFromConfig([
            'page_preview',
        ]);
    }

    public function render()
    {
        return $this->makePartial('crossposting');
    }

    public function getSaveValue($value)
    {
        function getLink($link, $self)
        {
            $link_params = explode('/', $link);
            foreach ($link_params as $key => $link_part) {
                // trace_log(mb_substr($link_part, 0, 1));
                if (mb_substr($link_part, 0, 1) == ':') {

                    $params = mb_substr($link_part, 1);
                    $get_params = $self->model->$params;

                    if (is_object($get_params)) {
                        $link_params[$key] = $get_params->slug;
                    } else {
                        $link_params[$key] = $get_params;
                    }

                }
            }
            $link = implode("/", $link_params);
            $link = Url::to($link);
            return $link;
        }

        $vk = new VKApiClient();
        $settings = Setting::instance();
        $access_token = $settings->vk_access_token;
        $owner_id = $settings->vk_group_id;
        $link = $this->page_preview;
        $link = getLink($link, $this);


        $response = $vk->wall()->post($access_token, [
            'owner_id' => -$owner_id,
            'from_group' => 1,
            //'message' => 'd',
            'attachments' => $link
          ]
        );

        //Db::table('crydesign_socializer_crosspost')->insert(['post_type' => $browser_url, 'post_id' => $this->model->attributes['id']]);
    }
}
