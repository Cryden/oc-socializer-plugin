<?php namespace Crydesign\Socializer\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCrydesignSocializerCrosspost2 extends Migration
{
    public function up()
    {
        Schema::table('crydesign_socializer_crosspost', function($table)
        {
            $table->string('post_type');
        });
    }
    
    public function down()
    {
        Schema::table('crydesign_socializer_crosspost', function($table)
        {
            $table->dropColumn('post_type');
        });
    }
}
