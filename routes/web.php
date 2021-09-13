<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\Beranda_controller;
use App\Http\Controllers\Role_controller;
use App\Http\Controllers\Users_controller;
use App\Http\Controllers\Permission_controller;
use App\Http\Controllers\Customer_controller;
use App\Http\Controllers\Paket_laundry_controller;
use App\Http\Controllers\Transaksi_controller;
use App\Http\Controllers\Transaksiku_controller;
use App\Http\Controllers\Wa_template_controller;
use App\Http\Controllers\Profile_controller;
use App\Http\Controllers\Laporan_per_cust_controller;
use App\Http\Controllers\Laporan_per_paket_controller;
use App\Http\Controllers\Laporan_per_karyawan_controller;
use App\Http\Controllers\Supplier_controller;
use App\Http\Controllers\Coa_category_controller;
use App\Http\Controllers\Coa_controller;
use App\Http\Controllers\Jurnal_controller;
use App\Http\Controllers\Income_controller;
use App\Http\Controllers\Expense_controller;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\Laporan_PengirimanController;
use App\Http\Controllers\PenjemputanController;

Route::get('/', function () {
	// dd(bcrypt('asasas'));
    // return view('welcome');
    return redirect('login');
});

Route::get('keluar',function(){
	\Auth::logout();
	return redirect('login');
});

