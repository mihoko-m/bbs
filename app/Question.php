<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function rerview()
    {
        return $this->belongsTo('App\Review');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    protected $fillable = [
        'body',
        'user_id',
        'review_id',
    ];
}
