<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('passport_number')->nullable();
            $table->string('passport_name')->nullable();
            $table->string('processing_rate')->nullable();
            $table->string('visa_number')->nullable();
            $table->string('company_id_number')->nullable();
            $table->string('occupation')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('diving_licence_status')->nullable();
            $table->integer('diving_licence_by')->nullable()->unsigned();
            $table->boolean('police_clearence_status')->nullable();
            $table->integer('police_clearence_by')->nullable()->unsigned();
            $table->boolean('medical_status')->nullable();
            $table->tinyInteger('medical')->default(0);
            $table->integer('medical_by')->nullable()->unsigned();
            $table->boolean('musaned_status')->nullable();
            $table->string('musaned_date')->nullable();
            $table->integer('musaned_date_by')->nullable()->unsigned();
            $table->boolean('okala_status')->nullable();
            $table->string('okala_date')->nullable();
            $table->integer('okala_date_by')->nullable()->unsigned();
            $table->boolean('mofa_status')->nullable();
            $table->string('mofa_date')->nullable();
            $table->integer('mofa_date_by')->nullable()->unsigned();
            $table->boolean('stamping_status')->nullable();
            $table->string('stamping_date')->nullable();
            $table->integer('stamping_by')->nullable()->unsigned();
            $table->boolean('finger_training_status')->nullable();
            $table->string('finger_training_date')->nullable();
            $table->integer('finger_training_by')->nullable()->unsigned();
            $table->boolean('manpower_status')->nullable();
            $table->string('manpowe_date')->nullable();
            $table->integer('manpowe_date_by')->nullable()->unsigned();
            $table->boolean('flight_status')->nullable();
            $table->string('flight_date')->nullable();
            $table->integer('flight_date_by')->nullable()->unsigned();
            $table->boolean('account_status')->nullable();
            $table->string('account_date')->nullable();
            $table->integer('account_date_by')->nullable()->unsigned();
            $table->tinyInteger('type')->default(0)->comment('1 for processing and 2 for recuiting');
            $table->integer('agent_id')->nullable()->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('created_by')->nullable()->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('visas', function(Blueprint $table){
            $table->foreign('diving_licence_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('police_clearence_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('medical_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('musaned_date_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('okala_date_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mofa_date_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('stamping_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('finger_training_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('manpowe_date_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('flight_date_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_date_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visas');
    }
}
