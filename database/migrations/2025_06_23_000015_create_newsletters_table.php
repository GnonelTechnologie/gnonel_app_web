<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('email_n', 200)->unique();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('newsletters');
    }
} 