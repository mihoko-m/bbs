<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;

class FacultyController extends Controller
{
    public function index(Faculty $faculty, Request $request)
    {
        
        $search_subject = $request['search_subject'];
        $search_teacher = $request['search_teacher'];
        $order = $request['order'];
        

        if ($search_subject && $search_teacher) {
            
            $reviews = $faculty->getPaginateByFacultySearch(10, $search_subject, $search_teacher);
            
        } else if ($search_subject) {
            
            $reviews = $faculty->getPaginateByFacultySearchSubject(10, $search_subject);
            
        } else if ($search_teacher) {
            
            $reviews = $faculty->getPaginateByFacultySearchTeacher(10, $search_teacher);
            
        } else if ($order === "credit") {
            
            $reviews = $faculty->getpaginateByFacultyCredit();
            
        } else if ($order === "adequacy") {
            
            $reviews = $faculty->getpaginateByFacultyAdequacy();
            
        } else {
            
            $reviews = $faculty->getPaginateByFaculty();
            
        }
        
        return view('faculties/index')->with(['reviews' => $reviews])->with(['faculties' => $faculty->get()])->with(['faculty' => $faculty])
        ->with(['search_subject' => $search_subject])->with(['search_teacher' => $search_teacher])->with(['order' => $order]);;
    }
    
}
