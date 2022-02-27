<?php

namespace Tests\Feature\Http\Controllers\V1;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class CommentsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @return void
     */
    public function test_comment_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->post(route('comment.create'), [
            'body' => 'comment body'
        ]);

        $this->assertCount(1, Comment::all());
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_comment_written_event_is_dispatched()
    {
        $fake = Event::fake();
        DB::setEventDispatcher($fake);


        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->post(route('comment.create'), [
            'body' => 'comment body'
        ]);

        Event::assertDispatched(CommentWritten::class);
        $response->assertStatus(200);
    }
}
