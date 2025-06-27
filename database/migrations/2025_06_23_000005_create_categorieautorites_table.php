<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieautoritesTable extends Migration
{
    public function up()
    {
        Schema::create('categorieautorites', function (Blueprint $table) {
            $table->id();
            $table->string('libelleCat', 100);
            $table->string('description', 100);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('categorieautorites');
    }
} 