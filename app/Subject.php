<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function reviews()   
    {
        return $this->hasMany('App\Review');  
    }
    
    protected $fillable = [
        'name',
    ];
}
