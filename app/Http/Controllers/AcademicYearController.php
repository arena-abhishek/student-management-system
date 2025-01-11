<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.academic_year');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = new AcademicYear();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('academic-year.create')->with('success', 'Academic Year Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function read(AcademicYear $academicYear)
    {
        $data['academic_year'] = AcademicYear::get();
        return view('admin.academic_year_list', $data);
    }

    public function delete($id)
    {
        $data = AcademicYear::findOrFail($id);
        $data->delete();
        return redirect()->route('academic-year.read')->with('success', 'Academic Year Deleted Successfully');
    }

    public function edit($id)
    {
        $data['academic_year'] = AcademicYear::findOrFail($id);
        return view('admin.academic_year_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = AcademicYear::findOrFail($request->id);
        $data->name = $request->name;
        $data->update();
        return redirect()->route('academic-year.read')->with('success', 'Academic Year Updated Successfully');
    }


}