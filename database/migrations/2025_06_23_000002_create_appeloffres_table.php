<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppeloffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appeloffres', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 100)->nullable();
            $table->unsignedBigInteger('id_autorite');
            $table->unsignedBigInteger('id_categorie');
            $table->string('key_appel', 32)->nullable();
            $table->string('libelle_appel', 254);
            $table->dateTime('date_publication');
            $table->dateTime('date_cloture')->nullable();
            $table->text('source')->nullable();
            $table->smallInteger('status')->default(1);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('idsecteuractivite')->nullable();
            $table->unsignedBigInteger('id_pays')->nullable();
            $table->unsignedBigInteger('mode_id')->nullable();
            $table->string('contact', 150)->nullable();
            $table->date('date_offre')->nullable();

            $table->foreign('id_autorite')->references('id')->on('autoritecontractantes')->onDelete('cascade');
            $table->foreign('id_categorie')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('idsecteuractivite')->references('idsecteuractivite')->on('secteuractivite')->onDelete('set null');
            $table->foreign('id_pays')->references('id')->on('pays')->onDelete('set null');
            $table->foreign('mode_id')->references('id')->on('modes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appeloffres');
    }
} 