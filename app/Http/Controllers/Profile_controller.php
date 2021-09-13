<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M_profile;
use App\Models\M_role;
use App\Models\Role_permission;

class Profile_controller extends Controller
{
    public function index(){
    	// cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','update-company-profile');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Update Company Profile';
    	$dt = M_profile::where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        // dd($dt);

    	return view('admin.profile.index',compact('title','dt'));
    }

    public function update(Request $request){
    	// cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','update-company-profile');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role
        
    	$data = $request->except(['_token','_method']);
        $data['cabang_id'] = \Auth::user()->cabang_id;
    	\DB::table('m_profiles')->update($data);

    	return redirect()->back()->with('sukses','Data berhasil diupdate');
    }
}
