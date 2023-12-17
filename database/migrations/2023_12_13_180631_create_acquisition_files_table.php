<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcquisitionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisition_files', function (Blueprint $table) {
            $table->id();
            $table->integer('acquisition_id')->nullable();
            $table->string('file')->nullable();
            $table->string('file_filename')->nullable();
            $table->string('file_title')->nullable();
            $table->string('mask')->nullable();
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
        Schema::dropIfExists('acquisition_files');
    }
}
