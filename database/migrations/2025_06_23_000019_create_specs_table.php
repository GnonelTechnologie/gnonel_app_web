<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecsTable extends Migration
{
    public function up()
    {
        Schema::create('specs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('user_id');
            $table->string('libelle', 100)->nullable();
            $table->text('contexte')->nullable();
            $table->string('lien', 100);
            $table->unsignedBigInteger('pays_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pays_id')->references('id')->on('pays')->onDelete('set null');
        });
    }
    public function down()
    {
        Schema::dropIfExists('specs');
    }
} 