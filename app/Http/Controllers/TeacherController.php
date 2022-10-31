<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function checkTeacherLogin(Request $request)
    {

        $teacher = Teacher::where('email', '=', $request->email)->first();

        if ($teacher) {

            if (Hash::check($request->password, $teacher->password)) {

                Session::put('teacherId', $teacher->id);
                Session::put('teacherName', $teacher->name);
                Session::put('teacherImage', $teacher->image);


                return redirect()->route('teacher.dashboard');
            } else {

                return back()->with('message', 'Incorrect Credentials!');
            }
        } else {

            return back()->with('message', 'No User Found!');
        }
    }

    public function teacherLogout()
    {

        Session::forget('teacherId');
        Session::forget('teacherName');

        return redirect()->route('home');
    }
    public function index()
    {


        $allTeachers = Teacher::all();

        return response()->json([
            'teachers' => $allTeachers
        ]);

        //return view('backEnd.admin.teacher.all-teacher');
    }

    public function showTeachers()
    {

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

        return view('backEnd.teacher.add-teacher');
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
                'password' => Hash::make('12345678'),
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

        if ($teacher) {
            return response()->json([
                'status' => 200,
                'teacher' => $teacher
            ]);
        } else {

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
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:30|min:5|string',
            'email' => 'required|min:5|email',
            'phone' => 'required|string|max:11|min:11',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            $teacher = Teacher::find($id);

            if ($teacher) {

                $updateImage = $teacher->image;

                if ($request->file('image')) {

                    unlink($teacher->image);
                    $updateImage = $this->saveImage($request);
                }

                $teacher->update([

                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'image' => $updateImage

                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Teacher Info Saved!'
                ]);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'Teacher Not Found!'
                ]);
            }
        }
    }

    public function changeStatus($id)
    {

        $teacher = Teacher::find($id);

        if ($teacher) {

            if ($teacher->status == 1) {

                $teacher->status = 0;
            } else {
                $teacher->status = 1;
            }

            $teacher->update();

            $teacher = Teacher::find($id);

            return response()->json([

                'status' => 200,
                'teacherStatus' => $teacher->status,
                'message' => "Permission Changed"
            ]);
        } else {

            return response()->json([

                'status' => 404,
                'message' => "Teacher Not Found!"
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher, $id)
    {
        //

        $teacher = Teacher::find($id);

        if ($teacher) {

            if ($teacher->image) {

                unlink($teacher->image);
            }

            $teacher->delete();

            return response()->json([
                'status' => 200,
                'message' => "Teacher Information Deleted"
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Teacher Not Found!'
            ]);
        }
    }
}
