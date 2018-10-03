<?php namespace Crydesign\Socializer\FormWidgets;

use Backend\Classes\FormWidgetBase;

class CrossPosting extends FormWidgetBase
{
  protected $defaultAlias = 'test';

  public function render() 
  {
    return $this->makePartial('test');
  }
}

?>