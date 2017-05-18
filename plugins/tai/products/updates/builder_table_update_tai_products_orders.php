<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateTaiProductsOrders extends Migration
{
    public function up()
    {
        Schema::table('tai_products_orders', function($table)
        {
            $table->dropColumn('id');
        });
    }
    
    public function down()
    {
        Schema::table('tai_products_orders', function($table)
        {
            $table->integer('id');
        });
    }
}
