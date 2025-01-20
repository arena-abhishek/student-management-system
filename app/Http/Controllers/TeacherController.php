<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return view('teacher.teacher.form');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required',
            'mobno' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->academic_year_id = $request->academic_year_id;
        $user->class_id = $request->class_id;
        $user->admission_date = $request->admission_date;
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->mobno = $request->mobno;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher';
        $user->save();
        return redirect()->route('teacher.create')->with('success', 'teacher Added succesfully');
    }

    public function read(Request $request)
    {
        $query = User::where('role', 'teacher')->latest();
        $teachers = $query->get();
        $data['teachers'] = $teachers;
        return view('teacher.teacher.list', $data);
    }

    public function delete($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teacher.read')->with('success', 'teacher Deleted Successfully');
    }

    public function edit($id)
    {
        $data['teacher'] = User::findOrFail($id);
        return view('teacher.teacher.form_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->mobno = $request->mobno;
        $user->email = $request->email;
        $user->update();
        return redirect()->route('teacher.read')->with('success', 'teacher Updated Successfully');
    }

    public function login()
    {
        return view('teacher.login');
    }
    public function authenticate(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
          ]);
          if (Auth::guard('teacher')->attempt(['email' => $req->email, 'password' => $req->password])) {

            if (Auth::guard('teacher')->user()->role != 'teacher') {
              Auth::guard('teacher')->logout();
              return redirect()->route('teacher.login')->with('error', 'Unauthorized user Access denied');
            }
            return redirect()->route('teacher.dashboard');
          } else {
            return redirect()->route('teacher.login')->with('error', 'Something went wrong');
          }
    }

    public function dashboard()
    {
        $data['announcement'] = Announcement::where('type', 'teacher')->latest()->get();
        return view('teacher.dashboard',$data);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('teacher.login')->with('success', 'Logout successfully');

    }

    public function changepassword()
    {
        return view('teacher.change_password');
    }
    public function updatepassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',
        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = User::find(Auth::user()->id);
        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
            $user->update();
            return redirect()->back()->with('success', 'Password Changed Successfully');
        } else {
            return redirect()->back()->with('error', 'Old Password does not match ');

        }
    }

}
