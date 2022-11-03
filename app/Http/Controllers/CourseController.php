<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    //

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

            'tag_names' => 'required|min:1',
            'course_title' => 'required|string|max:255|min:10',
            'course_description' => 'required|string',
            'course_image' => 'required|image|mimes:png,jpg,jpeg',
            'slug' => 'unique:courses,slug',
            'course_price' => 'required|integer'
        ]);

        if ($validator->fails()) {

            return $validator->messages();
        } else {

            Course::create([

                'category_id' => $request->category_id,
                'teacher_id' => $request->teacher_id,
                'course_title' => $request->course_title,
                'course_description' => $request->course_description,
                'course_image' => $this->saveImage($request),
                'slug' => $request->slug,
                'course_price' => $request->course_price

            ]);

            $course = Course::where('slug', '=', $request->slug)->first();

            //$course->roles()->attach($role_ids);
            $tagNames = $request->tag_names;
            $course->tags()->attach($tagNames);
            return  $course;
        }



        return response()->json([

            'status' => 200,
            'message' => $request->tag_names
        ]);
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
