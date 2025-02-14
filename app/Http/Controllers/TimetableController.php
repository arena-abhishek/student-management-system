<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Day;
use App\Models\Subject;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{

    public function index()
    {
        $data['days'] = Day::all();
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.timetable.create', $data);
    }



    public function store(Request $req)
    {
       
        $class_id = $req->class_id;
        $subject_id = $req->subject_id;

        foreach ($req->timetable as $timetable) {
            $day_id = $timetable['day_id'];
            $start_time = $timetable['start_time'];
            $end_time = $timetable['end_time'];
            $room_no = $timetable['room_no'];

            if ($start_time) {
                Timetable::updateOrCreate(
                    [
                        'class_id' => $class_id,
                        'subject_id' => $subject_id,
                        'day_id' => $day_id,
                    ],
                    [
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'room_no' => $room_no,
                    ]
                );
            }
        }

        return redirect()->route('timetable.create')->with('success', 'Timetable added successfully');
    }




    public function update(Request $request, Timetable $timetable)
    {

    }


    public function delete(Timetable $timetable)
    {

    }
}
