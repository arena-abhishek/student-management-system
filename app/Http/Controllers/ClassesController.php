<?php

namespace App\Http\Controllers;

use App\Models\classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
      return view('admin.class.class');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = new classes();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('class.create')->with('success', 'Class Added Successfully');
    }

    public function read(classes $classes)
    {
        $data['class'] = classes::get();
        return view('admin.class.class_list', $data);
    }

    public function delete($id)
    {
        $data = classes::findOrFail($id);
        $data->delete();
        return redirect()->route('class.read')->with('success', 'Class Deleted Successfully');
    }

    public function edit($id)
    {
        $data['class'] = classes::findOrFail($id);
        return view('admin.class.class_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = classes::findOrFail($request->id);
        $data->name = $request->name;
        $data->update();
        return redirect()->route('class.read')->with('success', 'Class Updated Successfully');
    }

}
