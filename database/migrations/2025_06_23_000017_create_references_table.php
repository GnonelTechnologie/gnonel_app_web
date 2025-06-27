<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencesTable extends Migration
{
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->id('idreference');
            $table->string('numeroreference', 50)->nullable();
            $table->string('reference_marche', 100)->nullable();
            $table->text('libelle_marche')->nullable();
            $table->unsignedBigInteger('type_marche')->nullable();
            $table->double('montant')->nullable();
            $table->boolean('show_amount')->default(0);
            $table->double('annee_execution');
            $table->string('preuve_execution', 100)->nullable();
            $table->unsignedBigInteger('autorite_contractante')->nullable();
            $table->string('groupement', 100)->nullable();
            $table->string('sous_traitance', 100)->nullable();
            $table->string('mode_passassion', 100)->nullable();
            $table->unsignedBigInteger('operateur')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->string('compte', 100)->nullable();
            $table->date('date_execution')->nullable();
            $table->date('date_contrat')->nullable();

            $table->foreign('type_marche')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('autorite_contractante')->references('id')->on('autoritecontractantes')->onDelete('set null');
            $table->foreign('operateur')->references('id')->on('operateurs')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    public function down()
    {
        Schema::dropIfExists('references');
    }
} 