<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateTaiProductsProductsOrders extends Migration
{
    public function up()
    {
        Schema::create('tai_products_products_orders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->integer('product_id');
            $table->integer('order_id');
            $table->decimal('quantity', 10, 0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tai_products_products_orders');
    }
}
