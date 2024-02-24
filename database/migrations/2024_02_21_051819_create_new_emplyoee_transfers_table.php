<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewEmplyoeeTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_emplyoee_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('employee_code');
            $table->integer('designation_id');
            $table->integer('old_district_id');
            $table->integer('old_block_id');
            $table->integer('old_gram_panchayat_id');
            $table->integer('new_district_id');
            $table->integer('new_block_id');
            $table->integer('new_gram_panchayat_id');
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_emplyoee_transfers');
    }
}
