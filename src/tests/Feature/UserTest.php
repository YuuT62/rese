<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DateTime;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\Evaluation;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testUserRegister(){
        $data = [
            'role_id' => 3,
            'name'                  => 'テスト次郎',
            'email'                 => 'test2@example.com',
            'password'              => 'P@ssw0rd',
            'email_verified_at' => new DateTime('2024-01-01'),
        ];

        $response = $this->postJson(route('register'), $data);

        $response->assertStatus(201)
            ->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name'    => 'テスト次郎',
            'email'   => 'test2@example.com',
        ]);
    }
}
