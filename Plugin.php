<?php namespace Crydesign\Socializer;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Backend;

class Plugin extends PluginBase
{
  public function register()
  {
  }

  public function registerComponents()
  {
  }

  /**
   * Registers settings for this plugin.
   *
   * @return array
   */

  public function registerSettings()
  {
    return [
      'location' => [
        'label'       => 'crydesign.socializer::lang.plugin.name',
        'description' => 'crydesign.socializer::lang.plugin.description',
        'category'    => SettingsManager::CATEGORY_CMS,
        'icon'        => 'icon-share-alt',
        'class'       => 'CRYDEsigN\Socializer\Models\Settings',
        'order'       => 500,
        'keywords'    => 'social vk socializer'
      ]
    ];
  }

  public function registerFormWidgets()
  {
    return [
      'Crydesign\Socializer\FormWidgets\CrossPosting' => 'crossposting',
  ];
  }
}