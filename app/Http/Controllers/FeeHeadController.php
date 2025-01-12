<?php

namespace App\Http\Controllers;

use App\Models\FeeHead;
use Illuminate\Http\Request;

class FeeHeadController extends Controller
{
    public function index()
    {
        return view('admin.fee-head.fee-head');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = new FeeHead();
        $data->name = $request->name;
        $data->save();
        return redirect()->route('fee-head.create')->with('success', 'Fee Head Added Successfully');
    }

    public function read(FeeHead $FeeHead)
    {
        $data['fee'] = FeeHead::get();
        return view('admin.fee-head.fee-head_list', $data);
    }

    public function delete($id)
    {
        $data = FeeHead::findOrFail($id);
        $data->delete();
        return redirect()->route('fee-head.read')->with('success', 'Fee-Head Deleted Successfully');
    }

    public function edit($id)
    {
        $data['fee'] = FeeHead::findOrFail($id);
        return view('admin.fee-head.fee-head_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = FeeHead::findOrFail($request->id);
        $data->name = $request->name;
        $data->update();
        return redirect()->route('fee-head.read')->with('success', 'Fee-Head Updated Successfully');
    }
}
