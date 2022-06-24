<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function answer()
    {
        return $this->belongsTo('App\Answer');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    protected $fillable = [
        'body',
        'answer_id',
        'user_id',
    ];
}
