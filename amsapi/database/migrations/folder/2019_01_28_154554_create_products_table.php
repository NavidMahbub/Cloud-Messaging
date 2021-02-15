<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('product_category_id')->unsigned();
            $table->integer('type')->nullable();
            $table->string('block_no')->nullable();
            $table->string('road_no')->nullable();
            $table->string('plot_size')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->nullable();
            $table->float('sales_price')->nullable();
            $table->float('purchase_price')->nullable();
            $table->text('location')->nullable();
            $table->timestamps();

        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade')->onUpdate('cascade');
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
