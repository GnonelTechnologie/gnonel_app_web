<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnement', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 400);
            $table->double('prix');
            $table->text('description');
            $table->boolean('is_international')->default(1);
            $table->string('monnaie', 10);
            $table->unsignedBigInteger('categorie');
            $table->double('prix_exo')->nullable();
            $table->integer('nbjours')->nullable();
            $table->tinyInteger('choixaut')->nullable();
            $table->tinyInteger('choixop')->nullable();
            $table->timestamps();
            $table->tinyInteger('mon_port')->nullable();
            $table->tinyInteger('oper_local')->nullable();
            $table->tinyInteger('oper_international')->nullable();
            $table->tinyInteger('base_four')->nullable();

            $table->foreign('categorie')->references('id')->on('categorie_abonnements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abonnement');
    }
} 