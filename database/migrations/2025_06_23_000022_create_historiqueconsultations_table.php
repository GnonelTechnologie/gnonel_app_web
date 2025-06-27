<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriqueconsultationsTable extends Migration
{
    public function up()
    {
        Schema::create('historiqueconsultations', function (Blueprint $table) {
            $table->id();
            $table->integer('type_consultation');
            $table->integer('id_ressource');
            $table->integer('type_consultant');
            $table->integer('id_consultant');
            $table->dateTime('created_at');
        });
    }
    public function down()
    {
        Schema::dropIfExists('historiqueconsultations');
    }
} 