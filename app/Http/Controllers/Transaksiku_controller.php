<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paket_laundry;
use App\Models\Transaksi;
use App\Models\Transaksi_line;
use App\Models\User;
use App\Models\Role_permission;
use App\Models\Wa_template;

use DB;
use DataTables;

use App\Exports\TransaksiExport;

class Transaksiku_controller extends Controller
{
    public function index(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-transaksi-ku');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');
        $status_bayar = 'all';
        $status_pengerjaan = 'all';

        $title = 'List Transaksi Ku';
        $yajra = url('transaksiku/yajra');
        $grand_total = Transaksi::sum('grand_total_amount');

        return view('admin.transaksiku.index',compact('title','yajra','grand_total','dari','sampai','status_bayar','status_pengerjaan'));
    }

    public function index_filter(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-transaksi-ku');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $dari = $request->dari;
        $sampai = $request->sampai;
        $status_bayar = $request->status_bayar;
        $status_pengerjaan = $request->status_pengerjaan;

        $title = "List Transaksi Ku Dari $dari Sampai $sampai";
        $yajra = url('transaksiku/yajra/filter/'.$dari.'/'.$sampai.'/'.$status_bayar.'/'.$status_pengerjaan);
        $grand_total = Transaksi::whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)));
        if($status_bayar != 'all'){
            $grand_total = $grand_total->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $grand_total = $grand_total->where('status_pengerjaan',$status_pengerjaan);
        }
        $grand_total = $grand_total->sum('grand_total_amount');

        return view('admin.transaksiku.index',compact('title','yajra','grand_total','dari','sampai','status_bayar','status_pengerjaan'));
    }

    public function index_filter_print(Request $request){
        // cek role
        // dd('asd');

        $dari = $request->dari;
        $sampai = $request->sampai;
        $status_bayar = $request->status_bayar;
        $status_pengerjaan = $request->status_pengerjaan;

        $title = "List Transaksi Dari $dari Sampai $sampai";
        $yajra = url('transaksi/yajra/filter/'.$dari.'/'.$sampai.'/'.$status_bayar.'/'.$status_pengerjaan);
        $grand_total = Transaksi::whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('user_id',\Auth::user()->id);
        if($status_bayar != 'all'){
            $grand_total = $grand_total->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $grand_total = $grand_total->where('status_pengerjaan',$status_pengerjaan);
        }
        $grand_total = $grand_total->sum('grand_total_amount');

        $users = Transaksi::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'transaksis.*'])->with([
                'customer',
                'status_bayar_r',
                'status_pengerjaan_r'
            ])->whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('user_id',\Auth::user()->id);

        if($status_bayar != 'all'){
            $users = $users->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $users = $users->where('status_pengerjaan',$status_pengerjaan);
        }

        $users = $users->latest()->get();

        return view('admin.transaksiku.index_print',compact('title','yajra','grand_total','dari','sampai','status_bayar','status_pengerjaan','users'));
    }

    public function index_filter_excel(Request $request){
        // cek role
        // dd('asd');

        $dari = $request->dari;
        $sampai = $request->sampai;
        $status_bayar = $request->status_bayar;
        $status_pengerjaan = $request->status_pengerjaan;

        $title = "List Transaksi Dari $dari Sampai $sampai";
        $yajra = url('transaksi/yajra/filter/'.$dari.'/'.$sampai.'/'.$status_bayar.'/'.$status_pengerjaan);
        $grand_total = Transaksi::whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('user_id',\Auth::user()->id);
        if($status_bayar != 'all'){
            $grand_total = $grand_total->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $grand_total = $grand_total->where('status_pengerjaan',$status_pengerjaan);
        }
        $grand_total = $grand_total->sum('grand_total_amount');

        $users = Transaksi::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'transaksis.*'])->with([
                'customer',
                'status_bayar_r',
                'status_pengerjaan_r'
            ])->whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('user_id',\Auth::user()->id);

        if($status_bayar != 'all'){
            $users = $users->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $users = $users->where('status_pengerjaan',$status_pengerjaan);
        }

        $users = $users->latest()->get();

        return \Excel::download(new TransaksiExport($grand_total,$users), 'transaksi.xlsx');

        return view('admin.transaksiku.index_excel',compact('title','yajra','grand_total','dari','sampai','status_bayar','status_pengerjaan','users'));
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Transaksi::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'transaksis.*'])->with([
                'customer',
                'status_bayar_r',
                'status_pengerjaan_r'
            ])->where('user_id',\Auth::user()->id)->latest();
        $datatables = Datatables::of($users)->editColumn('status_bayar_r',function($e){
            $dt = '<label class="label label-'.$e->status_bayar_r->color.'">'.$e->status_bayar_r->nama.'</label>';
            return $dt;
        })->editColumn('status_pengerjaan_r',function($e){
            $dt = '<label class="label label-'.$e->status_pengerjaan_r->color.'">'.$e->status_pengerjaan_r->nama.'</label>';
            return $dt;
        })->editColumn('diskon',function($e){
            return '-Rp. '.number_format($e->diskon);
        })->editColumn('order_tax',function($e){
            return "($e->tax".'%'.")".'+Rp. '.number_format($e->order_tax);
        })->editColumn('total',function($e){
            return 'Rp. '.number_format($e->total);
        })->editColumn('grand_total_amount',function($e){
            return 'Rp. '.number_format($e->grand_total_amount);
        })->editColumn('tanggal',function($e){
            return date('d M Y',strtotime($e->tanggal));
        })->rawColumns(['status_bayar_r','status_pengerjaan_r','action']);

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }

    public function yajra_filter(Request $request,$dari,$sampai,$status_bayar,$status_pengerjaan)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Transaksi::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'transaksis.*'])->with([
                'customer',
                'status_bayar_r',
                'status_pengerjaan_r'
            ])->whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('user_id',\Auth::user()->id);

        if($status_bayar != 'all'){
            $users = $users->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $users = $users->where('status_pengerjaan',$status_pengerjaan);
        }

        $users = $users->latest();

        $datatables = Datatables::of($users)->editColumn('status_bayar_r',function($e){
            $dt = '<label class="label label-'.$e->status_bayar_r->color.'">'.$e->status_bayar_r->nama.'</label>';
            return $dt;
        })->editColumn('status_pengerjaan_r',function($e){
            $dt = '<label class="label label-'.$e->status_pengerjaan_r->color.'">'.$e->status_pengerjaan_r->nama.'</label>';
            return $dt;
        })->editColumn('diskon',function($e){
            return '-Rp. '.number_format($e->diskon);
        })->editColumn('order_tax',function($e){
            return "($e->tax".'%'.")".'+Rp. '.number_format($e->order_tax);
        })->editColumn('total',function($e){
            return 'Rp. '.number_format($e->total);
        })->editColumn('grand_total_amount',function($e){
            return 'Rp. '.number_format($e->grand_total_amount);
        })->editColumn('tanggal',function($e){
            return date('d M Y',strtotime($e->tanggal));
        })->rawColumns(['status_bayar_r','status_pengerjaan_r','action']);

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }
}
