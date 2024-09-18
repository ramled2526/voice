@extends('layouts.header')

@section('title', 'Registered Students')

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
                Registered Students
            </div>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="bi bi-plus-circle"></i> Add Student
            </button>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Student ID</th>
                        <th>Course</th>
                        <th>Year and Section</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->student_lastname }}</td>
                            <td>{{ $student->student_firstname }}</td>
                            <td>{{ $student->student_middlename }}</td>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->year_section }}</td>
                            <td>{{ $student->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-warning btn-sm me-2" onclick="showEditStudentModal({{ $student }})">
                                        <i class="bi bi-pencil"></i> Edit Student
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteStudentModal" onclick="setDeleteStudent({{ $student->id }})">
                                        <i class="bi bi-trash"></i> Delete Student
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editStudentForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="student_lastname" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="student_firstname" name="firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="middlename" class="form-label">Middlename</label>
                            <input type="text" class="form-control" id="student_middlename" name="middlename" required>
                        </div>
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" class="form-control" id="course" name="course" required>
                        </div>
                        <div class="mb-3">
                            <label for="year_section" class="form-label">Year and Section</label>
                            <input type="text" class="form-control" id="year_section" name="year_section" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('student.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="student_lastname" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="student_firstname" name="firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="middlename" class="form-label">Middlename</label>
                            <input type="text" class="form-control" id="student_middlename" name="middlename" required>
                        </div>
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="course" class="form-label">Course</label>
                            <input type="text" class="form-control" id="course" name="course" required>
                        </div>
                        <div class="mb-3">
                            <label for="year_section" class="form-label">Year and Section</label>
                            <input type="text" class="form-control" id="year_section" name="year_section" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Student Modal -->
    <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteStudentModalLabel">Delete Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this student?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteStudentForm" method="POST" action="">
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
