<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('project_category_id')->unsigned();
            $table->integer('type')->nullable();
            $table->string('name')->nullable();
            $table->string('block_no')->nullable();
            $table->string('road_no')->nullable();
            $table->string('plot_size')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->nullable();
            $table->float('sales_price')->nullable();
            $table->float('purchase_price')->nullable();
            $table->text('location')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();

        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('project_category_id')->references('id')->on('project_categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
