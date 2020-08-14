<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'restaurant_id', 'name'
    ];

    public function restaurant()
    {
    	return $this->belongsTo(Restaurant::class);
    }
}
