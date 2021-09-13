<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role_permission;

class Beranda_controller extends Controller
{
    public function index(){
    	$title = 'Beranda';
    	// cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','dashboard');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return redirect('transaksiku');
        }
        // end cek role

    	return view('beranda.index',compact('title'));
    }
}
