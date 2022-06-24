<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\AnswerRequest;
use App\Http\Requests\ReplyRequest;
use App\Question;
use App\Review;
use App\Answer;
use App\Reply;

class QuestionController extends Controller
{
    public function create(Review $review)
    {
        return view('questions/create')->with(['review' => $review]);
    }
    
    public function show(Review $review, Question $question, Answer $answer)
    {
        return view('questions/show')->with(['review' => $review])->with(['question' => $question])->with(['replies' => $answer->replies()->get()]);
    }
    
    public function store(Review $review, Question $question, QuestionRequest $request)
    {
        $input = $request['question'];
        $input += ['user_id' => $request->user()->id];
        $input += ['review_id' => $review->id];
        
        $question->fill($input)->save();
        return redirect('/reviews/' . $review->id);
    }
    
    public function replystore(Review $review, Question $question, Answer $answer, Reply $reply, ReplyRequest $request)
    {
        if(\Auth::user()->id == $review->user_id || \Auth::user()->id == $question->user_id){
            $input = $request['reply'];
            $input += ['user_id' => $request->user()->id];
            $input += ['answer_id' => $answer->id];
        
            $reply->fill($input)->save();
            return redirect('/reviews/' . $review->id . '/questions/' . $question->id . '/answers/' . $answer->id);
        }else{
            abort(403, '権限がありません');
        }
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
    
    public function replydelete(Review $review, Question $question, Answer $answer, Reply $reply)
    {
        if(\Auth::user()->id == $reply->user_id){
            $reply->delete();
            return redirect('/reviews/' . $review->id . '/questions/' . $question->id . '/answers/' . $answer->id);
        }else{
            abort(403, '権限がありません');
        }
    }
}
