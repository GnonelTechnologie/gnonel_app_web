<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieAbonnementsTable extends Migration
{
    public function up()
    {
        Schema::create('categorie_abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 400)->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('categorie_abonnements');
    }
} 