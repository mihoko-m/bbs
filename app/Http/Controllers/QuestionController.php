<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\AnswerRequest;
use App\Question;
use App\Review;
use App\Answer;

class QuestionController extends Controller
{
    public function create(Review $review)
    {
        return view('questions/create')->with(['review' => $review]);
    }
    
    public function store(Review $review, Question $question, QuestionRequest $request)
    {
        $input = $request['question'];
        $input += ['user_id' => $request->user()->id];
        $input += ['review_id' => $review->id];
        
        $question->fill($input)->save();
        return redirect('/reviews/' . $review->id);
    }
    
    public function delete(Review $review, Question $question)
    {
        if(\Auth::user()->id == $question->user_id){
            $question->delete();
            return redirect('/reviews/' . $review->id);
        }else{
            abort(403, '権限がありません');
        }
    }
    
    public function answercreate(Review $review, Question $question)
    {
        return view('questions/answercreate')->with(['question' => $question])->with(['review' => $review]);    
    }
    
    public function answerstore(Review $review, Question $question, Answer $answer, AnswerRequest $request)
    {
        if(\Auth::user()->id == $review->user_id){
            $input = $request['answer'];
            $input += ['question_id' => $question->id];
            
            $answer->fill($input)->save();
            return redirect('/reviews/' . $review->id);
        }else{
            abort(403, '権限がありません');
        }
    }
    
    public function answerdelete(Review $review, Question $question, Answer $answer)
    {
        if(\Auth::user()->id == $review->user_id){
            $answer->delete();
            return redirect('/reviews/' . $review->id);
        }else{
            abort(403, '権限がありません');
        }
    }
}
