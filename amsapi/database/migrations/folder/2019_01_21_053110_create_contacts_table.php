<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->String('designation')->nullable();
            $table->String('father_name')->nullable();
            $table->String('mother_name')->nullable();
            $table->String('spouse_name')->nullable();
            $table->integer('area_code')->nullable();
            $table->String('mobile_number')->nullable();
            $table->String('contact_number')->nullable();
            $table->String('occupation')->nullable();
            $table->String('nid')->nullable();
            $table->String('birthday')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('subdistrict_id')->nullable();
            $table->String('ward_union')->nullable();
            $table->String('area_village')->nullable();
            $table->String('street_para')->nullable();
            $table->String('post_ofiice')->nullable();
            $table->String('company_name')->nullable();
            $table->String('agent_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
