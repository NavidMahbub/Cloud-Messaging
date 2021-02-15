<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('note')->nullable();
            $table->integer('debit_credit')->nullable();
            $table->double('amount')->nullable();
            $table->integer('account_id')->unsigned();
            $table->string('jurnal_type');
            $table->integer('journal_id')->nullable()->unsigned();
            $table->integer('invoice_id')->nullable()->unsigned();
            $table->integer('income_id')->nullable()->unsigned();
            $table->integer('payment_receive_id')->nullable()->unsigned();
            $table->integer('payment_receive_entries_id')->nullable()->unsigned();
            $table->integer('expense_id')->nullable()->unsigned();
            $table->integer('bill_id')->nullable()->unsigned();
            $table->integer('bank_id')->nullable()->unsigned();
            $table->integer('bill_entry_id')->nullable()->unsigned();
            $table->integer('payment_made_id')->nullable()->unsigned();
            $table->integer('payment_made_entry_id')->nullable()->unsigned();
            $table->integer('contact_id')->nullable()->unsigned();
            $table->integer('tax_id')->nullable()->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });


        Schema::table('journal_entries', function(Blueprint $table){
            $table->foreign('journal_id')->references('id')->on('journals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_receive_id')->references('id')->on('payment_receives')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_receive_entries_id')->references('id')->on('payment_receive_entries')->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bank_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bill_entry_id')->references('id')->on('bill_entries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_made_id')->references('id')->on('payment_mades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_made_entry_id')->references('id')->on('payment_made_entries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contact_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('journal_entries');
    }
}
