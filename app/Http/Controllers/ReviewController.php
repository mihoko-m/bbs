<?php

namespace App\Http\Controllers;

use App\Review;
use App\Faculty;
use App\User;
use App\Evaluation;
use App\Subject;
use App\Teacher;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function index(Review $review, Faculty $faculty, Request $request)
    {
        
        $search_subject = $request['search_subject'];
        $search_teacher = $request['search_teacher'];
        $order = $request['order'];
        

        if ($search_subject && $search_teacher) {
            
            if ($order === "credit") {
                $reviews = $review->getPaginateBySearchCredit(10, $search_subject, $search_teacher);
            } else if ($order === "adequacy") {
                $reviews = $review->getPaginateBySearchAdequacy(10, $search_subject, $search_teacher);
            } else {
                $reviews = $review->getPaginateBySearch(10, $search_subject, $search_teacher);    
            }
            
        } else if ($search_subject) {
            
            if ($order === "credit") {
                $reviews = $review->getPaginateBySearchSubjectCredit(10, $search_subject);
            } else if ($order === "adequacy") {
                $reviews = $review->getPaginateBySearchSubjectAdequacy(10, $search_subject);
            } else {
                $reviews = $review->getPaginateBySearchSubject(10, $search_subject);    
            }
            
        } else if ($search_teacher) {
            
            if ($order === "credit") {
                $reviews = $review->getPaginateBySearchTeacherCredit(10, $search_teacher);
            } else if ($order === "adequacy") {
                $reviews = $review->getPaginateBySearchTeacherAdequacy(10, $search_teacher);
            } else {
                $reviews = $review->getPaginateBySearchTeacher(10, $search_teacher);    
            }
            
        } else if ($order === "credit") {
            
            $reviews = $review->getpaginateByCredit();
            
        } else if ($order === "adequacy") {
            
            $reviews = $review->getpaginateByAdequacy();
            
        } else {
            
            $reviews = $review->getPaginateByLimit();
            
        }

        
        return view('reviews/index')->with(['reviews' => $reviews])->with(['faculties' => $faculty->get()])
        ->with(['search_subject' => $search_subject])->with(['search_teacher' => $search_teacher])->with(['order' => $order]);
    }
    
    public function show(Review $review)
    {
        return view('reviews/show')->with(['review' => $review])->with(['questions' => $review->questions()->orderBy('created_at', 'DESC')->get()]);
    }
    
    public function create(Faculty $faculty, Evaluation $evaluation)
    {
        return view('reviews/create')->with(['faculties' => $faculty->get()])->with(['evaluations' => $evaluation->get()]);
    }
    
    public function edit(Review $review, Faculty $faculty, Evaluation $evaluation)
    {
        return view('reviews/edit')
        ->with(['review' => $review])
        ->with(['faculties' => $faculty->get()])
        ->with(['evaluations' => $evaluation->get()]);
    }
    
    public function store(Review $review, Subject $subject, Teacher $teacher, ReviewRequest $request)
    {
        $input = $request['review'];
        
        $input_subject = $request['subject'];
        $subject_name = $input_subject['name'];
        $subject_check = $subject->where('name', "$subject_name" )->first();
        
        if(is_null($subject_check)){
            $subject->fill($input_subject)->save();
            $input += ['subject_id' => $subject->id];
        }else{
            $input += ['subject_id' => $subject_check->id];
        }
        
        $input_teacher = $request['teacher'];
        $teacher_name = $input_teacher['name'];
        $teacher_check = $teacher->where('name', "$teacher_name" )->first();
        
        if(is_null($teacher_check)){
            $teacher->fill($input_teacher)->save();
            $input += ['teacher_id' => $teacher->id];
        }else{
            $input += ['teacher_id' => $teacher_check->id];
        }
        
        $input += ['user_id' => $request->user()->id];
        $review->fill($input)->save();
        return redirect('/reviews/' . $review->id);
    }
    
    public function update(Review $review, Subject $subject, Teacher $teacher, ReviewRequest $request)
    {
        if(\Auth::user()->id == $review->user_id){
            $input_review = $request['review'];
            
            $input_subject = $request['subject'];
            $subject_name = $input_subject['name'];
            $subject_check = $subject->where('name', "$subject_name" )->first();
            
            if(is_null($subject_check)){
                $subject->fill($input_subject)->save();
                $input_review += ['subject_id' => $subject->id];
            }else{
                $input_review += ['subject_id' => $subject_check->id];
            }
            
            $input_teacher = $request['teacher'];
            $teacher_name = $input_teacher['name'];
            $teacher_check = $teacher->where('name', "$teacher_name")->first();
            
            if(is_null($teacher_check)){
                $teacher->fill($input_teacher)->save();
                $input_review += ['teacher_id' => $teacher->id];
            }else{
                $input_review += ['teacher_id' => $teacher_check->id];
            }
            
            $input_review += ['user_id' => $request->user()->id];
            $review->fill($input_review)->save();
            return redirect('/reviews/' . $review->id);
        }else{
            abort(403, '????????????????????????');
        }
    }
    
    public function delete(Review $review)
    {
        if(\Auth::user()->id == $review->user_id){
            $review->delete();
            return redirect('/');
        }else{
            abort(403, '????????????????????????');
        }
    }
    
    public function get_creditRanking(Review $review)
    {
        $groups = $review->get_creditRank();
        return view('reviews/get_credit')->with(['groups' => $groups]);
    }
    
    public function adequacyRanking(Review $review)
    {
        $groups = $review->adequacyRank();
        return view('reviews/adequacy')->with(['groups' => $groups]);
    }
    
    public function searchindex(Teacher $teacher, Subject $subject, Review $review)
    {
        $reviews = $review->search($teacher, $subject);
        $get_credit = $reviews->avg('get_credit');
        $adequacy = $reviews->avg('adequacy');
        
        return view('reviews/searchindex')
        ->with(['reviews' => $reviews])->with(['teacher' => $teacher])->with(['subject' => $subject])
        ->with(['get_credit' => $get_credit])->with(['adequacy' => $adequacy]);
    }
}
