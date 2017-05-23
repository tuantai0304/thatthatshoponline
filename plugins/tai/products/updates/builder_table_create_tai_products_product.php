<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateTaiProductsProduct extends Migration
{
    public function up()
    {
        Schema::create('tai_products_product', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->text('description');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tai_products_product');
    }
}
