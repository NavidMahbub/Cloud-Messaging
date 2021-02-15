<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_receives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_date');
            $table->string('pr_number');
            $table->string('reference')->nullable();
            $table->string('bank_info')->nullable();
            $table->string('invoice_show')->nullable();
            $table->longText('note')->nullable();
            $table->double('amount');
            $table->string('file_name')->nullable();
            $table->string('file_url')->nullable();
            $table->integer('payment_mode_id')->unsigned();
            $table->integer('installment_type')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });
        Schema::table('payment_receives', function(Blueprint $table){
            $table->foreign('payment_mode_id')->references('id')->on('payment_modes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('payment_receives');
    }
}
