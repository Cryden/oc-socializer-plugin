<?php namespace Crydesign\Socializer\FormWidgets;

use RainLab\Builder\Widgets\DefaultControlDesignTimeProvider;
use Backend\Classes\WidgetBase;

class TestBuilder extends DefaultControlDesignTimeProvider
{
  protected $defaultControlsTypes = [
    'test',
  ];

  public function renderControlBody($type, $properties, $formBuilder)
  {
    if (!in_array($type, $this->defaultControlsTypes)) {
      return $this->renderUnknownControl($type, $properties);
    }

    foreach ($this->defaultControlsTypes as $value) {
      WidgetBase::addViewPath(plugins_path()."/crydesign/socializer/formwidgets/".$value."/partials");
    }

    return $this->makePartial($type, 
      [
        'properties'=>$properties,
        'formBuilder' => $formBuilder
      ]
    );
  }
}

?>