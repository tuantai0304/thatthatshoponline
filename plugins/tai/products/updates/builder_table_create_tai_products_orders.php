<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateTaiProductsOrders extends Migration
{
    public function up()
    {
        Schema::create('tai_products_orders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->text('name')->nullable();
            $table->text('phone')->nullable();
            $table->text('email');
            $table->text('address')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tai_products_orders');
    }
}
