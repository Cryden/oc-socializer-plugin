<?php namespace Crydesign\Socializer\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCrydesignSocializerCrosspost extends Migration
{
    public function up()
    {
        Schema::create('crydesign_socializer_crosspost', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('vk_post_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('crydesign_socializer_crosspost');
    }
}
