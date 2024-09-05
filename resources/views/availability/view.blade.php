@extends('layouts.header')

@section('title', 'List of Availability')

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
                Availability List
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Availability Date</th>
                        <th>Available Time</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($avails as $availability)
                        <tr>
                            <td>{{ $availability->availability_date }}</td>
                            <td>{{ $availability->available_time }}</td>
                            <td>{{ $availability->start_time }}</td>
                            <td>{{ $availability->end_time }}</td>
                            <td>{{ $availability->status }}</td>
                            <td>{{ $availability->created_at }}</td>
                            <td>
                            <div class="d-flex">
                            <button type="button" class="btn btn-warning btn-sm me-2" onclick="showEditAvailModal({{ json_encode($availability) }})">
                                <i class="bi bi-pencil"></i> Edit Availability
                            </button>
                            
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAvailModal" onclick="setDeleteAvail({{ $availability->id }})">
                                    <i class="bi bi-trash"></i> Delete Availability
                                </button>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Availability Modal -->
    <div class="modal fade" id="editAvailModal" tabindex="-1" aria-labelledby="editAvailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAvailModalLabel">Edit Availability</h5>
                    <button type="button" id="close-modal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAvailForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="availability_date" class="form-label">Availability Date</label>
                            <input type="text" class="form-control" id="availability_date" name="availability_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="available_time" class="form-label">Available Time</label>
                            <input type="text" class="form-control" id="available_time" name="available_time" required>
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
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Delete Appoint Modal -->
     <div class="modal fade" id="deleteAvailModal" tabindex="-1" aria-labelledby="deleteAvailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAvailModalLabel">Delete Availability</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this availability?</p>
                </div>
                <div class="modal-footer">
                <form id="deleteAvailForm" method="POST" action="">
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
