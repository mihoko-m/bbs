<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function getPaginateByFaculty(int $limit_count = 10)
    {
        return $this->reviews()->with('faculty')->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByFacultyCredit(int $limit_count = 10)
    {
        return $this->reviews()->with('faculty')->orderBy('get_credit', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByFacultyAdequacy(int $limit_count = 10)
    {
        return $this->reviews()->with('faculty')->orderBy('adequacy', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByFacultySearch(int $limit_count, $search_subject, $search_teacher)
    {
    // created_atで降順に並べたあと、limitで件数制限をかける
        return $this->reviews()->with('faculty')
        ->whereHas('subject', function ($query) use ($search_subject) {
            $query->where('name', 'like', '%'.$search_subject.'%');
        })->whereHas('teacher', function ($query) use ($search_teacher) {
            $query->where('name', 'like', '%'.$search_teacher.'%');
        })->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByFacultySearchSubject(int $limit_count, $search_subject)
    {
    // created_atで降順に並べたあと、limitで件数制限をかける
        return $this->reviews()->with('faculty')
        ->whereHas('subject', function ($query) use ($search_subject) {
            $query->where('name', 'like', '%'.$search_subject.'%');
        })->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginateByFacultySearchTeacher(int $limit_count, $search_teacher)
    {
    // created_atで降順に並べたあと、limitで件数制限をかける
        return $this->reviews()->with('faculty')
        ->whereHas('teacher', function ($query) use ($search_teacher) {
            $query->where('name', 'like', '%'.$search_teacher.'%');
        })->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function reviews()   
    {
        return $this->hasMany('App\Review');  
    }
    
    public function users()   
    {
        return $this->hasMany('App\User');  
    }
}
