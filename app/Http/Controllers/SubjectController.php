<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
      return view('admin.subject.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->save();
        return redirect()->route('subject.create')->with('success', 'Subject added Successfully');
    }


    public function read()
    {
        $data['subjects'] = Subject::latest()->get();
        return view('admin.subject.list', $data);
    }


    public function edit($id)
    {
        $data['subject'] = Subject::findOrFail($id);
        return view('admin.subject.form_edit', $data);

    }


    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->update();
        return redirect()->route('subject.read')->with('success', 'subject brodcast updated Successfully');
    }

    public function delete($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('subject.read')->with('success', 'subject brodcast deleted Successfully');
    }
}
