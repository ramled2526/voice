<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function student()
    {
        return view ('student.student');
    }
    public function create()
    {
        return view('student.create');
    }
    public function save(Request $request)
    {
        $rules = [
            'lastname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
            'firstname' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$/'],
            'middlename' => ['required', 'regex:/^([A-Z][a-z]+)(\s[A-Z][a-z]+)*$|^None$/'],
            'student_id' => 'required|string|max:255|unique:students,student_id',
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

        return redirect()->route('student.student')->with('success', 'Student registered successfully.');
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
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'course' => 'required',
            'year_section' => 'required',
        ]);
    
        \Log::info('Validated Data: ', $validatedData);
    
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
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'student_id' => 'required|string|max:255|unique:students,student_id',
            'course' => 'required|string|max:255',
            'year_section' => 'required|string|max:255',
        ]);

        Student::create($validatedData);

        return redirect()->back()->with('success', 'Student added successfully.');
    }
   
}
