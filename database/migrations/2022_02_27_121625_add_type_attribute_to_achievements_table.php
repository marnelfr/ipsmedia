<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeAttributeToAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->string('type'); //Comment || Lesson
            $table->unsignedSmallInteger('total_achievement')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->dropMorphs('task');
            $table->dropColumn('total_achievement');
        });
    }
}
