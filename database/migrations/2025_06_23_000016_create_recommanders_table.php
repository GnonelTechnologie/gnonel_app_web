<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommandersTable extends Migration
{
    public function up()
    {
        Schema::create('recommanders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('lien');
            $table->dateTime('date_expiration')->nullable();
            $table->text('code')->nullable();
            $table->timestamps();
            $table->tinyInteger('utilise')->default(0);
            $table->unsignedBigInteger('souscription_id')->nullable();
            $table->tinyInteger('exporte')->default(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('souscription_id')->references('idsouscription')->on('souscriptions')->onDelete('set null');
        });
    }
    public function down()
    {
        Schema::dropIfExists('recommanders');
    }
} 