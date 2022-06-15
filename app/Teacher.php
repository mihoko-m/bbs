<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function reviews()   
    {
        return $this->hasMany('App\Review');  
    }
    
    protected $fillable = [
        'name',
    ];
}
