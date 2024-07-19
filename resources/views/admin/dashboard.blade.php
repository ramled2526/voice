@extends('layouts.header')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
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
            <div class="card bg-warning text-white mb-4">
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
            <div class="card bg-success text-white mb-4">
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
    </div>

    <div class="row mt-4">
        <div class="col-xl-6 col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Students by Course, Year, and Section
                </div>
                <div class="card-body">
                    <canvas id="studentsByCourseYearSectionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var studentsByCourseYearSectionLabels = {!! json_encode($studentsByCourseYearSection->keys()) !!};
    var studentsByCourseYearSectionData = {!! json_encode($studentsByCourseYearSection->values()) !!};
</script>
@endsection
