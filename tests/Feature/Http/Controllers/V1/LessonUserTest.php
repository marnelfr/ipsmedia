<?php

namespace Tests\Feature\Http\Controllers\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Events\LessonWatched;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class LessonUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @return void
     */
    public function test_lesson_can_be_watched()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->post(route('lesson.watched'), [
            'lesson_id' => $lesson->id
        ]);

        $this->assertCount(1, $user->watched);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_lesson_written_event_is_dispatched()
    {
        $fake = Event::fake();
        DB::setEventDispatcher($fake);

        $user = User::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->post(route('lesson.watched'), [
            'lesson_id' => $lesson->id
        ]);

        Event::assertDispatched(LessonWatched::class);
        $response->assertStatus(200);
    }
}
