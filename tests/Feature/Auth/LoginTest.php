<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_logged()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertEquals($user->id, auth()->id());
        $response->assertStatus(200);
    }

    public function test_user_cannot_log_out_if_not_logged_in()
    {
        $user = User::factory()->create();

        $response = $this->post(route('logout'));
        $data = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertFalse($data->success);
    }

    public function test_user_can_log_out_if_logged_in()
    {
        $user = User::factory()->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->post(route('logout'));
        $data = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertTrue($data->success);
    }
}
