<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paket_laundry;
use App\Models\Role_permission;
use App\Models\M_satuan;

class Paket_laundry_controller extends Controller
{
    public function index(){
    	// cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-paket-laundry');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Master Paket Laundry';
    	$data = Paket_laundry::where('cabang_id',\Auth::user()->cabang_id)->get();

    	return view('admin.paket_laundry.index',compact('title','data'));
    }

    public function create(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-paket-laundry');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Create Paket Laundry';
        $satuans = M_satuan::get();

    	return view('admin.paket_laundry.create',compact('title','satuans'));
    }

    public function store(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-paket-laundry');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$data = $request->all();
        $data['cabang_id'] = \Auth::user()->cabang_id;
    	$data['is_active'] = 1;
    	Paket_laundry::create($data);

    	return redirect('paket-laundry')->with('sukses','Data berhasil disimpan');
    }

    public function edit($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','edit-paket-laundry');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $title = 'Edit Paket Laundry';
        $dt = Paket_laundry::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        $satuans = M_satuan::get();

        return view('admin.paket_laundry.edit',compact('title','dt','satuans'));
    }

    public function update(Request $request,$id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','edit-paket-laundry');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $data = $request->except(['_token','_method']);
        $data['cabang_id'] = \Auth::user()->cabang_id;
        // $data['is_active'] = 1;
        Paket_laundry::where('id',$id)->update($data);

        return redirect('paket-laundry')->with('sukses','Data berhasil disimpan');
    }

    public function delete($id){
        try {
            // cek role
            $role_id = \Auth::user()->role_id;
            $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
                $e->where('title','delete-paket-laundry');
            })->count();
            if($cek_role < 1){
                $title = 'Access Denied';
                return view('access_denied',compact('title'));
            }
            // end cek role

            Paket_laundry::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
            \Session::flash('sukses','Data berhasil dihapus');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }

    public function update_status($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','update-status-paket-laundry');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $dt = paket_laundry::find($id);
        if($dt->is_active == 1){
            Paket_laundry::where('id',$id)->update(['is_active'=>2]);
        }else{
            Paket_laundry::where('id',$id)->update(['is_active'=>1]);
        }

        return redirect()->back()->with('sukses','Status berhasil diupdate');
    }
}
