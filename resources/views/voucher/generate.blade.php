@extends('layouts.header')

@section('content')
<div class="container mx-auto p-4 flex justify-center mt-24">
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

        <!-- Save Voucher Button -->
        <button id="saveVoucherBtn" class="bg-blue-500 text-white px-4 py-2 rounded w-full mt-4 flex items-center justify-center hover:bg-blue-600">
            <i class="fas fa-save mr-2"></i> Save Voucher
        </button>

        <!-- Print Notification -->
        <div id="printNotification" class="mt-4 p-3 bg-green-100 text-green-700 rounded-md hidden">
            Voucher saved successfully! <button id="printBtn" class="underline text-blue-600 hover:text-blue-800">Print the voucher?</button>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-md shadow-lg w-full max-w-sm">
        <h3 class="text-xl font-semibold mb-4">Confirmation</h3>
        <p>Are you sure you want to save this voucher?</p>
        <div class="mt-6 flex justify-end space-x-4">
            <button id="cancelBtn" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
            <button id="confirmSaveBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Confirm</button>
        </div>
    </div>
</div>

<script>
document.getElementById('generateCodeBtn').addEventListener('click', function() {
    const voucherCode = Math.random().toString(36).substring(2, 10).toUpperCase();
    document.getElementById('voucherCodeInput').value = voucherCode;
});

document.getElementById('saveVoucherBtn').addEventListener('click', function() {
    document.getElementById('confirmationModal').classList.remove('hidden');
});

document.getElementById('cancelBtn').addEventListener('click', function() {
    document.getElementById('confirmationModal').classList.add('hidden');
});

document.getElementById('confirmSaveBtn').addEventListener('click', function() {
    const studentName = document.getElementById('studentName').value;
    const voucherCode = document.getElementById('voucherCodeInput').value;

    if (!studentName || !voucherCode) {
        alert('Please enter all required fields.');
        return;
    }

    document.getElementById('confirmationModal').classList.add('hidden');

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
            // Show the print notification
            document.getElementById('printNotification').classList.remove('hidden');
            // Reset the form fields
            resetForm();
        } else {
            alert('Failed to save voucher.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred.');
    });
});

document.getElementById('printBtn').addEventListener('click', function() {
    window.location.href = '/voucher.index'; 
});

function resetForm() {
    // Clear the input fields
    document.getElementById('studentName').value = '';
    document.getElementById('voucherCodeInput').value = '';
}
</script>
@endsection
