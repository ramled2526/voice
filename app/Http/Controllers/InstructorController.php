<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    public function instructor()
    {
        return view('instructor.form');
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'instructor_lastname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
                'instructor_firstname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
                'instructor_middlename' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/'],
                'instructor_id' => 'required|string|max:255|unique:reg_instructors,instructor_id',
                'voice_recording' => 'required|string', // base64 data
            ];

            $messages = [
                'instructor_lastname.regex' => 'Lastname must start with a capital letter.',
                'instructor_firstname.regex' => 'Firstname must start with a capital letter.',
                'instructor_middlename.regex' => 'Middlename must be a full name or "None".',
                'voice_recording.required' => 'Voice recording is required.',
            ];

            $validated = $request->validate($rules, $messages);
        
            if ($request->filled('voice_recording')) {
                $base64Audio = $request->input('voice_recording');
                $audio = base64_decode($base64Audio);

                $filename = preg_replace('/\s+/', '_', strtolower($validated['instructor_lastname'])) . '_' . uniqid() . '.wav';
                $path = 'voice_recordings/' . $filename;

                Storage::disk('public')->put($path, $audio);
                $validated['voice_recording'] = $path;
            }

            $instructor = new Instructor($validated);
            $instructor->save();

            return response()->json([
                'success' => true,
                'message' => 'Instructor registered successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage()); // Log the error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        $instructors = Instructor::all();
        return view('instructor.index', compact('instructors'));
    }

    public function edit(Instructor $instructor)
    {
        return view('instructor.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $validatedData = $request->validate([
            'instructor_lastname' => 'required',
            'instructor_firstname' => 'required',
            'instructor_middlename' => 'required',
            'instructor_id' => 'required|unique:reg_instructors,instructor_id,' . $instructor->id,
        ]);

        \Log::info('Validated Data: ', $validatedData);

        $instructor->update($validatedData);

        return redirect()->route('instructor.index')->with('success', 'Instructor updated successfully.');
    }

    public function delete(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('instructor.index')->with('success', 'Instructor deleted successfully.');
    }
}
