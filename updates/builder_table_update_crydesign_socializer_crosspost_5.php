<?php namespace Crydesign\Socializer\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCrydesignSocializerCrosspost5 extends Migration
{
    public function up()
    {
        Schema::table('crydesign_socializer_crosspost', function($table)
        {
            $table->text('post_type')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('crydesign_socializer_crosspost', function($table)
        {
            $table->string('post_type', 191)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
