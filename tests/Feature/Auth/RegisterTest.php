<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_registered()
    {
        $response = $this->post(route('register'), [
            'name' => 'Nel',
            'email' => 'nel@dev.dfr',
            'password' => '@Dev2022',
            'password_confirmation' => '@Dev2022'
        ]);

        $this->assertCount(1, User::all());
        $response->assertStatus(200);
    }
}
