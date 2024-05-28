<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('image_path');
            $table->json('results');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diagnoses');
    }
}