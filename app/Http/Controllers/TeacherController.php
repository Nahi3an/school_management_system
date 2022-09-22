<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Session;

class TeacherController extends Controller
{
    //
    public $teacher, $image, $imageName, $imageDirectory, $imageUrl, $allTeachers, $teacherInfo;
    public function index()
    {

        return view('backEnd.admin.teacher.add-teacher');
    }

    public function addNewTeacher(Request $request)
    {
        $this->teacher = new Teacher();
        $this->teacher->name = $request->name;
        $this->teacher->phone = $request->phone;
        $this->teacher->email = $request->email;
        $this->teacher->password = bcrypt('12345678');
        $this->teacher->address = $request->address;
        $this->teacher->image = $this->saveImage($request);

        $this->teacher->save();

        return back()->with('message', 'Teacher Added!');
    }

    private function saveImage(Request $request)
    {

        $this->image = $request->file('image');
        $this->imageName = rand() . '.' . $this->image->getClientOriginalExtension();
        $this->imageDirectory = 'adminAsset/teacherImage/';
        $this->imageUrl = $this->imageDirectory . $this->imageName;

        $this->image->move($this->imageDirectory, $this->imageName);

        return $this->imageUrl;
    }

    public function allTeachers()
    {
        $this->allTeachers = Teacher::all();

        return view('backEnd.admin.teacher.all-teacher', ['teachers' => $this->allTeachers]);
    }

    public function editTeacher($id)
    {
        $this->teacher = Teacher::find($id);
        return view('backEnd.admin.teacher.edit-teacher', ['teacher' => $this->teacher]);
    }

    public function deleteTeacher(Request $request)
    {
        $this->teacher = Teacher::find($request->id);

        if ($this->teacher->image) {
            unlink($this->teacher->image);
        }

        $this->teacher->delete();

        return back()->with('message', 'Teacher Information Deleted');
    }

    public function updateTeacher(Request $request)
    {

        $this->teacher = Teacher::find($request->id);
        $this->teacher->name = $request->name;
        $this->teacher->phone = $request->phone;
        $this->teacher->email = $request->email;
        $this->teacher->address = $request->address;
        if ($request->file('image')) {
            if ($this->teacher->image) {

                unlink($this->teacher->image);
            }
            $this->teacher->image = $this->saveImage($request);
        }

        $this->teacher->save();

        return redirect('/all-teacher')->with('message', 'Teacher Information Updated!');
    }

    public function showTeacherLogin()
    {

        return view('backEnd.admin.teacher.login');
    }

    public function checkTeacherLogin(Request $request)
    {

        $this->teacherInfo = Teacher::where('email', $request->user_name)
            ->orWhere('phone', $request->user_name)
            ->first();

        if ($this->teacherInfo) {

            if (password_verify($request->password, $this->teacherInfo->password)) {

                Session::put('teacherId', $this->teacherInfo->id);
                Session::put('teacherName', $this->teacherInfo->name);

                return redirect()->route('home');
            } else {
                return back()->with('message', 'Incorrect Password!');
            }
        } else {

            return back()->with('message', 'Email or Phone Not Found!');
        }
    }

    public function teacherLogout()
    {
        Session::forget('teacherId');
        Session::forget('teacherName');

        return redirect()->route('home');
    }
    public function showTeacherDashboard()
    {

        return view('backEnd.admin.teacher.dashboard');
    }
}