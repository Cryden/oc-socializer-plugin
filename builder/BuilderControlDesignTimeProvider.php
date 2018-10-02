<?php namespace Crydesign\Socializer\Builder;

use RainLab\Builder\Widgets\DefaultControlDesignTimeProvider;


class BuilderControlDesignTimeProvider extends DefaultControlDesignTimeProvider
{
  protected $defaultControlsTypes = [
    'crossposting',
  ];

  public function renderControlBody($type, $properties, $formBuilder)
  {
      if (!in_array($type, $this->defaultControlsTypes)) {
          return $this->renderUnknownControl($type, $properties);
      }

      return $this->makePartial($type, [
          'properties'=>$properties,
          'formBuilder' => $formBuilder
      ]);
  }
}

?>