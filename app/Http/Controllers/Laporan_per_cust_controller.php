<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;

use DB;
use DataTables;

class Laporan_per_cust_controller extends Controller
{
    public function index(){
    	$title = 'Laporan Per Customer';
    	// $data = User::limit(15)->orderBy('name')->get();
    	$yajra = url('laporan/per-cust/yajra');
        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');
        $user_id = 'all';
        $name_user = 'All';

    	return view('admin.laporan_per_cust.index',compact('title','yajra','dari','sampai','user_id','name_user'));
    }

    public function filter(Request $request){
        // $data = User::limit(15)->orderBy('name')->get();
        $dari = date('Y-m-d',strtotime($request->dari));
        $sampai = date('Y-m-d',strtotime($request->sampai));
        $title = "Laporan Per Customer dari $dari sampai $sampai";
        $user_id = $request->user_id;
        $yajra = url('laporan/per-cust/yajra/'.$dari.'/'.$sampai.'/'.$user_id);

        if($user_id != 'all'){
            $us = User::find($user_id);
            $name_user = $us->name;
        }else{
            $us = 'all';
            $name_user = 'All';
        }

        return view('admin.laporan_per_cust.index',compact('title','yajra','dari','sampai','user_id','name_user'));
    }

    public function get_user(Request $request){

        if ($request->has('q')) {
            $cari = $request->q;
            $data = User::select('id', 'name')->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
        }
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = User::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'])->where('cabang_id',\Auth::user()->cabang_id);
        $datatables = Datatables::of($users)->addColumn('belum_dibayar',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_bayar',4)->count();
        	return $dt;
        })->addColumn('nilai_belum_dibayar',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_bayar',4)->sum('grand_total_amount');
        	return number_format($dt,0);
        })->addColumn('sudah_dibayar',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_bayar',3)->count();
        	return $dt;
        })->addColumn('nilai_sudah_dibayar',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_bayar',3)->sum('grand_total_amount');
        	return number_format($dt,0);
        })->addColumn('menunggu_dikerjakan',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_pengerjaan',7)->count();
        	return $dt;
        })->addColumn('nilai_menunggu_dikerjakan',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_pengerjaan',7)->sum('grand_total_amount');
        	return number_format($dt,0);
        })->addColumn('sedang_dikerjakan',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_pengerjaan',5)->count();
        	return $dt;
        })->addColumn('nilai_sedang_dikerjakan',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_pengerjaan',5)->sum('grand_total_amount');
        	return number_format($dt,0);
        })->addColumn('sedang_selesai',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_pengerjaan',6)->count();
        	return $dt;
        })->addColumn('nilai_selesai',function($e){
        	$dt = Transaksi::where('user_id',$e->id)->where('status_pengerjaan',6)->sum('grand_total_amount');
        	return number_format($dt,0);
        });

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
	}

    public function yajra_filter(Request $request,$dari,$sampai,$user_id)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = User::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'])->where('cabang_id',\Auth::user()->cabang_id);

        if($user_id != 'all'){
            $users = $users->where('id',$user_id);
        }

        $datatables = Datatables::of($users)->addColumn('belum_dibayar',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_bayar',4)->count();
            return $dt;
        })->addColumn('nilai_belum_dibayar',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_bayar',4)->sum('grand_total_amount');
            return number_format($dt,0);
        })->addColumn('sudah_dibayar',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_bayar',3)->count();
            return $dt;
        })->addColumn('nilai_sudah_dibayar',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_bayar',3)->sum('grand_total_amount');
            return number_format($dt,0);
        })->addColumn('menunggu_dikerjakan',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_pengerjaan',7)->count();
            return $dt;
        })->addColumn('nilai_menunggu_dikerjakan',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_pengerjaan',7)->sum('grand_total_amount');
            return number_format($dt,0);
        })->addColumn('sedang_dikerjakan',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_pengerjaan',5)->count();
            return $dt;
        })->addColumn('nilai_sedang_dikerjakan',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_pengerjaan',5)->sum('grand_total_amount');
            return number_format($dt,0);
        })->addColumn('sedang_selesai',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_pengerjaan',6)->count();
            return $dt;
        })->addColumn('nilai_selesai',function($e)use($dari,$sampai){
            $dt = Transaksi::where('user_id',$e->id)->whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('status_pengerjaan',6)->sum('grand_total_amount');
            return number_format($dt,0);
        });

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }
}
