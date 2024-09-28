<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function student()
    {
        return view('student.student');
    }

    public function create()
    {
        return view('student.create');
    }

    public function save(Request $request)
    {

        try {
            $rules = [
                'student_lastname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
                'student_firstname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
                'student_middlename' => ['nullable', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/'], // Make this field nullable
                'student_id' => 'required|string|max:255|unique:students,student_id',
                'course' => 'required|string|max:255',
                'year_section' => ['required', 'regex:/^[1-4]-[A-Z]$/'],
            ];

            $messages = [
                'student_lastname.regex' => 'Lastname must start with a capital letter.',
                'student_firstname.regex' => 'Firstname must start with a capital letter.',
                'student_middlename.regex' => 'Middlename must be a full name or "None".',
                'year_section.regex' => 'Year and Section must have this format (e.g., 4-C).',
            ];

            // Validate input
            $validated = $request->validate($rules, $messages);

            // Save the validated data into the database
            Student::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Student registered successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Student registration error: ' . $e->getMessage()); // Log the error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }

    }
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'student_lastname' => 'required',
            'student_firstname' => 'required',
            'student_middlename' => 'required',
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'course' => 'required',
            'year_section' => 'required',
        ]);

        Log::info('Validated Data: ', $validatedData);

        $student->update($validatedData);

        return redirect()->route('student.index')->with('success', 'Student updated successfully.');
    }

    public function delete(Student $student)
    {
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_lastname' => 'required|string|max:255',
            'student_firstname' => 'required|string|max:255',
            'student_middlename' => 'required|string|max:255',
            'student_id' => 'required|string|max:255|unique:students,student_id',
            'course' => 'required|string|max:255',
            'year_section' => 'required|string|max:255',
        ]);

        Student::create($validatedData);

        return redirect()->back()->with('success', 'Student added successfully.');
    }
}






