<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'shop_id',
        // 'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

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

    public function scopeStatusSearch($query, $status){
        if(!empty($status)){
            $query->where('status', $status);
        }
    }
}
