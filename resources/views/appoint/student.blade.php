@extends('layouts.header')

@section('title', 'List of Appointments')

@section('content')
    @if(session('success'))
        <div class="alert alert-success custom-alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('delete_success'))
        <div id="delete-alert" class="alert alert-success custom-alert">
            {{ session('delete_success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Appointments List
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Course</th>
                        <th>Year and Section</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Appointment Date</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appoints as $appoint)
                        <tr>
                            <td>{{ $appoint->student_id }}</td>
                            <td>{{ $appoint->lastname }}</td>
                            <td>{{ $appoint->firstname }}</td>
                            <td>{{ $appoint->middlename }}</td>
                            <td>{{ $appoint->course }}</td>
                            <td>{{ $appoint->year_section }}</td>
                            <td>{{ $appoint->start_time }}</td>
                            <td>{{ $appoint->end_time }}</td>
                            <td>{{ $appoint->appointment_date }}</td>
                            <td>{{ $appoint->created_at }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <button type="button" class="btn btn-warning btn-sm mb-2" onclick="showEditAppointModal({{ $appoint }})" style="width: 100%;">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAppointModal" onclick="setDeleteAppoint({{ $appoint->id }})" style="width: 100%;">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Appointment Modal -->
    <div class="modal fade" id="editAppointModal" tabindex="-1" aria-labelledby="editAppointModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAppointModalLabel">Edit Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAppointForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="middlename" class="form-label">Middlename</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" required>
                        </div>
                        <div class="mb-3">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" class="form-control" id="course" name="course" required>
                        </div>
                        <div class="mb-3">
                            <label for="year_section" class="form-label">Year and Section</label>
                            <input type="text" class="form-control" id="year_section" name="year_section" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Start time</label>
                            <input type="text" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_time" class="form-label">End time</label>
                            <input type="text" class="form-control" id="end_time" name="end_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">Appointment Date</label>
                            <input type="text" class="form-control" id="appointment_date" name="appointment_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Delete Appoint Modal -->
     <div class="modal fade" id="deleteAppointModal" tabindex="-1" aria-labelledby="deleteAppointModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAppointModalLabel">Delete Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this appointment?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteAppointForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
