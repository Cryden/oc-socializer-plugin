<?php namespace Crydesign\Socializer\FormWidgets;

use Backend\Classes\FormWidgetBase;

class CrossPosting extends FormWidgetBase
{
  protected $defaultAlias = 'vk_access';

  public function render() 
  {
    return $this->makePartial('vk_access');
  }
}

?>