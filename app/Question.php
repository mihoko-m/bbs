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
    
    public function answer()
    {
        return $this->hasOne('App\Answer');
    }
    
    protected $fillable = [
        'body',
        'user_id',
        'review_id',
    ];
}
