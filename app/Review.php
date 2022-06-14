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
    
    public function getPaginateBySearch(int $limit_count, $search_subject)
    {
    // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('subject', function ($query) use ($search_subject) {
                $query->where('name', 'like', '%'.$search_subject.'%');
            })->paginate($limit_count);
    }
    
    protected $fillable = [
        'class',
        'body',
        'adequacy',
        'get_credit',
        'faculty_id',
        'user_id',
        'subject_id',
        'evaluation_id',
        'teacher_id',
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
        return $this->belongsTo('App\Subject');
    }
    
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
