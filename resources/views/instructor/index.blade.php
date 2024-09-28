@extends('layouts.header')

@section('title', 'Registered Instructors')

@section('content')
    <!-- Display Success Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('delete_success'))
        <div id="delete-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('delete_success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-table me-1"></i>
                Registered Instructors
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Instructor ID</th>
                        <th>Voice Recording</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instructors as $instructor)
                        <tr>
                            <td>{{ $instructor->instructor_lastname }}</td>
                            <td>{{ $instructor->instructor_firstname }}</td>
                            <td>{{ $instructor->instructor_middlename }}</td>
                            <td>{{ $instructor->instructor_id }}</td>
                            <td>
                                @if($instructor->voice_recording)
                                    <!-- Display filename as a clickable link -->
                                    <a href="{{ asset('storage/' . $instructor->voice_recording) }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ basename($instructor->voice_recording) }}
                                    </a>
                                    <!-- Audio element to play the recording -->
                                    <audio controls class="w-full mt-2">
                                        <source src="{{ asset('storage/' . $instructor->voice_recording) }}" type="audio/wav">
                                        Your browser does not support the audio element.
                                    </audio>
                                @else
                                    No recording available
                                @endif
                            </td>
                            <td>{{ $instructor->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-warning btn-sm me-2" onclick="showEditInstructorModal({{ json_encode($instructor) }})">
                                        <i class="bi bi-pencil"></i> Edit Instructor
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteInstructorModal" onclick="setDeleteInstructor({{ $instructor->id }})">
                                        <i class="bi bi-trash"></i> Delete Instructor
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Instructor Modal -->
    <div class="modal fade" id="editInstructorModal" tabindex="-1" aria-labelledby="editInstructorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInstructorModalLabel">Edit Instructor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editInstructorForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="instructor_lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="instructor_lastname" name="instructor_lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="instructor_firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="instructor_firstname" name="instructor_firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="instructor_middlename" class="form-label">Middlename</label>
                            <input type="text" class="form-control" id="instructor_middlename" name="instructor_middlename" required>
                        </div>
                        <div class="mb-3">
                            <label for="instructor_id" class="form-label">Instructor ID</label>
                            <input type="text" class="form-control" id="instructor_id" name="instructor_id" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Instructor Modal -->
    <div class="modal fade" id="deleteInstructorModal" tabindex="-1" aria-labelledby="deleteInstructorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteInstructorModalLabel">Delete Instructor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this instructor?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteInstructorForm" method="POST" action="">
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
