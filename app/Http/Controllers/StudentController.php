<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\classes;
use App\Models\FeeHead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {
        $data['classes'] = classes::all();
        $data['academic_years'] = AcademicYear::all();
        return view('admin.student.student', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'admission_date' => 'required',
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
        $user->role = 'student';
        $user->save();
        return redirect()->route('student.create')->with('success', 'Student Added succesfully');
    }

    public function read(Request $request)
    {
        $query = User::with('studentClass', 'studentAcademicYear' )->where('role', 'student')->latest('id')->get();
        $data['students'] = $query;
        $data['AcademicYears'] = AcademicYear::all();
        $data['Classes'] = classes::all();
        return view('admin.student.student_list',$data);
    }

    // public function delete($id)
    // {
    //     $data = FeeStructure::findOrFail($id);
    //     $data->delete();
    //     return redirect()->route('fee-structure.read')->with('success', 'Fee Structure Deleted Successfully');
    // }

    // public function edit($id)
    // {
    //     $data['fee'] = FeeStructure::findOrFail($id);
    //     $data['classes'] = classes::all();
    //     $data['academic_years'] = AcademicYear::all();
    //     $data['fee_heads'] = FeeHead::all();
    //     return view('admin.fee-structure.fee-structure_edit', $data);
    // }

    // public function update(Request $request)
    // {
    //     $fee = FeeStructure::findOrFail($request->id);
    //     $fee->class_id = $request->class_id;
    //     $fee->academic_year_id = $request->academic_year_id;
    //     $fee->fee_head_id = $request->fee_head_id;
    //     $fee->april = $request->april;
    //     $fee->may = $request->may;
    //     $fee->june = $request->june;
    //     $fee->july = $request->july;
    //     $fee->august = $request->august;
    //     $fee->september = $request->september;
    //     $fee->october = $request->october;
    //     $fee->november = $request->november;
    //     $fee->december = $request->december;
    //     $fee->january = $request->january;
    //     $fee->february = $request->february;
    //     $fee->march = $request->march;
    //     $fee->update();
    //     return redirect()->route('fee-structure.read')->with('success', 'Fee Structure Updated Successfully');
    // }
}


