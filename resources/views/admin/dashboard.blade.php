@extends('layouts.header')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mt-10">Admin Dashboard</h2>
    <div class="row">
        <div class="col-xl-3 col-md-10">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    <i class="fas fa-user-graduate"></i> Registered Students
                    <div class="mt-2">
                        <h3>{{ $studentCount }}</h3>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div></div>
                    <a class="small text-white stretched-link" href="{{ route('student.index') }}"><i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    <i class="fas fa-chalkboard-teacher"></i> Registered Instructors
                    <div class="mt-2">
                        <h3>{{ $instructorCount }}</h3>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div></div>
                    <a class="small text-white stretched-link" href="{{ route('instructor.index') }}"><i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    <i class="fas fa-flask"></i> Registered Lab Technicians
                    <div class="mt-2">
                        <h3>{{ $technicianCount }}</h3>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div></div>
                    <a class="small text-white stretched-link" href="{{ route('technician.index') }}"><i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    <i class="fas fa-calendar"></i> Number of Appointment
                    <div class="mt-2">
                        <h3>{{ $appointCount }}</h3>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
              <div></div>
            <a class="small text-white stretched-link" href="{{ route('appoint.student') }}"><i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>
</div>

<div class="row mt-4">
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-pie me-1"></i>
                Registered Students by Course, Year, and Section
            </div>
            <div class="card-body">
                <canvas id="studentsByCourseYearSectionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- New pie chart for Appointments by Course, Year, and Section -->
    <div class="col-xl-6 col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-pie me-1"></i>
                Appointments by Course, Year, and Section
            </div>
            <div class="card-body">
                <canvas id="appointmentsByCourseYearSectionChart"></canvas>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@section('scripts')
<script>
   var studentsByCourseYearSectionLabels = @json($studentsByCourseYearSection->keys());
    var studentsByCourseYearSectionData = @json($studentsByCourseYearSection->values());
    var appointmentsByCourseYearSectionLabels = @json($appointmentsByCourseYearSection->keys());
    var appointmentsByCourseYearSectionData = @json($appointmentsByCourseYearSection->values());
</script>
<script src="{{ asset('js/admin/dashboard-graph/graph.js') }}"></script>
@endsection