<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateTaiProductsProduct extends Migration
{
    public function up()
    {
        Schema::table('tai_products_product', function($table)
        {
            $table->text('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('tai_products_product', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
