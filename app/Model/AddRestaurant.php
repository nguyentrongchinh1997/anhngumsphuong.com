<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AddRestaurant extends Model
{
    protected $table = 'add_restaurants';

    protected $fillable = [
        'name', 'thumb', 'type', 'address', 'time', 'price', 'menu'
    ];
}
