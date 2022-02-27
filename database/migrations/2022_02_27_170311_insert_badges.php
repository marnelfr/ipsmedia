<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('badges')->insert([
            [
                'total_achievement' => 0,
                'name' => 'Beginner',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'total_achievement' => 4,
                'name' => 'Intermediate',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'total_achievement' => 8,
                'name' => 'Advanced',
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'total_achievement' => 10,
                'name' => 'Master',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
