<?php

namespace App\Http\Controllers\V1;

use App\Events\CommentWritten;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CommentRequest;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function create(CommentRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->id();

        try {
            $comment = Comment::create($attributes);

            CommentWritten::dispatch($comment);

            return [
                'success' => true,
                'message' => __('messages.comment.success'),
                'data' => [
                    'version' => '1.0',
                    'comment' => $comment
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
