<?php

namespace Tests\Feature\Http\Controllers\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * @return void
     */
    public function test_user_info_can_be_displayed()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response = $this->get(route('user.info'));

        $this->assertTrue(str_contains($response->getContent(), $user->name));
        $response->assertStatus(200);
    }
}
