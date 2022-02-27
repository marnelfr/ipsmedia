<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Models\Achievement;
use App\Models\Badge;
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
        $unlocked_badge = Badge::firstWhere('total_achievement', $totat_achievement);
        if ($unlocked_badge) {
            BadgeUnlocked::dispatch($unlocked_badge->name, $event->user);
        }
    }
}