Route::group(['middleware'=>'auth'],function(){

	Route::get('beranda',[Beranda_controller::class,'index']);

	// income
	// Route::get('admin/income',[Income_controller::class,'index']);
	// Route::get('admin/income/yajra',[Income_controller::class,'yajra']);

	// Route::get('admin/income/filter',[Income_controller::class,'index_filter']);
	// Route::get('admin/income/yajra/{dari}/{sampai}',[Income_controller::class,'yajra_filter']);

	// Route::post('admin/income/verif',[Income_controller::class,'verif']);

	// Route::get('admin/income/create',[Income_controller::class,'create']);
	// Route::post('admin/income/create',[Income_controller::class,'store']);

	// Route::get('admin/income/{id}',[Income_controller::class,'edit']);
	// Route::put('admin/income/{id}',[Income_controller::class,'update']);

	// Route::delete('admin/income/{id}',[Income_controller::class,'delete']);

	// // expense
	// Route::get('admin/expense',[Expense_controller::class,'index']);
	// Route::get('admin/expense/yajra',[Expense_controller::class,'yajra']);

	// Route::get('admin/expense/filter',[Expense_controller::class,'index_filter']);
	// Route::get('admin/expense/yajra/{dari}/{sampai}',[Expense_controller::class,'yajra_filter']);

	// Route::post('admin/expense/verif',[Expense_controller::class,'verif']);

	// Route::get('admin/expense/create',[Expense_controller::class,'create']);
	// Route::post('admin/expense/create',[Expense_controller::class,'store']);

	// Route::get('admin/expense/{id}',[Expense_controller::class,'edit']);
	// Route::put('admin/expense/{id}',[Expense_controller::class,'update']);

	// Route::delete('admin/expense/{id}',[Expense_controller::class,'delete']);

	// // jurnal
	// Route::get('admin/jurnal',[Jurnal_controller::class,'index']);
	// Route::get('admin/jurnal/yajra',[Jurnal_controller::class,'yajra']);
	// Route::get('admin/jurnal/yajra/detail/{id}',[Jurnal_controller::class,'yajra_details']);

	// Route::get('admin/jurnal/create',[Jurnal_controller::class,'create']);
	// Route::post('admin/jurnal/create',[Jurnal_controller::class,'store']);

	// // master coa
	// Route::get('admin/coa',[Coa_controller::class,'index']);
	// Route::get('admin/coa/yajra',[Coa_controller::class,'yajra']);

	// Route::get('admin/coa/create',[Coa_controller::class,'create']);
	// Route::post('admin/coa/create',[Coa_controller::class,'store']);

	// Route::get('admin/coa/{id}',[Coa_controller::class,'edit']);
	// Route::put('admin/coa/{id}',[Coa_controller::class,'update']);

	// Route::delete('admin/coa/{id}',[Coa_controller::class,'delete']);

	// master coa category
	// Route::get('admin/coa-category',[Coa_category_controller::class,'index']);
	// Route::get('admin/coa-category/yajra',[Coa_category_controller::class,'yajra']);

	// Route::get('admin/coa-category/create',[Coa_category_controller::class,'create']);
	// Route::post('admin/coa-category/create',[Coa_category_controller::class,'store']);

	// Route::get('admin/coa-category/{id}',[Coa_category_controller::class,'edit']);
	// Route::put('admin/coa-category/{id}',[Coa_category_controller::class,'update']);

	// Route::delete('admin/coa-category/{id}',[Coa_category_controller::class,'delete']);

	// master supplier
	// Route::get('admin/supplier',[Supplier_controller::class,'index']);
	// Route::get('admin/supplier/yajra',[Supplier_controller::class,'yajra']);

	// Route::get('admin/supplier/create',[Supplier_controller::class,'create']);
	// Route::post('admin/supplier/create',[Supplier_controller::class,'store']);

	// Route::get('admin/supplier/{id}',[Supplier_controller::class,'edit']);
	// Route::put('admin/supplier/{id}',[Supplier_controller::class,'update']);

	// Route::delete('admin/supplier/{id}',[Supplier_controller::class,'delete']);

	// laporan per karyawan
	// Route::get('laporan/per-karyawan',[Laporan_per_karyawan_controller::class,'index']);
	// Route::get('laporan/per-karyawan/yajra',[Laporan_per_karyawan_controller::class,'yajra']);
	// Route::get('laporan/per-karyawan/filter',[Laporan_per_karyawan_controller::class,'filter']);
	// Route::get('laporan/per-karyawan/yajra/{dari}/{sampai}',[Laporan_per_karyawan_controller::class,'yajra_filter']);

	// laporan per paket laundry
	// Route::get('laporan/per-paket',[Laporan_per_paket_controller::class,'index']);
	// Route::get('laporan/per-paket/filter',[Laporan_per_paket_controller::class,'filter']);

	// laporan per cust
	// Route::get('laporan/per-cust',[Laporan_per_cust_controller::class,'index']);
	// Route::get('laporan/per-cust/filter',[Laporan_per_cust_controller::class,'filter']);
	// Route::get('laporan/per-cust/get-user',[Laporan_per_cust_controller::class,'get_user']);
	// Route::get('laporan/per-cust/yajra',[Laporan_per_cust_controller::class,'yajra']);
	// Route::get('laporan/per-cust/yajra/{dari}/{sampai}/{user_id}',[Laporan_per_cust_controller::class,'yajra_filter']);

	// profile company
	Route::get('profile-comp',[Profile_controller::class,'index']);
	Route::post('profile-comp',[Profile_controller::class,'update']);

	// master role
	Route::get('admin/role',[Role_controller::class,'index']);
	Route::get('admin/role/permission/{id}',[Role_controller::class,'manage_permission']);
	Route::get('admin/role/permission/delete/{id}',[Role_controller::class,'manage_permission_delete']);
	Route::get('admin/role/permission/{role}/{permission}',[Role_controller::class,'manage_permission_store']);
	Route::get('admin/role/create',[Role_controller::class,'create']);
	Route::post('admin/role/create',[Role_controller::class,'store']);
	Route::get('admin/role/{id}',[Role_controller::class,'edit']);
	Route::put('admin/role/{id}',[Role_controller::class,'update']);
	Route::delete('admin/role/{id}',[Role_controller::class,'delete']);

	// master users
	Route::get('admin/users',[Users_controller::class,'index']);
	Route::get('admin/users/filter',[Users_controller::class,'index_filter']);
	Route::get('admin/users/yajra/{role}',[Users_controller::class,'yajra']);
	Route::get('admin/users/create',[Users_controller::class,'create']);
	Route::post('admin/users/create',[Users_controller::class,'store']);
	Route::get('admin/users/{id}',[Users_controller::class,'edit']);
	Route::put('admin/users/{id}',[Users_controller::class,'update']);
	Route::delete('admin/users/{id}',[Users_controller::class,'delete']);

	// master permissions
	Route::get('admin/permissions',[Permission_controller::class,'index']);
	Route::post('admin/permissions',[Permission_controller::class,'store']);

	// change password
	Route::get('change-password',[Users_controller::class,'change_password']);
	Route::put('change-password',[Users_controller::class,'change_password_update']);

	// master customers
	// Route::get('admin/customer',[Customer_controller::class,'index']);
	// Route::get('admin/customer/yajra',[Customer_controller::class,'yajra']);
	// Route::get('admin/customer/create',[Customer_controller::class,'create']);
	// Route::post('admin/customer/create',[Customer_controller::class,'store']);
	// Route::get('admin/customer/{id}',[Customer_controller::class,'edit']);
	// Route::put('admin/customer/{id}',[Customer_controller::class,'update']);
	// Route::delete('admin/customer/{id}',[Customer_controller::class,'delete']);

	// paket laundry
	// Route::get('paket-laundry',[Paket_laundry_controller::class,'index']);
	// Route::get('paket-laundry/status/{id}',[Paket_laundry_controller::class,'update_status']);
	// Route::get('paket-laundry/create',[Paket_laundry_controller::class,'create']);
	// Route::post('paket-laundry/create',[Paket_laundry_controller::class,'store']);
	// Route::get('paket-laundry/{id}',[Paket_laundry_controller::class,'edit']);
	// Route::put('paket-laundry/{id}',[Paket_laundry_controller::class,'update']);
	// Route::delete('paket-laundry/{id}',[Paket_laundry_controller::class,'delete']);

    // Pengiriman
	Route::get('pengiriman',[PengirimanController::class,'index']);
	Route::get('pengiriman/status/{id}',[Paket_laundry_controller::class,'update_status']);
	Route::get('pengiriman/create',[PengirimanController::class,'create']);
	Route::post('pengiriman/create',[PengirimanController::class,'store'])->name('store.pengiriman');
	Route::get('pengiriman/{id}',[Paket_laundry_controller::class,'edit']);
	Route::put('pengiriman/{id}',[Paket_laundry_controller::class,'update']);
	Route::delete('pengiriman/{id}',[Paket_laundry_controller::class,'delete']);
	Route::get('pengiriman/get-id',[PengirimanController::class,'get_id']);
    Route::get('pengiriman/get-details/{id}',[PengirimanController::class,'getDetails'])->name('getDetails');


    // Penjemputan
	Route::get('admin/penjemputan',[PenjemputanController::class,'index']);
	Route::get('admin/penjemputan/status/{id}',[PenjemputanController::class,'update_status']);
	Route::get('admin/penjemputan/create',[PenjemputanController::class,'create']);
	Route::post('admin/penjemputan/create',[PenjemputanController::class,'store'])->name('store.penjemputan');
	Route::get('admin/penjemputan/{id}',[PenjemputanController::class,'edit']);
	Route::put('admin/penjemputan/{id}',[PenjemputanController::class,'update']);
	Route::delete('admin/penjemputan/{id}',[PenjemputanController::class,'delete']);
    Route::get('admin/penjemputan/get-user',[Laporan_PengirimanController::class,'get_user']);

	// Laporan Pengiriman
	Route::get('laporan/pengiriman',[Laporan_PengirimanController::class,'index']);
    Route::get('laporan/pengiriman/yajra',[Laporan_PengirimanController::class,'yajra']);
    Route::get('laporan/pengiriman/yajra/{dari}/{sampai}/{user_id}',[Laporan_PengirimanController::class,'yajra_filter']);
    Route::get('laporan/pengiriman/filter',[Laporan_PengirimanController::class,'filter']);
	Route::get('laporan/pengiriman/get-user',[Laporan_PengirimanController::class,'get_user']);
    Route::get('laporan/pengiriman/{id}',[Laporan_PengirimanController::class,'edit']);

	// transaksi
	Route::get('transaksi',[Transaksi_controller::class,'index']);
	Route::get('transaksi/struck/last',[Transaksi_controller::class,'last_struck']);
	Route::get('transaksi/struck/{id}',[Transaksi_controller::class,'struck']);

	Route::get('transaksi/view/{id}',[Transaksi_controller::class,'view']);
	Route::get('transaksi/filter',[Transaksi_controller::class,'index_filter']);
	Route::get('transaksi/filter/print',[Transaksi_controller::class,'index_filter_print']);
	Route::get('transaksi/filter/excel',[Transaksi_controller::class,'index_filter_excel']);

	Route::get('transaksi/yajra',[Transaksi_controller::class,'yajra']);
	Route::get('transaksi/yajra/filter/{dari}/{sampai}/{status_bayar}/{status_pengerjaan}',[Transaksi_controller::class,'yajra_filter']);

	Route::get('transaksi/create',[Transaksi_controller::class,'create']);
	Route::get('transaksi/create/get-customer-ajax',[Transaksi_controller::class,'get_customer_ajax']);
	Route::get('transaksi/create/get-detail-customer-ajax/{id}',[Transaksi_controller::class,'get_detail_customer_ajax']);
	Route::get('transaksi/create/get-detail-paket-ajax/{id}/{tgl}',[Transaksi_controller::class,'get_detail_paket_ajax']);
	Route::post('transaksi/create',[Transaksi_controller::class,'store']);
	Route::post('transaksi/create-customer',[Transaksi_controller::class,'store_customer']);
	Route::get('transaksi/{id}',[Transaksi_controller::class,'edit']);
	Route::put('transaksi/{id}',[Transaksi_controller::class,'update']);
	Route::delete('transaksi/{id}',[Transaksi_controller::class,'delete']);



	Route::post('transaksi/update-status-bayar/{id}',[Transaksi_controller::class,'update_status_bayar']);
	Route::post('transaksi/update-status-pengerjaan/{id}',[Transaksi_controller::class,'update_status_pengerjaan']);

	// wa template
	Route::get('wa-template',[Wa_template_controller::class,'index']);
	Route::put('wa-template',[Wa_template_controller::class,'update']);

	// transaksi Ku per user
	Route::get('transaksiku',[Transaksiku_controller::class,'index']);
	Route::get('transaksiku/view/{id}',[Transaksiku_controller::class,'view']);
	Route::get('transaksiku/filter',[Transaksiku_controller::class,'index_filter']);
	Route::get('transaksiku/filter/print',[Transaksiku_controller::class,'index_filter_print']);
	Route::get('transaksiku/filter/excel',[Transaksiku_controller::class,'index_filter_excel']);

	Route::get('transaksiku/yajra',[Transaksiku_controller::class,'yajra']);
	Route::get('transaksiku/yajra/filter/{dari}/{sampai}/{status_bayar}/{status_pengerjaan}',[Transaksiku_controller::class,'yajra_filter']);

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    return redirect('beranda');
})->name('dashboard');
