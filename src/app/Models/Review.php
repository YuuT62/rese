<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'shop_id',
        'score',
        'comment',
        'review_img',
    ];

    public function scopeUserSearch($query, $user_id){
        if(!empty($user_id)){
            $query->where('user_id', $user_id);
        }
    }

    public function scopeShopSearch($query, $shop_id){
        if(!empty($shop_id)){
            $query->where('shop_id', $shop_id);
        }
    }
}
