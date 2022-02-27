<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $total_lesson_watched = $event->user->lessons->count();
        $total_lesson_to_watch = [1, 5, 10, 25, 50];
        if (in_array($total_lesson_watched, $total_lesson_to_watch)) {
            $achievement_name = $total_lesson_watched === 1
                ? 'First Lesson Watched'
                : $total_lesson_watched . ' Lessons Watched';

            AchievementUnlocked::dispatch($achievement_name, $event->user);
        }
    }
}
