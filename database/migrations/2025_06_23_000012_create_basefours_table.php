<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasefoursTable extends Migration
{
    public function up()
    {
        Schema::create('basefours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('operateur_id');
            $table->timestamps();
            $table->string('numerorccm', 40)->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('operateur_id')->references('id')->on('operateurs')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('basefours');
    }
} 