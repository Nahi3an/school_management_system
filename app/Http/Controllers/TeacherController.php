<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allTeachers = Teacher::all();

        return response()->json([
            'teachers' => $allTeachers
        ]);

        //return view('backEnd.admin.teacher.all-teacher');
    }

    public function showTeachers(){

        $allTeachers = Teacher::all();

        return response()->json([
            'teachers' => $allTeachers
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('backEnd.admin.teacher.add-teacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:30|min:5|string',
            'email' => 'required|min:5|email',
            'phone' => 'required|string|max:11|min:11',
            'address' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        if ($validator->fails()) {

            return response()->json(
                [
                    'status' => 400,
                    'errors' =>  $validator->messages()
                ]
            );
        } else {

            Teacher::create([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $this->saveImage($request)

            ]);
            // $data = $this->saveImage($request);
            return response()->json(
                [
                    'status' => 200,
                    'message' => "Teacher Added Successfully!"
                ]
            );
        }
    }
    private function saveImage(Request $request)
    {

        $image = $request->file('image');
        $imageExt = $image->getClientOriginalExtension();
        $imageName = rand() . '.' . $imageExt;
        $imageDirectory = 'adminAsset/teacherImage/';
        $imageUrl = $imageDirectory . '' . $imageName;

        $image->move($imageDirectory, $imageName);

        return $imageUrl;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);

        if($teacher){
            return response()->json([
                'status' => 200,
                'teacher' => $teacher
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "Teacher Not Found!"
            ]);

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
