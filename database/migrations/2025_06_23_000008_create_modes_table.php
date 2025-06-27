<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModesTable extends Migration
{
    public function up()
    {
        Schema::create('modes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 100);
            $table->string('description', 100)->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('modes');
    }
} 