<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Shop extends Model
{
    use HasFactory;

    protected $fillable =[
        'shop_name',
        'user_id',
        'genre_id',
        'area_id',
        'overview',
        'img'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function evaluation(){
        return $this->hasMany(Evaluation::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function scopeAreaSearch($query, $area_id){
        if (!empty($area_id)) {
        $query->where('area_id', $area_id);
        }
    }

    public function scopeGenreSearch($query, $genre_id){
        if (!empty($genre_id)) {
        $query->where('genre_id', $genre_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword){
        if (!empty($keyword)) {
        $query->where('shop_name', 'like', '%' . $keyword . '%');
        }
    }

    public function scopeUserSearch($query, $user_id){
        if(!empty($user_id)){
            $query->where('user_id', $user_id);
        }
    }

    public function isFavoriteBy($user): bool {
        return Favorite::where('user_id', $user->id)->where('shop_id', $this->id)->first() !==null;
    }
}
