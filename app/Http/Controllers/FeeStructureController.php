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
        return view('admin.fee-structure.fee-structure', $data);
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

    public function read(Request $request)
    {
        $feeStructure = FeeStructure::query()->with('FeeHead', 'AcademicYear', 'classes')->latest();
        if ($request->filled('class_id')) {
            $feeStructure->where('class_id', $request->get('class_id'));
        }
        if ($request->filled('academic_year_id')) {
            $feeStructure->where('academic_year_id', $request->get('academic_year_id'));
        }
        $data['feeStructure'] = $feeStructure->get();
        $data['classes'] = classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['fee_heads'] = FeeHead::all();
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
        $data['fee'] = FeeStructure::findOrFail($id);
        $data['classes'] = classes::all();
        $data['academic_years'] = AcademicYear::all();
        $data['fee_heads'] = FeeHead::all();
        return view('admin.fee-structure.fee-structure_edit', $data);
    }

    public function update(Request $request)
    {
        $fee = FeeStructure::findOrFail($request->id);
        $fee->class_id = $request->class_id;
        $fee->academic_year_id = $request->academic_year_id;
        $fee->fee_head_id = $request->fee_head_id;
        $fee->april = $request->april;
        $fee->may = $request->may;
        $fee->june = $request->june;
        $fee->july = $request->july;
        $fee->august = $request->august;
        $fee->september = $request->september;
        $fee->october = $request->october;
        $fee->november = $request->november;
        $fee->december = $request->december;
        $fee->january = $request->january;
        $fee->february = $request->february;
        $fee->march = $request->march;
        $fee->update();
        return redirect()->route('fee-structure.read')->with('success', 'Fee Structure Updated Successfully');
    }
}
