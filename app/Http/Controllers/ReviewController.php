<?php

namespace App\Http\Controllers;

use App\Review;
use App\Faculty;
use App\User;
use App\Http\Requests\ReviewRequest;

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
    
    public function create(Faculty $faculty)
    {
        return view('reviews/create')->with(['faculties' => $faculty->get()]);
    }
    
    public function edit(Review $review, Faculty $faculty)
    {
        return view('reviews/edit')->with(['review' => $review])->with(['faculties' => $faculty->get()]);
    }
    
    public function store(Review $review, ReviewRequest $request)
    {
        $input = $request['review'];
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
}
