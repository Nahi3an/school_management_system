<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function allCourses()
    {
        return view('backEnd.admin.course.all-course');
    }

    public function showAddCourse()
    {

        return view('backEnd.admin.course.add-course');
    }
}