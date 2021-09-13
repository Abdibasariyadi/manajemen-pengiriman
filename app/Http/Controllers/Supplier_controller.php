<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use DataTables;

use App\Models\M_supplier;

class Supplier_controller extends Controller
{
    public function index(){
    	$title = 'List Supplier';
        $yajra = url('admin/supplier/yajra');

    	return view('supplier.index',compact('title','yajra'));
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = M_supplier::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'm_suppliers.*'])->where('m_suppliers.cabang_id',\Auth::user()->cabang_id)->with(['cabang','dibuat_oleh','diupdate_oleh']);
        $datatables = Datatables::of($users)->addColumn('status',function($e){
            if($e->is_active == 1){
                return '<label class="label label-success">Aktif</label>';
            }else{
                return '<label class="label label-warning">Tidak Aktif</label>';
            }
        })->addColumn('action',function($e){
            $url = url('admin/supplier/'.$e->id);

            return '<div style="width:60px"><a href="'.$url.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="'.$url.'" class="btn btn-danger btn-xs btn-hapus" id="delete"><i class="fa fa-trash-o"></i></button></div>';
        })->rawColumns(['status','action']);

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }

    public function create(){
    	$title = 'Add Supplier';

    	return view('supplier.create',compact('title'));
    }

    public function store(Request $request){
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
    	}
    	
    	$a['created_at'] = date('Y-m-d H:i:s');
    	$a['updated_at'] = date('Y-m-d H:i:s');
    	$a['created_by'] = \Auth::user()->id;
    	$a['updated_by'] = \Auth::user()->id;

    	M_supplier::insert($a);

    	return redirect('admin/supplier')->with('sukses','Data berhasil disimpan');
    }

    public function edit($id){
        $title = 'Edit Supplier';
        $dt = M_supplier::where([
            ['id','=',$id],
            ['cabang_id','=',\Auth::user()->cabang_id]
        ])->firstOrFail();

        return view('supplier.edit',compact('title','dt'));
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
            M_supplier::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
            \Session::flash('sukses','Data berhasil dihapus');
        } catch (\Exception $e) {
            \Session::flash('gagal','Data yang sudah linked tidak dapat dihapus, sebagai alternatif, silahkan ubah status nya menjadi tidak aktif');
        }
        return redirect()->back();
    }
}
