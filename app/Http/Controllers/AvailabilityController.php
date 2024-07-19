<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;

class AvailabilityController extends Controller
{

    public function show()
    {
        return view('appoint.set');
    }
    public function set(Request $request)
    
    {
        $data = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|boolean',
        ]);
        
        $availability = Availability::updateOrCreate(
            [
                'date' => $data['date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
            ],
            [
                'status' => $data['status'],
            ]
        );

        dd($request->all()); 

        if ($availability) {
            return response()->json(['success' => true, 'message' => 'Availability updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update availability']);
        }
    }
}
