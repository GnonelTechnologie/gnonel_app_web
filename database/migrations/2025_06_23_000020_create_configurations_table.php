<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->integer('bonus')->nullable();
            $table->integer('tva')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
} 