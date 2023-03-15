<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InspectionAcceptanceController;
use App\Http\Controllers\IssuanceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\SupplyAvailabilityController;
use App\Http\Controllers\UserAccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeneralController;

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

Route::get('logout', function() {
    \Auth::logout();
    \Session::flush();
    return redirect()->to('/login');
})->name('logout');

Auth::routes([
    'register' => false
]);

Route::get('/', function() {
    return redirect()->route('home');
})->name('welcome');


Route::post('/requisition/add',[RequisitionController::class,'add'])->name('requisition.add');
Route::delete('/requisition/remove',[RequisitionController::class,'remove'])->name('requisition.remove');
Route::get('/user', function() {
    $user = auth()->user();
    if(!$user) return 'Unauthorized';
    $user->assignRole('inspection-and-acceptance');
    // $user->syncRoles(['inspection-and-acceptance']);
    // $user->givePermissionTo('view-supplies');
    $user->givePermissionTo('view-inspection-and-acceptance');
    $user->givePermissionTo('create-inspection-and-acceptance');
    $user->givePermissionTo('edit-inspection-and-acceptance');
    $user->givePermissionTo('delete-inspection-and-acceptance');
    // $user->getAllPermissions();


    return $user;
})->name('user');

Route::middleware(['auth'])->group( function($route) {
    $route->get('/home', [HomeController::class, 'index'])->name('home');

    $route->get('/reports', [HomeController::class, 'index'])->name('reports');

    $route->get('/inquiry', [SupplyAvailabilityController::class, 'index'])->name('supplies-availability-inquiry');
    // $route->get('/supplies-availability-inquiry/search', [SupplyAvailabilityController::class, 'search'])->name('supplies-availability-inquiry.search');

    // $route->get('/purchase-order', [PurchaseOrderController::class, 'index'])->name('purchase-order');
    // $route->get('/purchase-order/{transaction_no}', [PurchaseOrderController::class, 'show'])->name('purchase-order.show');

    // $route->get('/inspection-and-acceptance', [InspectionAcceptanceController::class, 'index'])->name('inspection-and-acceptance');
    // $route->get('/inspection-and-acceptance/{transaction_no}', [HomeController::class, 'index'])->name('inspection-and-acceptance-request.show');

    // $route->get('/purchase-request', [PurchaseRequestController::class, 'index'])->name('purchase-request');
    // $route->get('/purchase-request/{transaction_no}', [PurchaseRequestController::class, 'show'])->name('purchase-request.show');



    $route->resource('supplies', 'App\Http\Controllers\ItemController',['names' => 'item']);

    $route->resource('requisition-and-issuance', 'App\Http\Controllers\RequisitionController');
    // $route->get('/requisition-and-issuance', [RequisitionController::class, 'index']);
    // $route->post('/requisition-and-issuance', [RequisitionController::class, 'store'])->name('ris.store');
    // $route->get('/requisition-and-issuance/create', [RequisitionController::class, 'create'])->name('ris.create');
    // $route->put('/requisition-and-issuance/update', [RequisitionController::class, 'update'])->name('ris.update');
    // $route->get('/requisition-and-issuance/{transaction_no}', [RequisitionController::class, 'show'])->name('ris.show');



});

Route::middleware(['auth', 'role:super-admin|admin'])->prefix('admin')->group( function($route) {
    $route->get('/user-access-control', [UserAccessController::class, 'index'])->name('uac');

    $route->resource('user', 'App\Http\Controllers\UserController');
    $route->put('user/reset-password/{id}', [UserController::class, 'resetPassword'])->name('user.reset-password');
    $route->put('user/update-permissions/{id}', [UserController::class, 'updatePermissions'])->name('user.update-permissions');
    // $route->get('/users', [UserController::class, 'index'])->name('users');
    // $route->get('/user/{id}', [UserController::class, 'show'])->name('user.show');


    $route->get('/approval', [ApprovalController::class, 'index'])->name('approval');

    $route->resource('office', 'App\Http\Controllers\OfficeController');
});


