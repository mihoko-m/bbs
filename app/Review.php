<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function getPaginateByLimit(int $limit_count = 10)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    protected $fillable = [
        'class',
        'body',
        'adequacy',
        'get_credit',
        'teacher_familyname',
        'teacher_firstname',
    ];
}
