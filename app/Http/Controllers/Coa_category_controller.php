<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coa_category;

use DB;
use DataTables;

class Coa_category_controller extends Controller
{
    public function index(){
        $title = 'COA Category';
        $yajra = url('admin/coa-category/yajra');

        return view('coa_category.index',compact('title','yajra'));
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Coa_category::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'nama',
            'cabang_id',
            'is_active',
            'created_at',
            'created_by',
            'updated_by',
            'updated_at'])->where('cabang_id',\Auth::user()->cabang_id)->with(['cabang','dibuat_oleh','diupdate_oleh']);
        $datatables = Datatables::of($users)->addColumn('status',function($e){
            if($e->is_active == 1){
                return '<label class="label label-success">Aktif</label>';
            }else{
                return '<label class="label label-warning">Tidak Aktif</label>';
            }
        })->addColumn('action',function($e){
            $url = url('admin/coa-category/'.$e->id);

            return '<div style="width:60px"><a href="'.$url.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="'.$url.'" class="btn btn-danger btn-xs btn-hapus" id="delete"><i class="fa fa-trash-o"></i></button></div>';
        })->rawColumns(['status','action']);

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }

    public function create(){
    	$title = 'Create COA Category';

    	return view('coa_category.create',compact('title'));
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'nama'=>'required',
    		'is_active'=>'required'
    	]);

    	$a['nama'] = $request->nama;

    	if($request->is_active == 1){
    		$a['is_active'] = 1;
    	}

    	$a['cabang_id'] = \Auth::user()->cabang_id;
    	$a['created_by'] = \Auth::user()->id;
    	$a['updated_by'] = \Auth::user()->id;

    	Coa_category::create($a);

    	return redirect('admin/coa-category')->with('sukses','Data berhasil disimpan');
    }

    public function edit($id){
        $title = 'Edit COA Category';
        $dt = Coa_category::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();

        return view('coa_category.edit',compact('title','dt'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required',
            'is_active'=>'required'
        ]);

        $a['nama'] = $request->nama;

        if($request->is_active == 1){
            $a['is_active'] = 1;
        }else{
            $a['is_active'] = null;
        }

        $a['cabang_id'] = \Auth::user()->cabang_id;
        // $a['created_by'] = \Auth::user()->id;
        $a['updated_by'] = \Auth::user()->id;
        $a['updated_at'] = date('Y-m-d H:i:s');

        Coa_category::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->update($a);

        return redirect('admin/coa-category')->with('sukses','Data berhasil disimpan');
    }

    public function delete($id){
        try {
            Coa_category::where('id',$id)->delete();
            \Session::flash('sukses','Data berhasil dihapus');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }
}
