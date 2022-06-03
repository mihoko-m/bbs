<?php

namespace App\Http\Controllers;

use App\Review;
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
    public function create()
    {
        return view('reviews/create');
    }
    public function store(Review $review, ReviewRequest $request)
    {
        $input = $request['review'];
        $review->fill($input)->save();
        return redirect('/reviews/' . $review->id);
    }
}
