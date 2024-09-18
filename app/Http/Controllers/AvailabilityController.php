<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use Illuminate\Support\Facades\Log;

class AvailabilityController extends Controller
{
    public function show()
    {
        return view('availability.set');
    }
    public function saveAvailability(Request $request)
    {
        \Log::info('Availability data received:', $request->all());
    
        $validatedData = $request->validate([
            'availability_date' => 'required|date',
            'available_time' => 'required|string',
            'start_time' => 'required_if:available_time,!=,whole_day|date_format:H:i|nullable',
            'end_time' => 'required_if:available_time,!=,whole_day|date_format:H:i|after:start_time|nullable',
            'status' => 'required|string|in:available,unavailable', 
        ]);
    
        try {
            $startTime = \DateTime::createFromFormat('H:i', $validatedData['start_time']);
            $endTime = \DateTime::createFromFormat('H:i', $validatedData['end_time']);
            
            if ($startTime && $endTime && $startTime < $endTime) {
                $formattedStartTime = $startTime->format('g:i a'); 
                $formattedEndTime = $endTime->format('g:i a-'); 
                
                // Save the availability as a single entry
                $availability = new Availability();
                $availability->availability_date = $validatedData['availability_date'];
                $availability->available_time = $validatedData['available_time']; // Keep available_time as it is
                $availability->start_time = $formattedStartTime; // Save formatted start time
                $availability->end_time = $formattedEndTime; // Save formatted end time
                $availability->status = $validatedData['status']; 
                $availability->save();
            }
    
            return response()->json(['success' => true, 'message' => 'Availability saved successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save availability.'], 500);
        }
    }
    private function formatTime($time)
    {
        if ($time) {
            $dt = \DateTime::createFromFormat('H:i', $time);
            return $dt->format('g:i a');
        }
        return null;
    }    
    public function getAvailabilityForDate($date)
{
    try {
        \Log::info('Fetching availability for date:', ['date' => $date]);

        $availability = Availability::where('availability_date', $date)->first();

        if ($availability) {
            return response()->json([
                'success' => true,
                'availability' => $availability
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No availability data found for this date.'
            ], 200); 
        }
    } catch (\Exception $e) {
        \Log::error('Error fetching availability data:', ['error' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Error fetching availability data.'
        ], 500);
    }
}
    public function index()
    {
        $avails = Availability::all();
        return view('availability.view', compact('avails'));
    }
    public function edit(Availability $availability)
    {
        return view('availability.edit', compact('availability'));
    }
   public function update(Request $request, $id)
    {
        /*$request->validate([
            'availability_date' => 'required|date',
            'available_time' => 'required|date_format:H:i',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'status' => 'required|string|max:255',
        ]);*/        

        $availability = Availability::findOrFail($id);
        $availability->update($request->all());

        return redirect()->route('availability.view')->with('success', 'Availability updated successfully.');
    }
    public function delete($id)
    {
        $availability = Availability::find($id);
        if ($availability) {
            $availability->delete();
            return redirect()->route('availability.view')->with('delete_success', 'Availability deleted successfully.');
        } else {
            return redirect()->route('availability.view')->with('error', 'Availability not found.');
        }
    }
    

}













