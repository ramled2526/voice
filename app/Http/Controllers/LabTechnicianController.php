<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabTechnicianController extends Controller
{
    public function showRegistration()
    {
        return view('lab technician');  
    } 

    public function registerLab(Request $request)
    {
        $validated = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'employee-id' => 'required|string|max:255',
            'voice-data' => 'required|file|mimes:wav',
        ]);
    
        // Store the voice recording file
        if ($request->hasFile('voice-data')) {
            $path = $request->file('voice-data')->store('voice-recordings');
            $validated['voice_data_path'] = $path;  
        }
        
        // Assuming you have a LabTechnician model
        // \App\Models\LabTechnician::create($validated);

        return redirect()->back()->with('success', 'Lab Technician registered successfully!');
    }
}

