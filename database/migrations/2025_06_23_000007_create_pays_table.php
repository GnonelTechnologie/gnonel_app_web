<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->string('nom_pays', 50);
            $table->string('code_pays', 3);
            $table->smallInteger('status')->default(1);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->string('indicatif', 20)->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('pays');
    }
} 