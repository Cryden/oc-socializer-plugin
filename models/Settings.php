<?php namespace CRYDEsigN\Socializer\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'crydesign_socializer_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}