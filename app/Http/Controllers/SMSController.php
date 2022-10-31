<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{

    public function index()
    {
        return view('frontEnd.home.home');
    }

    public function about()
    {
        return view('frontEnd.about.about');
    }

    public function course()
    {
        return view('frontEnd.course.course');
    }

    public function contact()
    {
        return view('frontEnd.contact.contact');
    }

    public function studentLogin()
    {

        return view('frontEnd.student.login');
    }
    public function teacherLogin()
    {

        return view('frontEnd.teacher.login');
    }

    public function teacherDashboard(){

        return view('backEnd.teacher.home.home');
    }
    // public function studentRegister()
    // {

    //     return view('frontEnd.student.register');
    // }

    // public function showTeacherLogin()
    // {

    //     return view('backEnd.admin.teacher.login');
    // }
}
