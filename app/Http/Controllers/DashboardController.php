<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\LabTech;

class DashboardController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $instructorCount = Instructor::count();
        $technicianCount = LabTech::count();

        // Fetch students by course, year, and section
        $studentsByCourseYearSection = Student::select('course', 'year_section', \DB::raw('count(*) as total'))
            ->groupBy('course', 'year_section')
            ->get()
            ->mapToGroups(function ($item, $key) {
                return [$item['course'] . ' ' . $item['year_section'] . ' ' => $item['total']];
            });

        return view('admin.dashboard', compact('studentCount', 'instructorCount', 'technicianCount', 'studentsByCourseYearSection'));
    }
}
