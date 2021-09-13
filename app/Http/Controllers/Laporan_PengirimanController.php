<?php

namespace App\Http\Controllers;

use App\Models\M_pengiriman;
use Illuminate\Http\Request;

use DB;
use DataTables;

use App\Models\M_supplier;
use App\Models\User;

class Laporan_PengirimanController extends Controller
{
    public function index(){
    	$title = 'Laporan Pengiriman';
        $yajra = url('laporan/pengiriman/yajra');
        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');
        $user_id = 'all';
        $name_user = 'All';

    	return view('admin.laporan_pengiriman.index',compact('title','yajra','dari','sampai','user_id','name_user'));
    }

    public function filter(Request $request){
        // $data = User::limit(15)->orderBy('name')->get();
        $dari = date('Y-m-d',strtotime($request->dari));
        $sampai = date('Y-m-d',strtotime($request->sampai));
        $title = "Laporan Pengiriman dari $dari sampai $sampai";
        $user_id = $request->user_id;
        $yajra = url('laporan/pengiriman/yajra/'.$dari.'/'.$sampai.'/'.$user_id);

        if($user_id != 'all'){
            $us = User::find($user_id);
            $name_user = $us->name;
        }else{
            $us = 'all';
            $name_user = 'All';
        }

        return view('admin.laporan_pengiriman.index',compact('title','yajra','dari','sampai','user_id','name_user'));
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
        $users = M_pengiriman::join('penjemputan', 'penjemputan.id', '=', 'pengiriman.penjemputan_id')->join('users', 'users.id', '=', 'pengiriman.user_id')->where('pengiriman.cabang_id',\Auth::user()->cabang_id);
        $datatables = Datatables::of($users)->addColumn('action',function($e){
            $url = url('laporan/pengiriman/'.$e->id);

            return '<div style="width:60px"><a href="'.$url.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="'.$url.'" class="btn btn-danger btn-xs btn-hapus" id="delete"><i class="fa fa-trash-o"></i></button></div>';
        })->rawColumns(['status','action']);

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }

    public function yajra_filter(Request $request,$dari,$sampai,$user_id)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = M_pengiriman::join('penjemputan', 'penjemputan.id', '=', 'pengiriman.penjemputan_id')->join('users', 'users.id', '=', 'pengiriman.user_id')->where('pengiriman.cabang_id',\Auth::user()->cabang_id)->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            // 'penjemputan.*',
            'users.name',
            'penjemputan.nama_penerima',
            'penjemputan.alamat',
            'penjemputan.no_hp',
            'penjemputan.dana_talangan',
            'penjemputan.ongkir',
            'penjemputan.total_tagihan',
            'keterangan',
            'pengiriman.user_id',
            'pengiriman.created_at',
            'pengiriman.updated_at'
            ])->whereDate('pengiriman.created_at','>=',$dari)->whereDate('pengiriman.created_at','<=',$sampai)->with(['cabang'])->orderBy('pengiriman.created_at');

            if($user_id != 'all'){
                $users = $users->where('penjemputan.user_id',$user_id);
            }

        $datatables = Datatables::of($users)->editColumn('pengiriman.created_at',function($e){
            return date('Y-m-d H:i:s',strtotime($e->created_at));

        })->addColumn('action',function($e){
            $url = url('admin/expense/'.$e->id);
            $dt = '<div style="width:60px"><a href="'.$url.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="'.$url.'" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></button></div>';

            return $dt;
        });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }

    // public function create(){
    // 	$title = 'Add Supplier';

    // 	return view('supplier.create',compact('title'));
    // }

    // public function store(Request $request){
    // 	$this->validate($request,[
    // 		'nama'=>'required',
    // 		'company_name'=>'required'
    // 	]);

    // 	$a['nama'] = $request->nama;
    // 	$a['company_name'] = $request->company_name;
    // 	$a['no_npwp'] = $request->no_npwp;
    // 	$a['no_telp'] = $request->no_telp;
    // 	$a['email'] = $request->email;
    // 	$a['kota'] = $request->kota;
    // 	$a['provinsi'] = $request->provinsi;
    // 	$a['alamat_lengkap'] = $request->alamat_lengkap;
    // 	$a['kode_pos'] = $request->kode_pos;
    // 	$a['cabang_id'] = \Auth::user()->cabang_id;

    // 	if($request->is_active == 1){
    // 		$a['is_active'] = 1;
    // 	}

    // 	$a['created_at'] = date('Y-m-d H:i:s');
    // 	$a['updated_at'] = date('Y-m-d H:i:s');
    // 	$a['created_by'] = \Auth::user()->id;
    // 	$a['updated_by'] = \Auth::user()->id;

    // 	M_supplier::insert($a);

    // 	return redirect('admin/supplier')->with('sukses','Data berhasil disimpan');
    // }

    public function edit($id){
        $title = 'Edit Data Pengiriman';
        $dt = M_pengiriman::where([
            ['id','=',$id],
            ['cabang_id','=',\Auth::user()->cabang_id]
        ])->firstOrFail();

        return view('admin.laporan_pengiriman.edit',compact('title','dt'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required',
            'company_name'=>'required'
        ]);

        $a['nama'] = $request->nama;
        $a['company_name'] = $request->company_name;
        $a['no_npwp'] = $request->no_npwp;
        $a['no_telp'] = $request->no_telp;
        $a['email'] = $request->email;
        $a['kota'] = $request->kota;
        $a['provinsi'] = $request->provinsi;
        $a['alamat_lengkap'] = $request->alamat_lengkap;
        $a['kode_pos'] = $request->kode_pos;
        $a['cabang_id'] = \Auth::user()->cabang_id;

        if($request->is_active == 1){
            $a['is_active'] = 1;
        }else{
            $a['is_active'] = null;
        }

        // $a['created_at'] = date('Y-m-d H:i:s');
        $a['updated_at'] = date('Y-m-d H:i:s');
        // $a['created_by'] = \Auth::user()->id;
        $a['updated_by'] = \Auth::user()->id;

        M_supplier::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->update($a);

        return redirect('admin/supplier')->with('sukses','Data berhasil disimpan');
    }

    public function delete($id){
        try {
            M_pengiriman::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
            \Session::flash('sukses','Data berhasil dihapus');
        } catch (\Exception $e) {
            \Session::flash('gagal','Data yang sudah linked tidak dapat dihapus, sebagai alternatif, silahkan ubah status nya menjadi tidak aktif');
        }
        return redirect()->back();
    }
}
