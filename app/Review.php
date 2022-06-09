<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function getPaginateByLimit(int $limit_count = 10)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('faculty')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    protected $fillable = [
        'class',
        'body',
        'adequacy',
        'get_credit',
        'faculty_id',
        'user_id',
        'subject_id',
    ];
    
    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function evaluation()
    {
        return $this->belongsTo('App\Evaluation');
    }
    
    public function subject()
    {
        return $this->belongsTo('App\Faculty');
    }
}
