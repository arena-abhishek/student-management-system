<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\classes;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index()
    {
        $data['classes'] = classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['fee_heads'] = FeeHead::all();
        return view('admin.fee-structure.fee-structure',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'fee_head_id' => 'required',
        ]);
        FeeStructure::create($request->all());
        return redirect()->route('fee-structure.create')->with('success', 'Fee Structure Added Successfully');
    }

    public function read(FeeStructure $FeeStructure)
    {
        $data = FeeStructure::with('FeeHead','AcademicYear','classes')->latest()->get();
        return view('admin.fee-structure.fee-structure_list', $data);
    }

    public function delete($id)
    {
        $data = FeeStructure::findOrFail($id);
        $data->delete();
        return redirect()->route('fee-structure.read')->with('success', 'Fee Structure Deleted Successfully');
    }

    public function edit($id)
    {
        $data['feeStructure'] = FeeStructure::findOrFail($id);
        return view('admin.fee-structure.fee-structure_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = FeeStructure::findOrFail($request->id);
        $data->name = $request->name;
        $data->update();
        return redirect()->route('fee-structure.read')->with('success', 'Fee Structure Updated Successfully');
    }
}
