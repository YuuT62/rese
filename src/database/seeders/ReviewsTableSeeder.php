<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
            "user_id" => 4,
            "shop_id" => 1,
            "score" => 3,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 5,
            "shop_id" => 1,
            "score" => 3,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 4,
            "shop_id" => 2,
            "score" => 2,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 5,
            "shop_id" => 2,
            "score" => 3,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 4,
            "shop_id" => 3,
            "score" => 5,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 5,
            "shop_id" => 3,
            "score" => 5,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 4,
            "shop_id" => 4,
            "score" => 3,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 5,
            "shop_id" => 4,
            "score" => 4,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 4,
            "shop_id" => 5,
            "score" => 5,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);

        $param =[
            "user_id" => 5,
            "shop_id" => 5,
            "score" => 4,
            "comment" => "テストコメント、テストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメントテストコメント",
            "review_img" => null,
        ];
        DB::table('reviews')->insert($param);
    }
}
