<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_mades', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->string('payment_date');
            $table->string('pm_number');
            $table->string('bank_info')->nullable();
            $table->string('invoice_show')->nullable();
            $table->integer('payment_mode_id')->unsigned();
            $table->string('reference');
            $table->double('excess_amount');
            $table->integer('account_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });
        Schema::table('payment_mades', function(Blueprint $table){
            $table->foreign('payment_mode_id')->references('id')->on('payment_modes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('payment_mades');
    }
}
