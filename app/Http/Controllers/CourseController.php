<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    //

    public function index(){


       $allCourses = Course::orderBy('id', 'desc')->get();
       $allCourses = Course::select('courses.*','teachers.name as teacher_name','categories.category_name')
                    ->join('teachers','courses.teacher_id','teachers.id')
                    ->join('categories','courses.category_id','categories.id')
                    ->get();

        $courseTags = array();
        
        foreach($allCourses as $course){

            array_push($courseTags,$course->tags);
        }


        return response()->json([

            'status' => 200,
            'courses' => $allCourses,
            'courseTags' => $courseTags

        ]);

    }
    public function create()
    {

        $allCategories = Category::where('status', '=', 1)->get();
        $allTags = Tag::all();

        //  return  $allCategories;
        return view(
            'backEnd.course.add-course',
            [
                'categories' => $allCategories,
                'tags' => $allTags
            ]
        );
    }




    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [

            'tags' => 'required|min:1',
            'course_title' => 'required|string|max:255|min:10',
            'course_description' => 'required|string',
            'course_requirement' => 'required|string',
            'course_image' => 'required|image|mimes:png,jpg,jpeg',
            'slug' => 'unique:courses,slug',
            'course_price' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);

        } else {

            $finalSlug = $this->makeSlug($request);

            $course = Course::create([

                'category_id' => $request->category_id,
                'teacher_id' => $request->teacher_id,
                'course_title' => $request->course_title,
                'course_description' => $request->course_description,
                'course_requirements' => $request->course_requirement,
                'course_image' => $this->saveImage($request),
                'slug' => $finalSlug,
                'course_price' => $request->course_price

            ]);

            $tagIds = $request->tags;

            //Adding to the Pivot Table
            $course->tags()->attach($tagIds);

            return response()->json([

                'status' => 200,
                'message' => "Course Added Successfully!"
            ]);
        }
    }

    private function makeSlug(Request $request)
    {

        if ($request->slug) {
            $str = strtolower($request->slug);
            $slug =  preg_replace('/\s+/u', '-', trim($str));
            return $slug;
        } else {

            $str = strtolower($request->course_title);
            $slug =  preg_replace('/\s+/u', '-', trim($str));
            return $slug;
        }


    }
    private function saveImage(Request $request)
    {

        $image = $request->file('course_image');
        $imageExt = $image->getClientOriginalExtension();
        $imageName = rand() . '.' . $imageExt;
        $imageDirectory = 'adminAsset/courseImage/';
        $imageUrl = $imageDirectory . '' . $imageName;

        $image->move($imageDirectory, $imageName);

        return $imageUrl;
    }
}
