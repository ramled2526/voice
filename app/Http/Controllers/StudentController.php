<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create()
    {
        return view('student');
    }

    public function store(Request $request)
    {
        $rules = [
            'lastname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
            'firstname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
            'middlename' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/'],
            'student_id' => 'required|string|max:255|unique:reg_students,student_id',
            'course' => 'required|string|max:255',
            'year_section' => ['required', 'regex:/^[1-4]-[A-Z]$/'],
        ];

        $messages = [
            'lastname.regex' => 'Lastname must start with a capital letter.',
            'firstname.regex' => 'Firstname must start with a capital letter.',
            'middlename.regex' => 'Middlename must be a full name or "None".',
            'year_section.regex' => 'Year and Section must have this format (e.g., 4-C).',
        ];

        $validated = $request->validate($rules, $messages);

        Student::create($validated);

        return redirect()->route('student')->with('success', 'Student registered successfully.');
    }
}
