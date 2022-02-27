<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AchievementUnlocker
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
    public function handle(AchievementUnlocked $event)
    {
        Achievement::create([
            'name' => $event->achievement_name,
            'user_id' => $event->user->id
        ]);

        $totat_achievement = $event->user->achievements->count();
        $badge = [4, 8, 10];

        switch ($totat_achievement) {
            case 4:
                $new_badge = 'Intermediate';
                break;
            case 8:
                $new_badge = 'Advanced';
                break;
            case 10:
                $new_badge = 'Master';
        }
    }
}
