<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'shop_id',
        'evaluation_general',
        'evaluation_meal',
        'evaluation_service',
        'evaluation_atmosphere',
        'comment',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
