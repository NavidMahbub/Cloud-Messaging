<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number')->unique();
            $table->string('file_name')->nullable();
            $table->string('file_url')->nullable();
            $table->string('invoice_date');
            $table->string('payment_date');
            $table->longText('customer_note')->nullable();
            $table->double('tax_total')->nullable();
            $table->double('shipping_charge')->nullable();
            $table->double('adjustment')->nullable();
            $table->double('commission')->nullable();
            $table->integer('commission_id')->nullable()->unsigned();
            $table->double('pr_adjustment')->nullable();
            $table->string('pr_note')->nullable();
            $table->longText('personal_note')->nullable();
            $table->tinyInteger('save')->nullable();
            $table->integer('payment_type');
            $table->integer('installment_status')->nullable();
            $table->integer('installment_type')->nullable();
            $table->integer('installment_date')->nullable();
            $table->integer('installment_number')->nullable();
            $table->integer('agent_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('invoices', function(Blueprint $table){
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('invoices');
    }
}
