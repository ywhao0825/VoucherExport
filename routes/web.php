<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Web\VoucherController;

Route::get('/', function () {
    return view('welcome');});

Route::group([
    'as' => 'voucher.',
], function() {

    Route::get('/generateCode', [VoucherController::class, 'generate'])->name('generateVoucher');

    Route::get('/generate', [VoucherController::class, 'export'])->name('exportVoucher');

});
