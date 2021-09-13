<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_role;
use App\Models\M_permission;
use App\Models\Role_permission;

class Role_controller extends Controller
{
    public function index(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-role');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Master Role';
    	$data = M_role::where('cabang_id',\Auth::user()->cabang_id)->get();

    	return view('admin.role.index',compact('title','data'));
    }

    public function manage_permission($id){
        // cek role
        // $role_id = \Auth::user()->role_id;
        // $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
        //     $e->where('title','manage-permission');
        // })->count();
        // if($cek_role < 1){
        //     $title = 'Access Denied';
        //     return view('access_denied',compact('title'));
        // }
        // end cek role

        $dt = M_role::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        $title = 'Manage Permission untuk '.$dt->nama;
        $permissions = M_permission::get();
        $role_permission = Role_permission::where('role_id',$id)->where('cabang_id',\Auth::user()->cabang_id)->orderBy('permission_id')->get();

        return view('admin.role.manage_permission',compact('title','dt','permissions','role_permission'));
    }

    public function manage_permission_store($role_ids,$permission_id){
        try {
            // cek role
            $role_id = \Auth::user()->role_id;
            $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
                $e->where('title','manage-permission');
            })->count();
            if($cek_role < 1){
                $title = 'Access Denied';
                return view('access_denied',compact('title'));
            }
            // end cek role

            Role_permission::updateOrCreate(
                ['role_id'=>$role_ids,'permission_id'=>$permission_id],
                [
                    'role_id'=>$role_ids,
                    'permission_id'=>$permission_id,
                    'cabang_id'=>\Auth::user()->cabang_id
                ]
            );
            // \Session::flash('sukses','Data berhasil disimpan');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }

    public function manage_permission_delete($id){
        try {
            // cek role
            $role_id = \Auth::user()->role_id;
            $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
                $e->where('title','delete-manage-permission');
            })->count();
            if($cek_role < 1){
                $title = 'Access Denied';
                return view('access_denied',compact('title'));
            }
            // end cek role

            // dd('asd');
            Role_permission::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
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
            $e->where('title','create-role');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Create Role';

    	return view('admin.role.create',compact('title'));
    }

    public function store(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-role');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$data['nama'] = $request->nama;
        $data['cabang_id'] = \Auth::user()->cabang_id;
    	M_role::updateOrCreate(
    		['nama'=>$data['nama']],
    		$data
    	);

    	return redirect('admin/role')->with('sukses','Data berhasil disimpan');
    }

    public function edit($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','edit-role');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Edit Role';
    	$dt = M_role::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();

    	return view('admin.role.edit',compact('title','dt'));
    }

    public function update(Request $request,$id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','edit-role');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$data['nama'] = $request->nama;
    	$data['updated_at'] = date('Y-m-d H:i:s');
        $data['cabang_id'] = \Auth::user()->cabang_id;
    	M_role::where('id',$id)->update($data);

    	return redirect('admin/role')->with('sukses','Data berhasil disimpan');
    }

    public function delete($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','delete-role');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	M_role::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();

    	return redirect('admin/role')->with('sukses','Data berhasil dihapus');
    }
}
