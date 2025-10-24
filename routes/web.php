<?php





use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InvoiceController;





// Route::get('/invoice/pay-request', [InvoiceController::class, 'payRequest']);
    
//     // تایید پرداخت
// Route::post('/invoice/confirm', [InvoiceController::class, 'confirm']);

Route::get('/', function () {
    return view('welcome');
});