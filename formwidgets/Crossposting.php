<?php namespace Crydesign\Socializer\FormWidgets;

use Backend\Classes\FormWidgetBase;

class CrossPosting extends FormWidgetBase
{

  protected $defaultAlias = 'crossposting';

  public function render() 
  {
    return $this->makePartial('crossposting');
  }
}

?>