<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;    

class InstructorController extends Controller
{
    public function create()
    {
        return view('instructor');
    }

    // public function store(Request $request)
    // {
    //     $rules = [
    //         'lastname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
    //         'firstname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
    //         'middlename' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/'],
    //         'instructor_id' => 'required|string|max:255|unique:reg_instructors,instructor_id',
    //         // Remove 'voice-data' validation rule
    //     ];

    //     $messages = [
    //         'lastname.regex' => 'Lastname must start with a capital letter.',
    //         'firstname.regex' => 'Firstname must start with a capital letter.',
    //         'middlename.regex' => 'Middlename must be a full name or "None".',
    //     ];

    //     $validated = $request->validate($rules, $messages);

    //     // Save the instructor data
    //     $instructor = new Instructor($validated);
    //     $instructor->save();

    //     return redirect()->route('instructor')->with('success', 'Instructor registered successfully.');
    // }

    

public function store(Request $request)
{
    $rules = [
        'lastname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
        'firstname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
        'middlename' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/'],
        'instructor_id' => 'required|string|max:255|unique:reg_instructors,instructor_id',
        // 'voice_recording_path' => 'required|string', // Changed to string to handle base64 data
    ];

    $messages = [
        'lastname.regex' => 'Lastname must start with a capital letter.',
        'firstname.regex' => 'Firstname must start with a capital letter.',
        'middlename.regex' => 'Middlename must be a full name or "None".',
        // 'voice_recording_path.required' => 'Voice recording is required.',
    ];

    $validated = $request->validate($rules, $messages);

    // Handle the voice recording file upload
    if ($request->filled('voice_recording_path')) {
        $base64Audio = $request->input('voice_recording_path');
        $audio = base64_decode($base64Audio);
        $path = 'voice_recordings/' . uniqid() . '.wav';
        Storage::disk('public')->put($path, $audio);
        $validated['voice_recording_path'] = $path;
    }

    // Save the instructor data
    $instructor = new Instructor($validated);
    $instructor->save();

    return redirect()->route('instructor')->with('success', 'Instructor registered successfully.');
}

}
