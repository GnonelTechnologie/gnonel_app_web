<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelesTable extends Migration
{
    public function up()
    {
        Schema::create('modeles', function (Blueprint $table) {
            $table->id();
            $table->string('key_modele', 32)->nullable();
            $table->string('libelle_modele', 50);
            $table->text('lien_download');
            $table->smallInteger('status')->default(1);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('modeles');
    }
} 