<?php namespace Crydesign\Socializer\FormWidgets;

use Backend\Classes\FormWidgetBase;

class CrossPosting extends FormWidgetBase
{

  protected $defaultAlias = 'crossposting';

  public $name = 'datetime';

  public function render() 
  {
    //echo get_class($this->model);
    //dd ($this->model);
    $this->vars['model'] = get_class($this->model);
    $this->vars['postId'] = $this->model->attributes['id'];
    
    //print_r($this);
    return $this->makePartial('crossposting');
  }
}

?>