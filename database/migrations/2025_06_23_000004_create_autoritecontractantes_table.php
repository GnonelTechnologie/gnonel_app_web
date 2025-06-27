<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoritecontractantesTable extends Migration
{
    public function up()
    {
        Schema::create('autoritecontractantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_pays');
            $table->string('key_autorite', 32)->nullable();
            $table->string('des_autorite', 254)->nullable();
            $table->text('adresse')->nullable();
            $table->smallInteger('status')->default(1);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('idtypeautorite')->nullable();
            $table->string('libelletypeautorite', 70)->nullable();
            $table->unsignedBigInteger('categorieautorite_id')->nullable();
            $table->string('raison_social', 100)->nullable();
            $table->string('gnonelid', 50)->nullable();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_pays')->references('id')->on('pays')->onDelete('cascade');
            $table->foreign('categorieautorite_id')->references('id')->on('categorieautorites')->onDelete('set null');
        });
    }
    public function down()
    {
        Schema::dropIfExists('autoritecontractantes');
    }
} 