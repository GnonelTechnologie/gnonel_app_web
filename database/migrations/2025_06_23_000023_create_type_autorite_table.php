<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeAutoriteTable extends Migration
{
    public function up()
    {
        Schema::create('TypeAutorite', function (Blueprint $table) {
            $table->id('idtypeautorite');
            $table->string('libelletypeautorite', 70)->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('TypeAutorite');
    }
} 