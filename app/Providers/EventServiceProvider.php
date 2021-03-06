<?php

namespace App\Providers;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listeners\AchievementUnlocker;
use App\Listeners\BadgeUnlocker;
use App\Listeners\LessonWatcher;
use App\Listeners\TotalCommentWritten;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            TotalCommentWritten::class
        ],
        LessonWatched::class => [
            LessonWatcher::class
        ],
        AchievementUnlocked::class => [
            AchievementUnlocker::class
        ],
        BadgeUnlocked::class => [
            BadgeUnlocker::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
