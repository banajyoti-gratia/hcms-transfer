<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewEmplyoeeTransferDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_emplyoee_transfer_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transfer_id');
            $table->integer('employee_id');
            $table->string('upload_document');
            $table->string('remarks');
            $table->dateTime('upload_date');
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
        Schema::dropIfExists('new_emplyoee_transfer_documents');
    }
}
