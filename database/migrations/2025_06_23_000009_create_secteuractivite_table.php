<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecteuractiviteTable extends Migration
{
    public function up()
    {
        Schema::create('secteuractivite', function (Blueprint $table) {
            $table->id('idsecteuractivite');
            $table->string('libellesecteuractivite', 100)->nullable();
            $table->string('codesecteur', 3)->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('secteuractivite');
    }
} 