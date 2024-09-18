<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Availability;
use Illuminate\Support\Facades\Log;
use Exception;

class AppointmentController extends Controller
{
    public function show()
    {
        return view('appoint.booking');
    }
    public function store(Request $request)
    {
        \Log::info('Request data: ', $request->all());
    
        // Validate the request
        $validatedData = $request->validate([
            'student_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'nullable',
            'course' => 'required',
            'year_section' => 'required',
            'start_time' => 'required|regex:/^\d{2}:\d{2}$/', // Expecting 'HH:MM' format
            'end_time' => 'required|regex:/^\d{2}:\d{2}$/',   // Expecting 'HH:MM' format
            'appointment_date' => 'required|date',
        ]);
    
        \Log::info('Validated data: ', $validatedData);
    
        // Convert the time to 12-hour format with AM/PM
        $formattedStartTime = $this->formatTime($validatedData['start_time']);
        $formattedEndTime = $this->formatTime($validatedData['end_time']);
    
        try {
            $appointment = new Appointment();
            $appointment->student_id = $validatedData['student_id'];
            $appointment->firstname = $validatedData['firstname'];
            $appointment->lastname = $validatedData['lastname'];
            $appointment->middlename = $validatedData['middlename'];
            $appointment->course = $validatedData['course'];
            $appointment->year_section = $validatedData['year_section'];
            $appointment->start_time = $formattedStartTime;
            $appointment->end_time = $formattedEndTime;
            $appointment->appointment_date = $validatedData['appointment_date'];
    
            \Log::info('Before saving appointment: ', $appointment->toArray());
    
            $appointment->save();
        } catch (Exception $e) {
            \Log::error('Error saving appointment: ', ['exception' => $e]);
            return response()->json(['error' => 'Failed to book appointment.'], 500);
        }
    
        \Log::info('Appointment saved: ', $appointment->toArray());
    
        return response()->json(['success' => true, 'message' => 'Appointment booked successfully!'], 200);
    }
    
    /**
     * Format time from 'HH:MM' to 12-hour format with AM/PM.
     *
     * @param string $time
     * @return string
     */
    private function formatTime($time)
    {
        list($hour, $minute) = explode(':', $time);
        $hour = (int) $hour;
        $period = $hour >= 12 ? 'PM' : 'AM';
        $formattedHour = $hour % 12;
        $formattedHour = $formattedHour ? $formattedHour : 12; // Handle 0 case as 12
    
        return sprintf('%02d:%02d %s', $formattedHour, $minute, $period);
    }
public function getAvailability($year, $month)
{
    try {
        $availability = Availability::whereYear('availability_date', $year)
            ->whereMonth('availability_date', $month)
            ->get();
        
        return response()->json($availability);
    } catch (Exception $e) {
        return response()->json(['error' => 'Unable to fetch availability data.'], 500);
    }
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
