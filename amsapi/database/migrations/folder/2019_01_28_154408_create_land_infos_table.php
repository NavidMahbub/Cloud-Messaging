<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->float('amount')->nullable();
            $table->float('land_amount')->nullable();
            $table->text('location')->nullable();
            $table->timestamps();
        });

        Schema::table('land_infos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('contacts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('land_infos');
    }
}
