<?php namespace Crydesign\Socializer\Models;

use Model;

/**
 * Model
 */
class Crosspost extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'crydesign_socializer_crosspost';
}
