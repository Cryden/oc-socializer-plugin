<?php namespace Crydesign\Socializer;

use Backend;
use Event;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Cms\Classes\Page;

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
                'label' => 'crydesign.socializer::lang.plugin.name',
                'description' => 'crydesign.socializer::lang.plugin.description',
                'category' => SettingsManager::CATEGORY_CMS,
                'icon' => 'icon-share-alt',
                'url' => Backend::url('crydesign/socializer/settings/index'),
                'order' => 500,
                'keywords' => 'social vk socializer',
            ],
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Crydesign\Socializer\FormWidgets\CrossPosting' => [
                'label' => 'Socializer',
                'code' => 'crossposting',
            ],
        ];
    }

    public function boot()
    {
        Event::listen('pages.builder.registerControls', function ($controlLibrary) {

            function addTest($controlLibrary)
            {
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

            function addCrossposting($controlLibrary)
            {
                
                function listPages ()
                {
                    $listPages=[];
                    foreach (Page::all() as $page)
                    {
                        $listPages[$page->url] = $page->title;
                    }
                    return $listPages;
                }

                $properties = [
                    'crossposting' => [
                        'title' => 'Message',
                        'description' => 'Description',
                        'type' => 'string',
                        'group' => 'Socializer',
                    ],

                    'page_preview' => [
                        'title' => 'Model View',
                        'type' => 'dropdown',
                        'options' => listPages(),
                        'group' => 'Socializer',
                    ],
                ];

                $controlLibrary->registerControl(
                    'crossposting',
                    'Crosspost',
                    'socialize',
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
