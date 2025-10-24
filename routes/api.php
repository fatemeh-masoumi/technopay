<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InvoiceController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/invoice/pay-request', [InvoiceController::class, 'payRequest'])
        ->name('invoice.payRequest');

    Route::post('/invoice/confirm', [InvoiceController::class, 'confirm'])
        ->name('invoice.confirm');
});
