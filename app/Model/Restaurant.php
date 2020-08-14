<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';

    protected $fillable = [
        'dish_id', 'name', 'slug', 'thumb', 'og_image', 'type', 'address', 'time', 'price', 'rate', 'link', 'link_encode', 'status'
    ];

    public function menu()
    {
    	return $this->hasMany(Menu::class);
    }

    public function dish()
    {
    	return $this->belongsTo(Dish::class);
    }

    public function comment()
    {
    	return $this->hasMany(Comment::class);
    }
}
