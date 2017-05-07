<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateTaiProductsProduct2 extends Migration
{
    public function up()
    {
        Schema::table('tai_products_product', function($table)
        {
            $table->string('slug')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('tai_products_product', function($table)
        {
            $table->text('slug')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
