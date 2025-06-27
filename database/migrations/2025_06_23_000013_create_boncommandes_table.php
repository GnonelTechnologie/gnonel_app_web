<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoncommandesTable extends Migration
{
    public function up()
    {
        Schema::create('boncommandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_operateur');
            $table->unsignedBigInteger('id_autorite')->nullable();
            $table->string('key_bon', 32)->nullable();
            $table->text('ref_bon')->nullable();
            $table->text('libelle_appel');
            $table->double('montant');
            $table->boolean('bonne_fin')->default(1);
            $table->boolean('is_satisfait')->nullable();
            $table->boolean('retard_execution')->nullable();
            $table->text('lien_images')->nullable();
            $table->text('lien_video')->nullable();
            $table->smallInteger('status')->default(1);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('id_operateur')->references('id')->on('operateurs')->onDelete('cascade');
            $table->foreign('id_autorite')->references('id')->on('autoritecontractantes')->onDelete('set null');
        });
    }
    public function down()
    {
        Schema::dropIfExists('boncommandes');
    }
} 