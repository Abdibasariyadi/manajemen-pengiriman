<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_permission;
use App\Models\Role_permission;

class Permission_controller extends Controller
{
    public function index(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-permissions');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Master Permission';
    	$data = M_permission::get();

    	return view('admin.permission.index',compact('title','data'));
    }

    public function store(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-permissions');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role
        
    	$data = $request->all();
    	M_permission::create($data);

    	return redirect()->back()->with('sukses','Data berhasil disimpan');
    }
}
