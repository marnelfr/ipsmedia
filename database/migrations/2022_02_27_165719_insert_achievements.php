<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertAchievements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('achievements')->insert([
            [
                'name' => 'First Comment Written',
                'type' => 'Comment',
                'total_achievement' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '3 Comments Written',
                'type' => 'Comment',
                'total_achievement' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '5 Comments Written',
                'type' => 'Comment',
                'total_achievement' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '10 Comments Written',
                'type' => 'Comment',
                'total_achievement' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '20 Comments Written',
                'type' => 'Comment',
                'total_achievement' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => 'First Lesson Watched',
                'type' => 'Lesson',
                'total_achievement' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '3 Lessons Watched',
                'type' => 'Lesson',
                'total_achievement' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '5 Lessons Watched',
                'type' => 'Lesson',
                'total_achievement' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '10 Lessons Watched',
                'type' => 'Lesson',
                'total_achievement' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'name' => '20 Lessons Watched',
                'type' => 'Lesson',
                'total_achievement' => 20,
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
