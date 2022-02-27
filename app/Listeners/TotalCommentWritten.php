<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Models\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TotalCommentWritten
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
    public function handle(CommentWritten $event)
    {
        $user = $event->comment->user;
        $total_comment = $user->comments->count();
        $achievement = Achievement::where('total_achievement', $total_comment)->where('type', 'Comment')->first();
        if ($achievement) {
            AchievementUnlocked::dispatch($achievement->name, $user);
        }
    }
}
