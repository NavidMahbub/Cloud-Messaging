<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->double('amount');
            // $table->integer('paid_through_id')->unsigned();
            $table->double('tax_total')->nullable();
            $table->string('reference')->nullable();
            $table->string('note')->nullable();
            $table->integer('account_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            // $table->integer('tax_id')->unsigned();
            // $table->integer('tax_type');
            $table->string('bank_info')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('expenses', function(Blueprint $table){
            // $table->foreign('paid_through_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onUpdate('cascade');
            // $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
