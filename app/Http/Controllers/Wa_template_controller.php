<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wa_template;
use App\Models\Role_permission;

class Wa_template_controller extends Controller
{
    public function index(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','wa-token');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Whatsapp Template';
    	$dt = Wa_template::first();

    	return view('admin.wa_template.index',compact('title','dt'));
    }

    public function update(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','wa-token');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role
        
    	$dt = Wa_template::first();
    	$dt->token = $request->token;
        $dt->base_url = $request->base_url;
    	$dt->template_create_transaksi = $request->template_create_transaksi;
    	$dt->save();

    	return redirect()->back()->with('sukses','Data berhasil disimpan');
    }
}
