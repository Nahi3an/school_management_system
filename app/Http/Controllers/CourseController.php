<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function create(){

        $allCategories = Category::where('status','=',1)->get();

      //  return  $allCategories;
        return view('backEnd.course.add-course',['categories'=>$allCategories]);
    }
}
