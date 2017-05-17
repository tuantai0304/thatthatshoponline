<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateTaiProductsCategories2 extends Migration
{
    public function up()
    {
        Schema::table('tai_products_categories', function($table)
        {
            $table->text('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('tai_products_categories', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
