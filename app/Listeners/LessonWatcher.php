<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\LessonWatched;
use App\Models\Achievement;

class LessonWatcher
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        $is_watched = $event->user->lessons()->where('id', $event->lesson->id)->first();
        if ($is_watched) {
            return;
        }

        $event->user->lessons()->attach($event->lesson, ['watched' => true]);

        $achievement = Achievement::where('total_achievement', $event->user->lessons->count())
            ->where('type', 'Lesson')->first();
        if ($achievement) {
            AchievementUnlocked::dispatch($achievement->name, $event->user);
        }
    }
}
