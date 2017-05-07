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
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tai_products_categories');
    }
}
