<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    // Display the voucher generation view
    public function generate()
    {
        return view('voucher.generate'); 
    }
    public function store(Request $request)
    {
        $request->validate([
            'studentName' => 'required|string|max:255',
            'voucherCode' => 'required|string|size:8',
        ]);

        // Save the voucher to the database
        $voucher = new Voucher();
        $voucher->student_name = $request->input('studentName');
        $voucher->voucher_code = $request->input('voucherCode');
        $voucher->save();

        return response()->json(['success' => true]);
    }

}
