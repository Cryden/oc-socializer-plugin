<?php namespace Crydesign\Socializer\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCrydesignSocializerCrosspost3 extends Migration
{
    public function up()
    {
        Schema::table('crydesign_socializer_crosspost', function($table)
        {
            $table->integer('post_id')->nullable()->change();
            $table->integer('vk_post_id')->nullable()->change();
            $table->string('post_type')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('crydesign_socializer_crosspost', function($table)
        {
            $table->integer('post_id')->nullable(false)->change();
            $table->integer('vk_post_id')->nullable(false)->change();
            $table->string('post_type', 191)->nullable(false)->change();
        });
    }
}
