<?php namespace Tai\Products\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateTaiProductsCategories extends Migration
{
    public function up()
    {
        Schema::create('tai_products_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255)->nullable();
            $table->text('description');
            $table->text('slug')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tai_products_categories');
    }
}
