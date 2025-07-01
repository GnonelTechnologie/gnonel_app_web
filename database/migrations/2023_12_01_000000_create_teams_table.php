<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Créateur de l'équipe
            $table->unsignedBigInteger('member_id'); // Membre de l'équipe
            $table->string('team_name')->nullable(); // Nom de l'équipe
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('role', ['owner', 'member', 'admin'])->default('member');
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
            
            // Éviter les doublons
            $table->unique(['user_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
} 