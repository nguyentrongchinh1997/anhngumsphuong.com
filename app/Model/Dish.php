<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishs';

    protected $fillable = [
        'name', 'slug'
    ];

    public function restaurant()
    {
    	return $this->hasMany(Restaurant::class);
    }
}