Route::middleware(['auth'])->group( function($route) {

    // Purchase Request
    $route->post('/purchase-request/add',[PurchaseRequestController::class,'add'])->name('purchase-request.add')->middleware('permission:can-create-purchase-request');
    $route->delete('/purchase-request/remove',[PurchaseRequestController::class,'remove'])->name('purchase-request.remove')->middleware('permission:can-create-purchase-request');
    $route->get('/purchase-request/{id}/print',[PurchaseRequestController::class,'print'])->name('purchase-request.print')->middleware('permission:can-view-purchase-request');

    Route::group([], function ($route) {
        $route->get('/purchase-request/create', [PurchaseRequestController::class,'create'])->name('purchase-request.create')->middleware('role_or_permission:super-admin|purchase-request|create-purchase-request');
        $route->post('/purchase-request', [PurchaseRequestController::class,'store'])->name('purchase-request.store')->middleware('role_or_permission:super-admin|purchase-request|create-purchase-request');
        Route::group(['middleware' => ['role_or_permission:super-admin|purchase-request|view-purchase-request']], function($route) {
            $route->get('/purchase-request', [PurchaseRequestController::class,'index'])->name('purchase-request.index');
            $route->get('/purchase-request/{id}', [PurchaseRequestController::class,'show'])->name('purchase-request.show');
        });

        // $route->resource('purchase-request', 'App\Http\Controllers\PurchaseRequestController');
    });

    // Purchase Order
    $route->post('/purchase-order/add',[PurchaseOrderController::class,'add'])->name('purchase-order.add')->middleware('permission:can-create-purchase-order');
    $route->delete('/purchase-order/remove',[PurchaseOrderController::class,'remove'])->name('purchase-order.remove')->middleware('permission:can-create-purchase-order');
    $route->get('/purchase-order/{id}/print',[PurchaseOrderController::class,'print'])->name('purchase-order.print')->middleware('permission:can-view-purchase-order');

    Route::group([], function ($route) {
        $route->get('/purchase-order/create', [PurchaseOrderController::class,'create'])->name('purchase-order.create')->middleware('role_or_permission:super-admin|purchase-order|create-purchase-order');
        $route->post('/purchase-order', [PurchaseOrderController::class,'store'])->name('purchase-order.store')->middleware('role_or_permission:super-admin|purchase-order|create-purchase-order');
        Route::group(['middleware' => ['role_or_permission:super-admin|purchase-order|view-purchase-order']], function($route) {
            $route->get('/purchase-order', [PurchaseOrderController::class,'index'])->name('purchase-order.index');
            $route->get('/purchase-order/{id}', [PurchaseOrderController::class,'show'])->name('purchase-order.show');
        });

        // $route->resource('purchase-order', 'App\Http\Controllers\PurchaseOrderController');
    });

    $route->get('/autocomplete/supplies', [GeneralController::class, 'autoCompleteSupplies'])->name('autocomplete-supplies');
    $route->get('/autocomplete/brands', [GeneralController::class, 'autoCompleteBrands'])->name('autocomplete-brands');
    $route->get('/autocomplete/models', [GeneralController::class, 'autoCompleteModels'])->name('autocomplete-models');
});


// Route::middleware(['auth', 'role:super-admin|admin|purchase-order'])->group( function($route) {
//     $route->post('/purchase-order/add',[PurchaseOrderController::class,'add'])->name('purchase-order.add')->middleware('permission:can-create-purchase-order');
//     $route->delete('/purchase-order/remove',[PurchaseOrderController::class,'remove'])->name('purchase-order.remove');
//     $route->get('/purchase-order/{id}/print',[PurchaseOrderController::class,'print'])->name('purchase-order.print');
//     $route->resource('purchase-order', 'App\Http\Controllers\PurchaseOrderController');
// });

Route::middleware(['auth', 'role:super-admin|admin|inspection-and-acceptance'])->group( function($route) {
    $route->resource('inspection-and-acceptance', 'App\Http\Controllers\InspectionAcceptanceController');
});


// reports
Route::any('/reports/inspection-acceptance',[ReportController::class,'inspection_acceptance'])->name('reports.ia');
Route::any('/reports/purchase-request',[ReportController::class,'purchase_request'])->name('reports.pr');
Route::any('/reports/purchase-order',[ReportController::class,'purchase_order'])->name('reports.po');
Route::any('/reports/property-card',[ReportController::class,'property_card'])->name('reports.property-card');
Route::any('/reports/property-acknowledge_receipt',[ReportController::class,'property_acknowledge_receipt'])->name('reports.par');
Route::any('/reports/inventory-custodian_slip',[ReportController::class,'inventory_custodian_slip'])->name('reports.ics');
Route::any('/reports/requisition-issue-slip',[ReportController::class,'requisition_issue_slip'])->name('reports.ris');
Route::any('/reports/inspection-acceptance-report',[ReportController::class,'inspection_acceptance_report'])->name('reports.iar');

