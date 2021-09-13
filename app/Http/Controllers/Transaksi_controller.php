<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paket_laundry;
use App\Models\Transaksi;
use App\Models\Transaksi_line;
use App\Models\User;
use App\Models\Role_permission;
use App\Models\Wa_template;
use App\Models\M_role;
use App\Models\M_cabang;
use App\Models\Ledger;
use App\Models\Ledger_line;

use DB;
use DataTables;

use App\Exports\TransaksiExport;

class Transaksi_controller extends Controller
{
    public function index(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-all-transaksi');
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

        $title = 'List Transaksi';
        $yajra = url('transaksi/yajra');
        $grand_total = Transaksi::where('cabang_id',\Auth::user()->cabang_id)->sum('grand_total_amount');

        return view('admin.transaksi.index',compact('title','yajra','grand_total','dari','sampai','status_bayar','status_pengerjaan'));
    }

    public function index_filter(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-all-transaksi');
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

        $title = "List Transaksi Dari $dari Sampai $sampai";
        $yajra = url('transaksi/yajra/filter/'.$dari.'/'.$sampai.'/'.$status_bayar.'/'.$status_pengerjaan);
        $grand_total = Transaksi::whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('cabang_id',\Auth::user()->cabang_id);
        if($status_bayar != 'all'){
            $grand_total = $grand_total->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $grand_total = $grand_total->where('status_pengerjaan',$status_pengerjaan);
        }
        $grand_total = $grand_total->sum('grand_total_amount');

        return view('admin.transaksi.index',compact('title','yajra','grand_total','dari','sampai','status_bayar','status_pengerjaan'));
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
        $grand_total = Transaksi::whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('cabang_id',\Auth::user()->cabang_id);
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
            ])->whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('cabang_id',\Auth::user()->cabang_id);

        if($status_bayar != 'all'){
            $users = $users->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $users = $users->where('status_pengerjaan',$status_pengerjaan);
        }

        $users = $users->latest()->get();

        return view('admin.transaksi.index_print',compact('title','yajra','grand_total','dari','sampai','status_bayar','status_pengerjaan','users'));
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
        $grand_total = Transaksi::whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('cabang_id',\Auth::user()->cabang_id);
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
            ])->where('cabang_id',\Auth::user()->cabang_id)->whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)))->where('cabang_id',\Auth::user()->cabang_id);

        if($status_bayar != 'all'){
            $users = $users->where('status_bayar',$status_bayar);
        }

        if($status_pengerjaan != 'all'){
            $users = $users->where('status_pengerjaan',$status_pengerjaan);
        }

        $users = $users->latest()->get();

        return \Excel::download(new TransaksiExport($grand_total,$users), 'transaksi.xlsx');

        return view('admin.transaksi.index_excel',compact('title','yajra','grand_total','dari','sampai','status_bayar','status_pengerjaan','users'));
    }

    public function update_status_bayar(Request $request,$id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','update-status-bayar-transaksi');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $dt = Transaksi::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        Transaksi::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->update([
            'status_bayar'=>$request->status_bayar
        ]);
        $wablas = $this->wablas($dt->customer->no_telp,$id);
        // dd($wablas);
        return redirect()->back()->with('sukses','Status bayar berhasil diupdate');
    }

    public function update_status_pengerjaan(Request $request,$id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','update-status-pengerjaan-transaksi');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $dt = Transaksi::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        Transaksi::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->update([
            'status_pengerjaan'=>$request->status_pengerjaan
        ]);
        $wablas = $this->wablas($dt->customer->no_telp,$id);
        // dd($wablas);
        return redirect()->back()->with('sukses','Status Pengerjaan berhasil diupdate');
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Transaksi::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'transaksis.*'])->with([
                'customer',
                'status_bayar_r',
                'status_pengerjaan_r',
                'karyawan'
            ])->where('cabang_id',\Auth::user()->cabang_id)->latest();
        $datatables = Datatables::of($users)->editColumn('status_bayar_r',function($e){
            $dt = '<label class="label label-'.$e->status_bayar_r->color.'">'.$e->status_bayar_r->nama.'</label>';
            return $dt;
        })->addColumn('action',function($e){
            $url_edit = url('transaksi/'.$e->id);
            $url_status_bayar = url('transaksi/update-status-bayar/'.$e->id);
            $url_status_pengerjaan = url('transaksi/update-status-pengerjaan/'.$e->id);
            $url_view = url('transaksi/view/'.$e->id);
            $url_struck = url('transaksi/struck/'.$e->id);

            $dt = '<div class="btn-group">
                  <button type="button" class="btn btn-success">Action</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="'.$url_edit.'">Edit</a></li>
                    <li><a href="'.$url_status_bayar.'" class="btn-status-bayar">Update Status Bayar</a></li>
                    <li><a href="'.$url_status_pengerjaan.'" class="btn-status-pengerjaan">Update Status Pengerjaan</a></li>
                    <li><a target="_blank" href="'.$url_view.'" class="view">View</a></li>
                    <li><a target="_blank" href="'.$url_struck.'" class="view">Cetak Struck</a></li>
                    <li class="divider"></li>
                    <li><a href="'.$url_edit.'" class="btn-hapus">Hapus</a></li>
                  </ul>
                </div>';
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
                'status_pengerjaan_r',
                'karyawan'
            ])->where('cabang_id',\Auth::user()->cabang_id)->whereDate('transaksis.tanggal','>=',date('Y-m-d',strtotime($dari)))->whereDate('transaksis.tanggal','<=',date('Y-m-d',strtotime($sampai)));

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
        })->addColumn('action',function($e){
            $url_edit = url('transaksi/'.$e->id);
            $url_status_bayar = url('transaksi/update-status-bayar/'.$e->id);
            $url_status_pengerjaan = url('transaksi/update-status-pengerjaan/'.$e->id);
            $url_view = url('transaksi/view/'.$e->id);
            $url_struck = url('transaksi/struck/'.$e->id);
            $dt = '<div class="btn-group">
                  <button type="button" class="btn btn-success">Action</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="'.$url_edit.'">Edit</a></li>
                    <li><a href="'.$url_status_bayar.'" class="btn-status-bayar">Update Status Bayar</a></li>
                    <li><a href="'.$url_status_pengerjaan.'" class="btn-status-pengerjaan">Update Status Pengerjaan</a></li>
                    <li><a target="_blank" href="'.$url_view.'" class="view">View</a></li>
                    <li><a target="_blank" href="'.$url_struck.'" class="view">Cetak Struck</a></li>
                    <li class="divider"></li>
                    <li><a href="'.$url_edit.'" class="btn-hapus">Hapus</a></li>
                  </ul>
                </div>';
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

    public function delete($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','delete-transaksi');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        try {
            Transaksi::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
            \Session::flash('sukses','Data berhasil dihapus');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }

    public function create(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-transaksi');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Create Transaksi';
    	$pakets = Paket_laundry::where('cabang_id',\Auth::user()->cabang_id)->where('is_active',1)->get();
        // $roles = M_role::where('id',2)->get();
    	// $pakets = json_encode($pakets);

    	return view('admin.transaksi.create',compact('title','pakets'));
    }

    public function store_customer(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-user');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $data['name'] = $request->name;

        if(isset($request->email)){
            $data['email'] = $request->email;
        }else{
            $data['email'] = time().'@'.time();
        }

        // $data['role_id'] = $request->role_id;
        $data['is_customer'] = 1;
        $data['password'] = bcrypt('123');
        $data['no_telp'] = $request->no_telp;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['alamat'] = $request->alamat;
        $data['cabang_id'] = \Auth::user()->cabang_id;
        $id_user = User::insertGetId($data);

        $dt = User::find($id_user);
        return response()->json([
            'dt'=>$dt
        ]);
    }

    public function store(Request $request){
        try {
            // cek role
            $role_id = \Auth::user()->role_id;
            $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
                $e->where('title','create-transaksi');
            })->count();
            if($cek_role < 1){
                $title = 'Access Denied';
                return view('access_denied',compact('title'));
            }
            // end cek role
            // dd($request->sub_total_asli);
            \DB::transaction(function()use($request){

                // update data customer
                $user_id = $request->user_id;
                $no_telp = $request->no_wa;
                $alamat = $request->alamat;

                User::where('id',$user_id)->update([
                    'no_telp'=>$no_telp,
                    'alamat'=>$alamat
                ]);
                // end update data customer

                // create transaksi
                $header['tanggal'] = date('Y-m-d',strtotime($request->tanggal));
                // $header['diskon'] = $request->diskon;
                $header['tax'] = $request->tax;
                $header['user_id'] = $request->user_id;
                $header['status_bayar'] = $request->status_bayar;
                $header['status_pengerjaan'] = $request->status_pengerjaan;
                $header['grand_total_amount'] = $request->grand_total;
                $header['created_at'] = date('Y-m-d H:i:s');
                $header['updated_at'] = date('Y-m-d H:i:s');
                $header['reference_no'] = \Auth::user()->id.date('ymdHis');
                $header['created_by'] = \Auth::user()->id;
                $header['cabang_id'] = \Auth::user()->cabang_id;

                $transaksi = Transaksi::insertGetId($header);
                // end create transaksi

                // transaksi lines
                $lines = [];
                $total_lines = 0;
                $total_asli = 0;
                $total_diskon = 0;

                $paket_laundry_id = $request->paket_laundry_id;
                $berat = $request->berat;
                $harga = $request->harga;
                $total_harga = $request->sub_total;
                $estimasi_selesai = $request->estimasi_selesai;
                $diskon = $request->diskon;
                $sub_total_asli = $request->sub_total_asli;

                foreach ($paket_laundry_id as $e => $pl) {
                    $a['transaksi_id'] = $transaksi;
                    $a['paket_laundry_id'] = $pl;
                    $a['berat'] = $berat[$e];
                    $a['harga'] = $harga[$e];
                    $a['total_harga'] = $total_harga[$e];
                    $a['estimasi_selesai'] = $estimasi_selesai[$e];

                    $a['diskon'] = $diskon[$e];
                    $a['order_diskon'] = $sub_total_asli[$e] * $diskon[$e] / 100;

                    $a['created_at'] = date('Y-m-d H:i:s');
                    $a['updated_at'] = date('Y-m-d H:i:s');
                    array_push($lines, $a);

                    $total_lines += $total_harga[$e];
                    $total_diskon += $a['order_diskon'];
                    $total_asli += $sub_total_asli[$e];
                }

                Transaksi_line::insert($lines);
                // end transaksi lines

                // update transaksi
                $up['harga_lines'] = $total_asli;
                $up['order_tax'] = ($total_lines) * $request->tax / 100;
                $up['total'] = $total_lines;
                $up['diskon'] = $total_diskon;
                // $up['grand_total_amount'] = ($total_lines - $request->diskon) + $up['order_tax'];

                Transaksi::where('id',$transaksi)->update($up);
                // end update transaksi

                // saldo
                $sl = M_cabang::where('id',\Auth::user()->cabang_id)->first();
                $sl->saldo -= 100;
                $sl->save();

                $wablas = $this->wablas($no_telp,$transaksi);
                // dd($wablas);

                // jurnal
                $jurnal = Ledger::insertGetId([
                    'tanggal'=>$header['tanggal'],
                    'ledger_number'=>'jurnal-'.\Auth::user()->id.time(),
                    'ref_no'=>$header['reference_no'],
                    'cabang_id'=>\Auth::user()->cabang_id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'created_by'=>$header['created_by'],
                    'updated_by'=>$header['created_by']
                ]);

                Ledger_line::insert([
                    'ledger_id'=>$jurnal,
                    'coa_id'=>1,
                    'description'=>'Kas',
                    'debit'=>$header['grand_total_amount'],
                    'credit'=>0,
                    'cabang_id'=>\Auth::user()->cabang_id,
                    'tanggal'=>$header['tanggal'],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);

                if($up['diskon'] > 0){
                    Ledger_line::insert([
                        'ledger_id'=>$jurnal,
                        'coa_id'=>3,
                        'description'=>'Potongan Penjualan',
                        'debit'=>$up['diskon'],
                        'credit'=>0,
                        'cabang_id'=>\Auth::user()->cabang_id,
                        'tanggal'=>$header['tanggal'],
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')
                    ]);
                }

                if($up['order_tax'] > 0){
                    Ledger_line::insert([
                        'ledger_id'=>$jurnal,
                        'coa_id'=>4,
                        'description'=>'Hutang Pajak',
                        'debit'=>0,
                        'credit'=>$up['order_tax'],
                        'cabang_id'=>\Auth::user()->cabang_id,
                        'tanggal'=>$header['tanggal'],
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')
                    ]);
                }

                Ledger_line::insert([
                    'ledger_id'=>$jurnal,
                    'coa_id'=>5,
                    'description'=>'Penjualan',
                    'debit'=>0,
                    'credit'=>$up['total'] + $up['diskon'],
                    'cabang_id'=>\Auth::user()->cabang_id,
                    'tanggal'=>$header['tanggal'],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
                // end jurnal

            });

            \Session::flash('sukses','Transaksi berhasil disimpan');

        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect('transaksi');
    }

    public function edit($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','edit-transaksi');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $title = 'Edit Transaksi';
        $pakets = Paket_laundry::where('cabang_id',\Auth::user()->cabang_id)->where('is_active',1)->get();
        $dt = Transaksi::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        // $pakets = json_encode($pakets);

        return view('admin.transaksi.edit',compact('title','pakets','dt'));
    }

    public function view($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','view-transaksi');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        // $pakets = Paket_laundry::get();
        $dt = Transaksi::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        $title = 'View Transaksi '.$dt->reference_no;
        // $pakets = json_encode($pakets);

        return view('admin.transaksi.view',compact('title','dt'));
    }

    public function update(Request $request,$id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','edit-transaksi');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        try {
            // cek role
            $role_id = \Auth::user()->role_id;
            $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
                $e->where('title','create-transaksi');
            })->count();
            if($cek_role < 1){
                $title = 'Access Denied';
                return view('access_denied',compact('title'));
            }
            // end cek role

            \DB::transaction(function()use($request,$id){

                // update data customer
                $user_id = $request->user_id;
                $no_telp = $request->no_wa;
                $alamat = $request->alamat;

                User::where('id',$user_id)->update([
                    'no_telp'=>$no_telp,
                    'alamat'=>$alamat
                ]);
                // end update data customer

                // create transaksi
                $header['tanggal'] = date('Y-m-d',strtotime($request->tanggal));
                $header['diskon'] = $request->diskon;
                $header['tax'] = $request->tax;
                $header['user_id'] = $request->user_id;
                $header['status_bayar'] = $request->status_bayar;
                $header['status_pengerjaan'] = $request->status_pengerjaan;
                $header['grand_total_amount'] = $request->grand_total;
                // $header['created_at'] = date('Y-m-d H:i:s');
                $header['updated_at'] = date('Y-m-d H:i:s');
                $header['cabang_id'] = \Auth::user()->cabang_id;
                // $header['reference_no'] = date('ymdHis');

                Transaksi::where('id',$id)->update($header);
                $transaksi = $id;
                // end create transaksi

                // transaksi lines
                $lines = [];
                $total_lines = 0;

                $paket_laundry_id = $request->paket_laundry_id;
                $berat = $request->berat;
                $harga = $request->harga;
                $total_harga = $request->sub_total;
                $estimasi_selesai = $request->estimasi_selesai;

                foreach ($paket_laundry_id as $e => $pl) {
                    $a['transaksi_id'] = $transaksi;
                    $a['paket_laundry_id'] = $pl;
                    $a['berat'] = $berat[$e];
                    $a['harga'] = $harga[$e];
                    $a['total_harga'] = $total_harga[$e];
                    $a['estimasi_selesai'] = $estimasi_selesai[$e];
                    $a['created_at'] = date('Y-m-d H:i:s');
                    $a['updated_at'] = date('Y-m-d H:i:s');
                    array_push($lines, $a);

                    $total_lines += $total_harga[$e];
                }

                Transaksi_line::where('transaksi_id',$transaksi)->delete();
                Transaksi_line::insert($lines);
                // end transaksi lines

                // update transaksi
                $up['harga_lines'] = $total_lines;
                $up['order_tax'] = ($total_lines - $request->diskon) * $request->tax / 100;
                $up['total'] = $total_lines;
                // $up['grand_total_amount'] = ($total_lines - $request->diskon) + $up['order_tax'];

                Transaksi::where('id',$transaksi)->update($up);
                // end update transaksi

                $wablas = $this->wablas($no_telp,$transaksi);
                // dd($wablas);
            });

            \Session::flash('sukses','Transaksi berhasil disimpan');

        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect('transaksi');
    }

    public function last_struck(){
        $dt = Transaksi::where('cabang_id',\Auth::user()->cabang_id)->latest()->firstOrFail();
        $gt = \DB::table('m_profiles')->first();

        return view('admin.transaksi.struck',compact('dt','gt'));
    }

    public function struck($id){
        $dt = Transaksi::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        $gt = \DB::table('m_profiles')->first();

        return view('admin.transaksi.struck',compact('dt','gt'));
    }

    public function wablas($phone,$id_header){
        $dt = Wa_template::first();
        $hd = Transaksi::where('id',$id_header)->where('cabang_id',\Auth::user()->cabang_id)->first();
        $gt = \DB::table('m_profiles')->first();

        $pesan = $gt->nama."\n";
        $pesan .= $gt->alamat."\n\n";

        $pesan .= $gt->greeting_notif."\n\n";

        // $pesan .= "Berikut Adalah data transaksi kamu : \n\n";

        $pesan .= "Atas Nama : ".$hd->customer->name."\n";
        $pesan .= "Tanggal : ".date('d M Y',strtotime($hd->tanggal))."\n";
        $pesan .= "Ref No : ".$hd->reference_no."\n\n";

        $pesan .= "============\n";
        foreach ($hd->lines as $e => $ln) {
            $pesan .= $ln->paket_laundry->nama.' : '.$ln->berat.' Kg X '.number_format($ln->harga).' = '.number_format($ln->total_harga)."\n";
        }
        $pesan .= "============\n\n";

        $pesan .= "Diskon : ".number_format($hd->diskon)."\n";
        $pesan .= "Tax : ".number_format($hd->order_tax)."\n";
        $pesan .= "Grand Total : ".number_format($hd->grand_total_amount)."\n\n";

        $pesan .= "Status Bayar : ".$hd->status_bayar_r->nama."\n";
        $pesan .= "Status Pengerjaan : ".$hd->status_pengerjaan_r->nama."\n\n";

        $pesan .= "Terima Kasih";

        $curl = curl_init();
        $token = $dt->token;
        $data = [
            'phone' => $phone,
            'message' => $pesan,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, $dt->base_url."/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function get_customer_ajax(Request $request){

        if ($request->has('q')) {
            $cari = $request->q;
            $data = User::select('id', 'name')->where('is_customer',1)->where('name', 'LIKE', '%'.$cari.'%')->where('cabang_id',\Auth::user()->cabang_id)->get();
            return response()->json($data);
        }
    }

    public function get_detail_customer_ajax($id){
    	$dt = User::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->first();
    	return response()->json(['data'=>$dt]);
    }

    public function get_detail_paket_ajax($id,$tgl){
        $dt = Paket_laundry::find($id);
        $tanggal = date('Y-m-d',strtotime($tgl));
        $estimasi = $dt->estimasi_pengerjaan;
        $durasi = date('Y-m-d',strtotime('+'.$estimasi.' days',strtotime($tanggal)));

        return response()->json(['data'=>$dt,'durasi'=>$durasi]);
    }
}
