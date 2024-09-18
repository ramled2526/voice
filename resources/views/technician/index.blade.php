@extends('layouts.header')

@section('title', 'Registered Instructors')

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
                Registered Lab Technician
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Lab Technician ID</th>
                        <th>Voice Recording</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($technicians as $technician)
                        <tr>
                            <td>{{ $technician->technician_lastname }}</td>
                            <td>{{ $technician->technician_firstname }}</td>
                            <td>{{ $technician->technician_middlename }}</td>
                            <td>{{ $technician->technician_id }}</td>
                            <td>{{ $technician->voice_recording }}</td>
                            <td>{{ $technician->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-warning btn-sm me-2" onclick="showEditTechnicianModal({{ $technician }})">
                                        <i class="bi bi-pencil"></i> Edit Technician
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTechnicianModal" onclick="setDeleteTechnician({{ $technician->id }})">
                                        <i class="bi bi-trash"></i> Delete Technician
                                    </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Instructor Modal -->
    <div class="modal fade" id="editTechnicianModal" tabindex="-1" aria-labelledby="editTechnicianModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTechnicianModalLabel">Edit Technician</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTechnicianForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="technician_lastname" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="technician_firstname" name="firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="middlename" class="form-label">Middlename</label>
                            <input type="text" class="form-control" id="technician_middlename" name="middlename" required>
                        </div>
                        <div class="mb-3">
                            <label for="technician_id" class="form-label">Technician ID</label>
                            <input type="text" class="form-control" id="technician_id" name="technician_id" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Technician Modal -->
    <div class="modal fade" id="deleteTechnicianModal" tabindex="-1" aria-labelledby="deleteTechnicianModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTechnicianModalLabel">Delete Technician</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this technician?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteTechnicianForm" method="POST" action="">
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
