<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
    
    public function replies()   
    {
        return $this->hasMany('App\Reply');  
    }
    
    protected $fillable = [
        'body',
        'question_id',
    ];
}
