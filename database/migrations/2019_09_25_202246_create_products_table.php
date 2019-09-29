<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');                 
            $table->string('name');
            $table->string('sku');
            $table->boolean('status')->default(0);
            $table->double('base_price');
            $table->double('discount')->nullable();
            $table->string('image')->nullable();
            $table->string('description');
            $table->double('stars')->default(0);
            $table->integer('stars_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
