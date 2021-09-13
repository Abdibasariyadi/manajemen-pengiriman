<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paket_laundry;
use App\Models\Transaksi;
use App\Models\Transaksi_line;
use App\Models\M_status;

class Laporan_per_paket_controller extends Controller
{
    public function index(){
    	$dari = date('Y-m-d');
    	$sampai = date('Y-m-d');
    	$paket_id = 'all';
    	$title = "Laporan Per Paket Laundry dari $dari sampai $sampai";
    	$pakets = Paket_laundry::where('is_active',1)->where('cabang_id',\Auth::user()->cabang_id)->get();
    	// dd($pakets);
    	$mpakets = Paket_laundry::where('is_active',1)->where('cabang_id',\Auth::user()->cabang_id)->get();
        $status = M_status::whereNotIn('id',[1,2])->get();

    	return view('admin.laporan_per_paket.index',compact('title','pakets','dari','sampai','paket_id','mpakets','status'));
    }

    public function filter(Request $request){
    	$dari = date('Y-m-d',strtotime($request->dari));
    	$sampai = date('Y-m-d',strtotime($request->sampai));
    	$paket_id = $request->paket_id;
    	$title = "Laporan Per Paket Laundry dari $dari sampai $sampai";

    	$pakets = Paket_laundry::where('is_active',1)->where('cabang_id',\Auth::user()->cabang_id);
    		if($paket_id != 'all'){
    			$pakets = $pakets->where('id',$paket_id);
    		}
    	$pakets = $pakets->get();
    	// dd($pakets);
    	$mpakets = Paket_laundry::where('is_active',1)->where('cabang_id',\Auth::user()->cabang_id)->get();
        $status = M_status::whereNotIn('id',[1,2])->get();

    	return view('admin.laporan_per_paket.index',compact('title','pakets','dari','sampai','paket_id','mpakets','status'));
    }
}
