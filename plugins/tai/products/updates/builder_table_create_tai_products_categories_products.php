<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateTaiProductsCategoriesProducts extends Migration
{
    public function up()
    {
        Schema::create('tai_products_categories_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('category_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('product_id');
            $table->timestamp('deleted_at')->nullable();
        });

//        Schema::table('tai_products_categories_products', function($table)
//        {
//            $table->foreign('category_id')->refrences('id')->on('tai_products_categories')->onDelete('cascade');
//            $table->foreign('product_id')->refrences('id')->on('tai_products_product')->onDelete('cascade');
//        });

    }
    
    public function down()
    {
        Schema::dropIfExists('tai_products_categories_products');
    }
}
