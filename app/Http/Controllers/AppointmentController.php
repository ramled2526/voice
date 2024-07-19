<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function save(Request $request)
    {
        \Log::info('Request data: ', $request->all());
    
        // Validate the request
        $validated = $request->validate([
            'student_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'nullable',
            'course' => 'required',
            'year_section' => 'required',
            'start_time' => 'required|integer|between:0,23',
            'end_time' => 'required|integer|between:0,23',
            'appointment_date' => 'required|date',
        ]);
    
        \Log::info('Validated data: ', $validated);
    
        // Save the appointment
        $appointment = new Appointment();
        $appointment->student_id = $validated['student_id'];
        $appointment->firstname = $validated['firstname'];
        $appointment->lastname = $validated['lastname'];
        $appointment->middlename = $validated['middlename'];
        $appointment->course = $validated['course'];
        $appointment->year_section = $validated['year_section'];
        $appointment->start_time = $validated['start_time'];
        $appointment->end_time = $validated['end_time'];
        $appointment->appointment_date = $validated['appointment_date'];
    
        \Log::info('Before saving appointment: ', $appointment->toArray());
    
        try {
            $appointment->save();
        } catch (\Exception $e) {
            Log::error('Error saving appointment: ', ['exception' => $e]);
            return response()->json(['error' => 'Failed to book appointment.'], 500);
        }
    
        Log::info('Appointment saved: ', $appointment->toArray());
    
        // Return JSON response instead of redirecting
        return response()->json(['message' => 'Appointment booked successfully!'], 200);
    }    
    public function index()
    {
        $appoints = Appointment::all();
        return view('appoint.student', compact('appoints'));
    }
    public function edit(Appointment $appoint)
    {
        return view('appoint.edit', compact('appoint'));
    }
   public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'year_section' => 'required|string|max:255',
            'start_time' => 'required|string|max:255',
            'end_time' => 'required|string|max:255',
            'appointment_date' => 'required|date',
        ]);

        $appoint = Appointment::findOrFail($id);
        $appoint->update($request->all());

        return redirect()->route('appoint.student')->with('success', 'Appointment updated successfully.');
    }

    public function delete(Appointment $appoint)
    {
        $appoint->delete();

        return redirect()->route('appoint.student')->with('success', 'Appointment deleted successfully.');
    }

}
