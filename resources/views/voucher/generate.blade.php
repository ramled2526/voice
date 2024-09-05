@extends('layouts.header')

@section('content')
<div class="container mx-auto p-4 flex justify-center">
    <div class="w-full max-w-md bg-white p-6 rounded-md shadow-lg border border-gray-300">
        <h2 class="text-xl font-bold mb-4 text-center">Generate Voucher</h2>

        <!-- Voucher Generation Form -->
        <div class="mb-4">
            <label for="studentName" class="block text-sm font-medium text-gray-700">Student Name</label>
            <input type="text" id="studentName" class="mt-2 p-3 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-700" placeholder="Enter your name">

            <label for="voucherCodeInput" class="block text-sm font-medium text-gray-700 mt-4">Voucher Code</label>
            <div class="mt-1 flex">
                <input type="text" id="voucherCodeInput" class="p-3 w-full border-2 border-gray-300 rounded-l-md shadow-sm bg-gray-100 cursor-not-allowed focus:outline-none focus:border-blue-700" placeholder="Enter the code" readonly>
                <button id="generateCodeBtn" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600">Generate</button>
            </div>
        </div>

        <button id="printVoucherBtn" class="bg-blue-500 text-white px-4 py-2 rounded w-full mt-4 flex items-center justify-center hover:bg-blue-600">
            <i class="fas fa-print mr-2"></i> Print Voucher
        </button>
    </div>
</div>

<script>
document.getElementById('generateCodeBtn').addEventListener('click', function() {
    // Generate a random 8-character voucher code
    const voucherCode = Math.random().toString(36).substring(2, 10).toUpperCase();
    document.getElementById('voucherCodeInput').value = voucherCode;
});

document.getElementById('printVoucherBtn').addEventListener('click', function() {
    const studentName = document.getElementById('studentName').value;
    const voucherCode = document.getElementById('voucherCodeInput').value;

    if (!studentName || !voucherCode) {
        alert('Please enter all required fields.');
        return;
    }

    // Send the data to the server using AJAX
    fetch('/voucher', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            studentName: studentName,
            voucherCode: voucherCode
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Voucher saved successfully!');
            // Optionally, you can redirect the user or clear the form
        } else {
            alert('Failed to save voucher.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred.');
    });
});
</script>
@endsection
