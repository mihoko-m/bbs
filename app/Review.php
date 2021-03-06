<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function getPaginateByLimit(int $limit_count = 10)
    {
    // created_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByCredit(int $limit_count = 10)
    {
    // get_creditで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('get_credit', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByAdequacy(int $limit_count = 10)
    {
    // adequacyで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('adequacy', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearch(int $limit_count, $search_subject, $search_teacher)
    {
    // created_atで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('subject', function ($query) use ($search_subject) {
                $query->where('name', 'like', '%'.$search_subject.'%');
            })->whereHas('teacher', function ($query) use ($search_teacher) {
                $query->where('name', 'like', '%'.$search_teacher.'%');
            })->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearchCredit(int $limit_count, $search_subject, $search_teacher)
    {
    // get_creditで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('subject', function ($query) use ($search_subject) {
                $query->where('name', 'like', '%'.$search_subject.'%');
            })->whereHas('teacher', function ($query) use ($search_teacher) {
                $query->where('name', 'like', '%'.$search_teacher.'%');
            })->orderBy('get_credit', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearchAdequacy(int $limit_count, $search_subject, $search_teacher)
    {
    // adequacyで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('subject', function ($query) use ($search_subject) {
                $query->where('name', 'like', '%'.$search_subject.'%');
            })->whereHas('teacher', function ($query) use ($search_teacher) {
                $query->where('name', 'like', '%'.$search_teacher.'%');
            })->orderBy('adequacy', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearchSubject(int $limit_count, $search_subject)
    {
    // created_atで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('subject', function ($query) use ($search_subject) {
                $query->where('name', 'like', '%'.$search_subject.'%');
            })->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearchSubjectCredit(int $limit_count, $search_subject)
    {
    // get_creditで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('subject', function ($query) use ($search_subject) {
                $query->where('name', 'like', '%'.$search_subject.'%');
            })->orderBy('get_credit', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearchSubjectAdequacy(int $limit_count, $search_subject)
    {
    // adequacyで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('subject', function ($query) use ($search_subject) {
                $query->where('name', 'like', '%'.$search_subject.'%');
            })->orderBy('adequacy', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearchTeacher(int $limit_count, $search_teacher)
    {
    // created_atで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('teacher', function ($query) use ($search_teacher) {
                $query->where('name', 'like', '%'.$search_teacher.'%');
            })->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearchTeacherCredit(int $limit_count, $search_teacher)
    {
    // get_creditで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('teacher', function ($query) use ($search_teacher) {
                $query->where('name', 'like', '%'.$search_teacher.'%');
            })->orderBy('get_credit', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateBySearchTeacherAdequacy(int $limit_count, $search_teacher)
    {
    // adequacyで降順に並べたあと、limitで件数制限をかける
        return $this->whereHas('teacher', function ($query) use ($search_teacher) {
                $query->where('name', 'like', '%'.$search_teacher.'%');
            })->orderBy('adequacy', 'DESC')->paginate($limit_count);
    }
    
    public function get_creditRank()
    {
        return $this->select('subject_id','teacher_id')->selectRaw('AVG(get_credit) as get_credit')
        ->orderBy('get_credit','DESC')->take(5)->groupBy('subject_id','teacher_id')->get();
    }
    
    public function adequacyRank()
    {
        return $this->select('subject_id','teacher_id')->selectRaw('AVG(adequacy) as adequacy')
        ->orderBy('adequacy','DESC')->take(5)->groupBy('subject_id','teacher_id')->get();
    }
    
    public function search($teacher, $subject)
    {
        return $this->where('teacher_id', $teacher->id)->where('subject_id', $subject->id)->orderBy('created_at', 'DESC')->get();
    }
    
    protected $fillable = [
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
    
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
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
    
    public function questions()   
    {
        return $this->hasMany('App\Question');  
    }
}
