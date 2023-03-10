<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Open invoices   //
Route::get('invoices' , [App\Http\Controllers\InvoicesController::class,'index']);
Route::get('invoices/create' , [App\Http\Controllers\InvoicesController::class,'create']);
Route::post('invoices/store' , [App\Http\Controllers\InvoicesController::class,'store']);
Route::get('sections/{id}' , [App\Http\Controllers\InvoicesController::class,'getproducts']);
Route::get('edit_invoice/{id}' , [App\Http\Controllers\InvoicesController::class,'edit']);
Route::get('Status_show/{id}' , [App\Http\Controllers\InvoicesController::class,'show'])->name('Status_show');
Route::post('Status_Update/{id}' , [App\Http\Controllers\InvoicesController::class,'Status_update'])->name('Status_Update');
Route::post('invoices/update' , [App\Http\Controllers\InvoicesController::class,'update']);
Route::post('invoices/destroy' , [App\Http\Controllers\InvoicesController::class,'destroy']);
// Open invoices_Archives //
Route::post('invoices/trached' , [App\Http\Controllers\InvoicesController::class,'trached']);
// End invoices_Archives //
// Open Print_invoice //
Route::get('Print_invoice/{id}' , [App\Http\Controllers\InvoicesController::class,'showDate']);
// End Print_invoice //
// open invoices Paid  //
Route::get('invoices_paid' , [App\Http\Controllers\InvoicesController::class,'invoices_paid']);
Route::get('invoices_unpaid' , [App\Http\Controllers\InvoicesController::class,'invoices_unpaid']);
Route::get('invoices_Partially' , [App\Http\Controllers\InvoicesController::class,'invoices_Partially']);
// End invoices Paid  //
// Open export  //
Route::get('/invoices/export', [App\Http\Controllers\InvoicesController::class, 'export']);
// End export //
Route::get('MarkAsRead_all', [App\Http\Controllers\InvoicesController::class, 'MarkAsRead_all'])->name('MarkAsRead_all');
// End invoices  //

// Open invoices_Archives //
Route::get('invoices_Archives' , [App\Http\Controllers\Archives::class,'index']);
Route::post('invoices_update' , [App\Http\Controllers\Archives::class,'update']);
Route::post('invoices_destroy' , [App\Http\Controllers\Archives::class,'destroy']);
// End invoices_Archives //

// Open InvoicesDetils   //
Route::get('InvoicesDetils/{id}' , [App\Http\Controllers\InvoicesDetailsController::class,'show']);
Route::get('View_file/{invoice_number}/{file_name}' , [App\Http\Controllers\InvoicesDetailsController::class,'open_file']);
Route::get('download/{invoice_number}/{file_name}',[App\Http\Controllers\InvoicesDetailsController::class,'download_file']);
Route::post('delete_file',[App\Http\Controllers\InvoicesDetailsController::class,'destroy'])->name('delete_file');
// End InvoicesDetils   //

// Open InvoicesAttachments   //
Route::post('InvoiceAttachments' , [App\Http\Controllers\InvoicesAttachmentsController::class,'store']);
// End InvoicesAttachments   //

// Open invoices_report  //
    Route::get('invoices_report', [App\Http\Controllers\Invoices_report::class, 'index']);
    Route::post('Search_invoices', [App\Http\Controllers\Invoices_report::class, 'Search_invoices']);
    Route::get('customers_report', [App\Http\Controllers\Invoices_report::class, 'show']);
    Route::post('Search_customers', [App\Http\Controllers\Invoices_report::class, 'Search_customers']);
// End invoices_report  //


//  Open Sections     //
Route::get('Sections' , [App\Http\Controllers\SectionsController::class,'index']);
Route::post('insert/section' , [App\Http\Controllers\SectionsController::class,'store']);
Route::post('insert/update' , [App\Http\Controllers\SectionsController::class,'update']);
Route::post('insert/destroy' , [App\Http\Controllers\SectionsController::class,'destroy']);
//  End Section     //

//  Open products     //
Route::get('products' , [App\Http\Controllers\productsController::class,'index']);
Route::post('insert/products' , [App\Http\Controllers\productsController::class,'store']);
Route::post('update/products' , [App\Http\Controllers\productsController::class,'update']);
Route::post('destroy/products' , [App\Http\Controllers\productsController::class,'destroy']);
//  End products     //

    Route::group(['middleware' => ['auth']], function() {

        /**
         * User Routes
         */
        // Route::group(['prefix' => 'users'], function() {
        //     // Route::get('users', [App\Http\Controllers\UsersController::class, 'index']);
        //     // Route::get('users/create', [App\Http\Controllers\UsersController::class, 'create']);
        //     //Route::post('users/store', [App\Http\Controllers\UsersController::class], 'store');
        //     // Route::get('/{user}/show', [App\Http\Controllers\UsersController::class], 'show');
        //     // Route::get('/{user}/edit', [App\Http\Controllers\UsersController::class], 'edit');
        //     // Route::patch('/{user}/update', [App\Http\Controllers\UsersController::class], 'update');
        //     // Route::delete('/{user}/delete', [App\Http\Controllers\UsersController::class], 'destroy');
        // });
        Route::resource('roles', RolesController::class);
        Route::resource('users', UsersController::class);
    });

// OPen payment  //
Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => [App\Http\Controllers\PaypalController::class, 'payWithPaypal']));
Route::post('paypal', array('as' => 'paypal','uses' => [App\Http\Controllers\PaypalController::class, 'postPaymentWithpaypal']));
Route::get('paypal', array('as' => 'status','uses' => [App\Http\Controllers\PaypalController::class, 'getPaymentStatus']));
// End payment  //

//Route::post('/updateProfile', [App\Http\Controllers\UsersController::class, 'updateProfile'])->name('update.profile');

Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
