@extends('layouts.header')

@section('title', 'List of Generated Codes')

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
                Generated Code List
            </div>
        <div class="d-flex align-items-center">
            <button id="selectAllBtn" class="bg-gray-500 text-white hover:bg-gray-600 me-3 px-2 py-1 text-sm rounded">
                <i class="fas fa-check-square me-1"></i> Select All
            </button>
            <button id="printSelectedBtn" class="btn btn-primary px-2 py-1 text-sm">
                <i class="fas fa-print me-1"></i> Print Selected
            </button>
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Student Name</th>
                        <th>Voucher Code</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($generate as $generated)
                        <tr>
                            <td><input type="checkbox" class="selectVoucher" value="{{ $generated->id }}" data-student="{{ $generated->student_name }}" data-code="{{ $generated->voucher_code }}"></td>
                            <td>{{ $generated->student_name }}</td>
                            <td>{{ $generated->voucher_code }}</td>
                            <td>{{ $generated->created_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteVoucherModal" onclick="setDeleteVoucher({{ $generated->id }})">
                                        <i class="bi bi-trash"></i> Delete Generated Code
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Generated Code Modal -->
    <div class="modal fade" id="deleteVoucherModal" tabindex="-1" aria-labelledby="deleteVoucherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVoucherModalLabel">Delete Generated Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this generated code?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteVoucherForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- No Voucher Selected Modal -->
    <div class="modal fade" id="noVoucherSelectedModal" tabindex="-1" aria-labelledby="noVoucherSelectedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noVoucherSelectedModalLabel">No Voucher Selected</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please select at least one voucher to print.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('selectAllBtn').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.selectVoucher');
        const allSelected = Array.from(checkboxes).every(checkbox => checkbox.checked);

        checkboxes.forEach(checkbox => {
            checkbox.checked = !allSelected;
        });
    });

    document.getElementById('printSelectedBtn').addEventListener('click', function() {
        const selectedVouchers = Array.from(document.querySelectorAll('.selectVoucher:checked'));
        
        if (selectedVouchers.length === 0) {
            new bootstrap.Modal(document.getElementById('noVoucherSelectedModal')).show();
            return;
        }

        // Create a new window for printing
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Vouchers</title>');
        printWindow.document.write('<style>');
        printWindow.document.write(`
            .voucher-card {
                border: 1px dashed black;
                width: 200px;
                height: 120px;
                padding: 10px;
                margin: 10px;
                display: inline-block;
                text-align: center;
                font-size: 12px;
                position: relative;
                page-break-inside: avoid;
            }
            .voucher-card p {
                margin: 4px 0;
            }
            .voucher-card h4 {
                margin-top: 5px;
                font-size: 14px;
                text-transform: uppercase;
            }
        `);
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h2 style="text-align: center;">Print Vouchers</h2>');

        // Calculate the expiry time (4 hours from now)
        const expiryTime = new Date();
        expiryTime.setHours(expiryTime.getHours() + 4);
        const formattedExpiryTime = expiryTime.toLocaleString();

        printWindow.document.write('<div style="display: flex; flex-wrap: wrap; justify-content: center;">');

        selectedVouchers.forEach(voucher => {
            printWindow.document.write('<div class="voucher-card">');
            printWindow.document.write('<h4>Voucher</h4>');
            printWindow.document.write('<p>Student Name: ' + voucher.getAttribute('data-student') + '</p>');
            printWindow.document.write('<p>Voucher Code: ' + voucher.getAttribute('data-code') + '</p>');
            printWindow.document.write('<p>Expiry Time: Valid for 4 hours</p>');
            printWindow.document.write('</div>');
        });

        printWindow.document.write('</div>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });
    </script>
@endsection
