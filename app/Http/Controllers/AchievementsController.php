<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $achievements = $user->achievements();
        $next_comment_achievements = Achievement::where('type', 'Comment')->whereNotIn('name', $achievements->pluck('name'))->first()->name;
        $next_lesson_achievements = Achievement::where('type', 'Lesson')->whereNotIn('name', $achievements->pluck('name'))->first()->name;
        $user_badges = $user->badges()->orderBy('id', 'DESC');
        $owned_badges = $user_badges->pluck('name');
        $next_badge = Badge::whereNotIn('name', $owned_badges)->orderBy('total_achievement')->first();

        return response()->json([
            'unlocked_achievements' => $achievements->pluck('name'),
            'next_available_achievements' => [$next_comment_achievements, $next_lesson_achievements],
            'current_badge' => $user_badges->first()->name,
            'next_badge' => $next_badge->name,
            'remaing_to_unlock_next_badge' => $next_badge->total_achievement - $achievements->count()
        ]);
    }
}
