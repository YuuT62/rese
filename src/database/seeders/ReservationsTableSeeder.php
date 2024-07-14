<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'shop_id' => 1,
            'reservation' => '2024-07-30 17:00:00',
            'num_people' => 2,
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => 2,
            'shop_id' => 2,
            'reservation' => '2024-07-30 18:00:00',
            'num_people' => 4,
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => 1,
            'shop_id' => 3,
            'reservation' => '2024-07-31 19:00:00',
            'num_people' => 3,
        ];
        DB::table('reservations')->insert($param);
    }
}
