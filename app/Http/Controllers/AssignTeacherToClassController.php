<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\AssignTeacherToClass;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Assign;

class AssignTeacherToClassController extends Controller
{

    public function index()
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = User::where('role', 'teacher')->latest()->get();
        return view('admin.assign-teacher.form', $data);
    }


    public function findSubject(Request $request)
    {
        $class_id = $request->class_id;
        $subjects = AssignSubjectToClass::with('subject')->where('class_id', $class_id)->get();
        return response()->json(
            [
                'status' => true,
                'subjects' => $subjects
            ]
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required'
        ]);

        AssignTeacherToClass::updateOrCreate(
            ['class_id' => $request->class_id, 'subject_id' => $request->subject_id],
            [
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id
            ]

        );
        return redirect()->route('assign-teacher.create')->with('success', 'Assign Teacher added Successfully');
    }


    public function read(Request $request)
    {
        $data['classes'] = Classes::all();
        $query = AssignTeacherToClass::with(['class', 'subject', 'teacher']);
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }
        $data['assignTeachers'] = $query->latest()->get();
        return view('admin.assign-teacher.list', $data);
    }


    public function edit($id)
    {
        $res = AssignTeacherToClass::findOrFail($id);
        $data['assignTeacher'] = $res;
        $data['classes'] = Classes::all();
        $data['subjects'] = AssignSubjectToClass::with('subject')->where('class_id', $res->class_id)->get();
        $data['teachers'] = User::where('role', 'teacher')->latest()->get();
        return view('admin.assign-teacher.form_edit', $data);

    }


    public function update(Request $request, $id)
    {
        $res = AssignTeacherToClass::findOrFail($id);
        $res->class_id = $request->class_id;
        $res->subject_id = $request->subject_id;
        $res->teacher_id = $request->teacher_id;
        $res->update();
        return redirect()->route('assign-teacher.read')->with('success', ' assign teacher  updated Successfully');
    }

    public function delete($id)
    {
        $subject = AssignTeacherToClass::findOrFail($id);
        $subject->delete();
        return redirect()->route('assign-teacher.read')->with('success', ' assign teacher  deleted Successfully');
    }
}
