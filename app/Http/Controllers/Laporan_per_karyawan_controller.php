<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use DataTables;
use App\Models\User;
use App\Models\Transaksi;

class Laporan_per_karyawan_controller extends Controller
{
    public function index(){
    	$title = "Laporan Per Karyawan";
    	$yajra = url('laporan/per-karyawan/yajra');
        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');

    	return view('admin.laporan_per_karyawan.index',compact('title','yajra','dari','sampai'));
    }

    public function filter(Request $request){
        $title = "Laporan Per Karyawan";
        $dari = date('Y-m-d',strtotime($request->dari));
        $sampai = date('Y-m-d',strtotime($request->sampai));
        $yajra = url('laporan/per-karyawan/yajra/'.$dari.'/'.$sampai);
        // dd($dari);
        return view('admin.laporan_per_karyawan.index',compact('title','yajra','dari','sampai'));
    }

    public function yajra(Request $request){
    	DB::statement(DB::raw('set @rownum=0'));
        $users = User::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'])->where('role_id','!=',2);
        $datatables = Datatables::of($users)->addColumn('belum_dibayar',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_bayar',4)->count();
        	return $dt;
        })->addColumn('nilai_belum_dibayar',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_bayar',4)->sum('grand_total_amount');
        	return number_format($dt,0);
        })->addColumn('sudah_dibayar',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_bayar',3)->count();
        	return $dt;
        })->addColumn('nilai_sudah_dibayar',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_bayar',3)->sum('grand_total_amount');
        	return number_format($dt,0);
        })->addColumn('menunggu_dikerjakan',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',7)->count();
        	return $dt;
        })->addColumn('nilai_menunggu_dikerjakan',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',7)->sum('grand_total_amount');
        	return number_format($dt,0);
        })->addColumn('sedang_dikerjakan',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',5)->count();
        	return $dt;
        })->addColumn('nilai_sedang_dikerjakan',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',5)->sum('grand_total_amount');
        	return number_format($dt,0);
        })->addColumn('sedang_selesai',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',6)->count();
        	return $dt;
        })->addColumn('nilai_selesai',function($e){
        	$dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',6)->sum('grand_total_amount');
        	return number_format($dt,0);
        });

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }

    public function yajra_filter(Request $request,$dari,$sampai){
        DB::statement(DB::raw('set @rownum=0'));
        $users = User::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'])->where('role_id','!=',2);
        $datatables = Datatables::of($users)->addColumn('belum_dibayar',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_bayar',4)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->count();
            return $dt;
        })->addColumn('nilai_belum_dibayar',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_bayar',4)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->sum('grand_total_amount');
            return number_format($dt,0);
        })->addColumn('sudah_dibayar',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_bayar',3)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->count();
            return $dt;
        })->addColumn('nilai_sudah_dibayar',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_bayar',3)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->sum('grand_total_amount');
            return number_format($dt,0);
        })->addColumn('menunggu_dikerjakan',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',7)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->count();
            return $dt;
        })->addColumn('nilai_menunggu_dikerjakan',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',7)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->sum('grand_total_amount');
            return number_format($dt,0);
        })->addColumn('sedang_dikerjakan',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',5)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->count();
            return $dt;
        })->addColumn('nilai_sedang_dikerjakan',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',5)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->sum('grand_total_amount');
            return number_format($dt,0);
        })->addColumn('sedang_selesai',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',6)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->count();
            return $dt;
        })->addColumn('nilai_selesai',function($e)use($dari,$sampai){
            $dt = Transaksi::where('created_by',$e->id)->where('status_pengerjaan',6)->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->sum('grand_total_amount');
            return number_format($dt,0);
        });

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }
}
