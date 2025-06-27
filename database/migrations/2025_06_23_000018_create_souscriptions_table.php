<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->id('idsouscription');
            $table->unsignedBigInteger('idabonnement');
            $table->unsignedBigInteger('paysreference');
            $table->string('referencepaiement', 225)->nullable();
            $table->integer('statut')->default(0);
            $table->double('tx_reference')->nullable();
            $table->string('identifier', 100)->nullable();
            $table->double('amount')->nullable();
            $table->double('frais_bonus')->nullable();
            $table->double('discount_pack')->default(0);
            $table->double('discount_recom')->default(0);
            $table->integer('count')->default(1);
            $table->double('montant_finale_apaye')->nullable();
            $table->string('payment_reference', 200)->nullable();
            $table->string('payment_method', 100)->nullable();
            $table->string('datetime', 26)->nullable();
            $table->string('status_p', 50)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('iduser');
            $table->date('date_fin')->nullable();

            $table->foreign('idabonnement')->references('id')->on('abonnement')->onDelete('cascade');
            $table->foreign('paysreference')->references('id')->on('pays')->onDelete('cascade');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('souscriptions');
    }
} 