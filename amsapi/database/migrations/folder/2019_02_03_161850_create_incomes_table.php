<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->double('amount');
            $table->double('utility')->nullable();
            $table->double('car_parking')->nullable();
            $table->double('registration_cost')->nullable();
            $table->double('other_cost')->nullable();
            // $table->double('tax_total')->nullable();
            $table->double('gift')->nullable();
            $table->double('discount')->nullable();
            // $table->integer('receive_through_id')->unsigned();
            $table->string('reference')->nullable();
            $table->longText('note')->nullable();
            $table->integer('account_id')->unsigned();
            $table->integer('agent_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            // $table->integer('tax_id')->unsigned();
            // $table->integer('tax_type')->nullable();
            $table->string('bank_info')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('incomes', function(Blueprint $table){
            // $table->foreign('receive_through_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('cascade');
            // $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
}
