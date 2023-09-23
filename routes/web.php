<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoiceAttachementsController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Customers_Report;



Route::get('/', function () {
     return view('auth.login');
     
});
Route::get('/n', function () {
    // return view('auth.login');
      return view('notification');
    
});



Auth::routes(['register'=>false]); //permet de filtrer register
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('invoices',InvoicesController::class);
Route::resource('sections',SectionsController::class);
Route::resource('products',ProductsController::class);
Route::resource('InvoiceAttachments',InvoiceAttachementsController::class);
Route::get('/section/{id}', [InvoicesController::class,'getproducts']);
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class,'edit']);
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file']);
Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');

Route::get('/edit_invoice/{id}', [InvoicesController::class,'edit']);
//route pour changer status de payement
Route::get('/Status_show/{id}', [InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{id}',[InvoicesController::class,'Status_Update'])->name('Status_Update');

 
Route::get('Invoice_Paid',[InvoicesController::class,'Invoice_Paid']);
Route::get('Invoice_UnPaid',[InvoicesController::class,'Invoice_UnPaid']);
Route::get('Invoice_Partial',[InvoicesController::class,'Invoice_Partial']);

Route::resource('Archive',InvoiceAchiveController::class);

Route::get('Print_invoice/{id}',[InvoicesController::class,'Print_invoice']);


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

//rapports

Route::get('invoices_report', [Invoices_Report::class,'index']);
Route::post('Search_invoices',[Invoices_Report::class,'Search_invoices']);

Route::get('customers_report', [Customers_Report::class,'index'])->name("customers_report");
Route::post('Search_customers', [Customers_Report::class,'Search_customers']);

// notifications

Route::get('MarkAsRead_all',[InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

Route::get('unreadNotifications_count', [InvoicesController::class,'unreadNotifications_count'])->name('unreadNotifications_count');

Route::get('unreadNotifications', [InvoicesController::class,'unreadNotifications'])->name('unreadNotifications');



Route::get('/{page}', [AdminController::class, 'index']);


