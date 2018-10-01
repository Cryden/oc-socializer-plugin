<?php namespace Crydesign\Socializer\FormWidgets;

use Backend\Classes\FormWidgetBase;

class CrossPosting extends FormWidgetBase
{
    /**
     * @var string A unique alias to identify this widget.
     */
    protected $defaultAlias = 'crossposting';

    public function render() 
    {
      return $this->makePartial('crossposting');
    }
}

?>