<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffreAbonnementTable extends Migration
{
    public function up()
    {
        Schema::create('offre_abonnement', function (Blueprint $table) {
            $table->id('idoffre_abonnement');
            $table->string('offre_abonnement', 80);
            $table->integer('prix');
        });
    }
    public function down()
    {
        Schema::dropIfExists('offre_abonnement');
    }
} 