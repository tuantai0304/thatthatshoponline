<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateTaiProductsProductsOrders2 extends Migration
{
    public function up()
    {
        Schema::table('tai_products_products_orders', function($table)
        {
            $table->decimal('quantity', 10, 0)->nullable(false)->unsigned(false)->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('tai_products_products_orders', function($table)
        {
            $table->double('quantity', 10, 0)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
