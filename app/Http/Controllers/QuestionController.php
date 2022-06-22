<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Review;
use App\Answer;

class QuestionController extends Controller
{
    public function create(Review $review)
    {
        return view('questions/create')->with(['review' => $review]);
    }
    
    public function store(Review $review, Question $question, Request $request)
    {
        $input = $request['question'];
        $input += ['user_id' => $request->user()->id];
        $input += ['review_id' => $review->id];
        
        $question->fill($input)->save();
        return redirect('/reviews/' . $review->id);
    }
    
    public function delete(Review $review, Question $question)
    {
        $question->delete();
        return redirect('/reviews/' . $review->id);
    }
    
    public function answercreate(Question $question)
    {
        return view('questions/answercreate')->with(['question' => $question]);    
    }
    
    public function answerstore(Question $question, Answer $answer, QuestionRequest $request)
    {
        
    }
}
