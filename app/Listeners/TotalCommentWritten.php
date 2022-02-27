<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
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
        $total_comment_to_achieve = [1, 3, 5, 10, 20];
        if (in_array($total_comment, $total_comment_to_achieve)) {
            $achievement_name = $total_comment === 1
                ? 'First Comment Written'
                : $total_comment . ' Comments Written';

            AchievementUnlocked::dispatch($achievement_name, $user);
        }
    }
}
