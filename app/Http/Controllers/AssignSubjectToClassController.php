<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectToClassController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.assign-subject.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required'
        ]);

        $class_id = $request->class_id;
        $subject_id = $request->subject_id; // Ensure this is an array

        foreach ($subject_id as $subject_id) {
            AssignSubjectToClass::updateOrCreate(
                ['class_id' => $class_id, 'subject_id' => $subject_id],
                ['class_id' => $class_id, 'subject_id' => $subject_id]
            );
        }

        return redirect()->route('assign-subject.create')->with('success', 'Assign Subject added Successfully');
    }



    public function read()
    {
        $data['assignSubjects'] = AssignSubjectToClass::all( );
        return view('admin.assign-subject.list', $data);
    }


    public function edit($id)
    {
        $data['assignSubject'] = AssignSubjectToClass::findOrFail($id);
        return view('admin.assign-subject.form_edit', $data);

    }


    public function update(Request $request, $id)
    {
        $subject = AssignSubjectToClass::findOrFail($id);
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->update();
        return redirect()->route('assign-subject.read')->with('success', ' assign subject  updated Successfully');
    }

    public function delete($id)
    {
        $subject = AssignSubjectToClass::findOrFail($id);
        $subject->delete();
        return redirect()->route('assign-subject.read')->with('success', ' assign subject  deleted Successfully');
    }
}

