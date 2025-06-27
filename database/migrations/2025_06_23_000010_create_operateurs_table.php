<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperateursTable extends Migration
{
    public function up()
    {
        Schema::create('operateurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pays');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('key_operateur', 32)->nullable();
            $table->string('des_operateur', 254)->nullable();
            $table->text('num_fiscal');
            $table->smallInteger('status')->default(1);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('secteuractivite_id')->nullable();
            $table->string('raison_social', 100)->nullable();
            $table->string('mail', 100)->nullable();
            $table->tinyInteger('jfe')->nullable();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->string('gnonelid', 50)->nullable();

            $table->foreign('id_pays')->references('id')->on('pays')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('secteuractivite_id')->references('idsecteuractivite')->on('secteuractivite')->onDelete('set null');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('set null');
        });
    }
    public function down()
    {
        Schema::dropIfExists('operateurs');
    }
} 