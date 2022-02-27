<?php

namespace App\Http\Controllers\V1;

use App\Events\LessonWatched;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LessonUserRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonUserController extends Controller
{

    public function create(LessonUserRequest $request)
    {
        $request->validated();

        try {
            $lesson = Lesson::findOrFail($request->lesson_id);
            LessonWatched::dispatch($lesson, auth()->user());

            return [
                'success' => true,
                'message' => __('messages.lesson.watched'),
                'data' => [
                    'version' => '1.0'
                ]
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => __('messages.error.internal'),
                'data' => [
                    'version' => '1.0',
                    'exception' => $e->getMessage()
                ]
            ];
        }
    }
}
