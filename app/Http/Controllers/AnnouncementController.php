<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
   
    public function index()
    {
        return view('admin.announcement.form');
    }


    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'type' => 'required'
        ]);
        $announcement = new Announcement();
        $announcement->message = $request->message;
        $announcement->type = $request->type;
        $announcement->save();
        return redirect()->route('announcement.create')->with('success', 'Announcement brodcast Successfully');
    }


    public function read()
    {
        $data['announcements'] = Announcement::latest()->get();
        return view('admin.announcement.list', $data);
    }


    public function edit($id)
    {
        $data['announcement'] = Announcement::findOrFail($id);
        return view('admin.announcement.form_edit', $data);

    }


    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->message = $request->message;
        $announcement->type = $request->type;
        $announcement->update();
        return redirect()->route('announcement.read')->with('success', 'Announcement brodcast updated Successfully');
    }

    public function delete($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        return redirect()->route('announcement.read')->with('success', 'Announcement brodcast deleted Successfully');
    }
}
