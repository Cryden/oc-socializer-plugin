<?php namespace Crydesign\Socializer\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCrydesignSocializerCrosspost extends Migration
{
    public function up()
    {
        Schema::table('crydesign_socializer_crosspost', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('crydesign_socializer_crosspost', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->increments('id')->unsigned()->change();
        });
    }
}
