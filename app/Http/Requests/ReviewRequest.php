<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'review.body' => 'required|string|max:300',
            'subject.name' => 'required|string|max:50',
            'teacher.name' => 'required|string|max:50',
            'review.evaluation_id' => 'required',
            'review.faculty_id' => 'required',
            'review.get_credit' => 'required',
            'review.adequacy' => 'required',
        ];
    }
}
