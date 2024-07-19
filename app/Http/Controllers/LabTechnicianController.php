<?php

namespace App\Http\Controllers;

use App\Models\LabTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;    

class LabTechnicianController extends Controller
{
    public function technician()
    {
        return view('technician.form');
    }
    public function store(Request $request)
    {
        $rules = [
            'lastname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
            'firstname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
            'middlename' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/'],
            'technician_id' => 'required|string|max:255|unique:reg_instructors,instructor_id',
            'voice_recording' => 'required|string', // Changed to string to handle base64 data
        ];
    
        $messages = [
            'lastname.regex' => 'Lastname must start with a capital letter.',
            'firstname.regex' => 'Firstname must start with a capital letter.',
            'middlename.regex' => 'Middlename must be a full name or "None".',
            'voice_recording.required' => 'Voice recording is required.',
        ];
    
        $validated = $request->validate($rules, $messages);
    
        // Handle the voice recording file upload
        if ($request->filled('voice_recording')) {
            $base64Audio = $request->input('voice_recording');
            $audio = base64_decode($base64Audio);
    
            // Use the lastname for the filename
            $filename = preg_replace('/\s+/', '_', strtolower($validated['lastname'])) . '_' . uniqid() . '.wav';
            $path = 'voice_recordings/' . $filename;
            Storage::disk('public')->put($path, $audio);
            $validated['voice_recording'] = $path;
        }
    
        // Save the instructor data
        $labtechnician = new LabTech($validated);
        $labtechnician->save();
    
        return redirect()->route('technician.form')->with('success', 'Laboratory Technician registered successfully.');
    }
    public function index()
    {
        $technicians = LabTech::all();
        return view('technician.index', compact('technicians'));
    }
    public function edit(LabTech $technician)
    {
        return view('technician.edit', compact('technician'));
    }
    public function update(Request $request, LabTech $technician)
    {
        $validatedData = $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'technician_id' => 'required|unique:reg_technician,technician_id,' . $technician->id,
        ]);
    
        \Log::info('Validated Data: ', $validatedData);
    
        $technician->update($validatedData);
    
        return redirect()->route('technician.index')->with('success', 'Technician updated successfully.');
    }
    public function delete(LabTech $technician)
    {
        $technician->delete();

        return redirect()->route('technician.index')->with('success', 'Technician deleted successfully.');
    }

}

