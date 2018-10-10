<?php namespace Crydesign\Socializer;

use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Backend;
use Event;
use Lang;
use RainLab\Builder\Classes\ControlLibrary;

class Plugin extends PluginBase
{
  public function register()
  {
  }

  public function registerComponents()
  {
  }

  public function registerSettings()
  {
    return [
      'location' => [
        'label'       => 'crydesign.socializer::lang.plugin.name',
        'description' => 'crydesign.socializer::lang.plugin.description',
        'category'    => SettingsManager::CATEGORY_CMS,
        'icon'        => 'icon-share-alt',
        // 'class'       => 'CRYDEsigN\Socializer\Models\Settings',
        'url'         => Backend::url('crydesign/socializer/settings/index'),
        'order'       => 500,
        'keywords'    => 'social vk socializer'
      ]
    ];
  }

  public function registerFormWidgets()
  {
    return [
      'Crydesign\Socializer\FormWidgets\CrossPosting' => [
        'label' => 'Socializer',
        'code' => 'crossposting'
      ]
    ];
  }

  public function boot()
  {
    Event::listen('pages.builder.registerControls', function($controlLibrary) {

      function addTest($controlLibrary) {
        $test_properties = [
          'test' => [
            'title' => 'Test',
            'description' => 'Description',
            'type' => 'string',
          ],
        ];

        $controlLibrary->registerControl(
          'test',
          'test title',
          'test description',
          'default',
          'icon-pencil-square',
          $controlLibrary->getStandardProperties(['stretch'], $test_properties),
          'CRYDEsigN\Socializer\FormWidgets\TestBuilder'
        );
      }

      function addCrossposting($controlLibrary) {
        $properties = [
          'crossposting' => [
            'title' => 'Socializer',
            'description' => 'Description',
            'type' => 'string',
            'group' => 'Socializer'
          ],

          'og_title' => [
            'title' => 'og-title',
            'type' => 'dropdown',
            'fillFrom' => 'form-controls',
            'group' => 'Socializer'
          ]
        ];

        $controlLibrary->registerControl(
          'crossposting',
          'title',
          'description',
          'default',
          'icon-pencil-square',
          $controlLibrary->getStandardProperties(['stretch'], $properties),
          'CRYDEsigN\Socializer\FormWidgets\CrosspostingBuilder'
        );
      }

      addTest($controlLibrary);
      addCrossposting($controlLibrary);

    });
  }
}
