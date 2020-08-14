<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'restaurant_id', 'content', 'user_id'
    ];

    public function restaurant()
    {
    	return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

