<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateBonusTo5Percent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Mettre à jour le bonus de réduction à 5%
        DB::table('configurations')->update(['bonus' => 5]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remettre le bonus à sa valeur précédente (20%)
        DB::table('configurations')->update(['bonus' => 20]);
    }
} 