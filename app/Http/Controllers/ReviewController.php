<?php

namespace App\Http\Controllers;

use App\Review;
use App\Faculty;
use App\User;
use App\Evaluation;
use App\Subject;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\SubjectRequest;

class ReviewController extends Controller
{
    public function index(Review $review)
    {
        return view('reviews/index')->with(['reviews' => $review->getPaginateByLimit()]);
    }
    
    public function show(Review $review)
    {
        return view('reviews/show')->with(['review' => $review]);
    }
    
    public function create(Faculty $faculty, Evaluation $evaluation)
    {
        return view('reviews/create')->with(['faculties' => $faculty->get()])->with(['evaluations' => $evaluation->get()]);
    }
    
    public function edit(Review $review, Faculty $faculty, Evaluation $evaluation)
    {
        return view('reviews/edit')->with(['review' => $review])->with(['faculties' => $faculty->get()])->with(['evaluations' => $evaluation->get()]);
    }
    
    public function store(Review $review, Subject $subject, ReviewRequest $request, SubjectRequest $request_subject)
    {
        $input = $request['review'];
        $input_subject = $request_subject['subject'];
        $name = $input_subject['name'];
        $check = $subject->where('name', "$name" )->first();
        
        if(is_null($check)){
            $subject->fill($input_subject)->save();
            $input += ['subject_id' => $subject->id];
        }else{
            $input += ['subject_id' => $check->id];
        }
        
        $input += ['user_id' => $request->user()->id];
        $review->fill($input)->save();
        return redirect('/reviews/' . $review->id);
    }
    
    public function update(ReviewRequest $request, Review $review)
    {
        if(\Auth::user()->id == $review->user_id){
            $input_review = $request['review'];
            $input_review += ['user_id' => $request->user()->id];
            $review->fill($input_review)->save();
            return redirect('/reviews/' . $review->id);
        }else{
            abort(403, '権限がありません');
        }
    }
    
    public function delete(Review $review)
    {
        if(\Auth::user()->id == $review->user_id){
            $review->delete();
            return redirect('/');
        }else{
            abort(403, '権限がありません');
        }
    }
}
