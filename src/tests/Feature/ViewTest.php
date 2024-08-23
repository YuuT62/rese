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

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testUserView(){
        $data = [
            'role_id' => 3,
            'name'                  => 'テスト三郎',
            'email'                 => 'test3@example.com',
            'password'              => 'P@ssw0rd',
            'email_verified_at' => new DateTime('2024-01-01'),
        ];
        $user = User::factory()->create($data);

        $reservation = [
            "user_id" => 2,
            "shop_id" => 1,
            "reservation" => new DateTime('2024-04-01'),
            "num_people" => 2,
            "visit_status" => false,
            "evaluation_status" => false,
        ];
        Reservation::create($reservation);

        $response = $this
            ->actingAs($user)
            ->get('/');
        $response->assertOk();

        $response = $this
            ->actingAs($user)
            ->get('/detail/1');
        $response->assertOk();

        $response = $this
            ->actingAs($user)
            ->get('/mypage');
        $response->assertOk();

        $response = $this
            ->actingAs($user)
            ->get('/thanks');
        $response->assertOk();

        $response = $this
            ->actingAs($user)
            ->get('/done');
        $response->assertOk();

        $response = $this
            ->actingAs($user)
            ->post('/reservation/qr');
        $response->assertOk();

        $response = $this
            ->actingAs($user)
            ->get('/credit1000');
        $response->assertOk();

        $response = $this
            ->actingAs($user)
            ->get('/management');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->get('/add');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->get('/email');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->get('/shop/add');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->get('/edit/1');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->get('/reservation_list/1');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->get('/reservation_list/detail/1');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($user)
            ->get('bill');
        $response->assertStatus(403);

    }

    public function testAdminView(){
        $admin = User::find(1);

        $response = $this
            ->actingAs($admin)
            ->get('/');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/detail/1');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/mypage');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/thanks');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/done');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->post('/reservation/qr');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/credit1000');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/management');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/add');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/email');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/shop/add');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/edit/1');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/reservation_list/1');
        $response->assertOk();

        $response = $this
            ->actingAs($admin)
            ->get('/bill');
        $response->assertOk();
    }

    public function testRepresentativeView(){
        $data = [
            'role_id' => 2,
            'name'                  => 'テスト次郎',
            'email'                 => 'test2@example.com',
            'password'              => 'P@ssw0rd',
            'email_verified_at' => new DateTime('2024-01-01'),
        ];
        $representative= User::factory()->create($data);

        $response = $this
            ->actingAs($representative)
            ->get('/');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/detail/1');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/mypage');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/thanks');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/done');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->post('/reservation/qr');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/credit1000');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/management');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/add');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($representative)
            ->get('/email');
        $response->assertStatus(403);

        $response = $this
            ->actingAs($representative)
            ->get('/shop/add');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/edit/1');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/reservation_list/1');
        $response->assertOk();

        $response = $this
            ->actingAs($representative)
            ->get('/bill');
        $response->assertOk();
    }
}