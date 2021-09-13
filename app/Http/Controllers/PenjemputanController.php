<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_penjemputan;
use App\Models\Role_permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjemputanController extends Controller
{
    public function index(){
    	// cek role

        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-penjemputan');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Data Penjemputan';
    	$data = DB::table('penjemputan')
                // ->join('contacts', 'users.id', '=', 'contacts.user_id')
                // ->join('orders', 'users.id', '=', 'orders.user_id')
                // ->select('users.*', 'contacts.phone', 'orders.price')
                ->get();
            // dd($data);

    	return view('admin.penjemputan.index',compact('title','data'));
    }

    public function create(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-penjemputan');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role
        $user_id = 'pilih_penjemput';
    	$title = 'Create Data Penjemputan';
        // $data = DB::table('pengiriman')->get();

        if($user_id != 'pilih_penjemput'){
            $us = User::find($user_id);
            $name_user = $us->name;
        }else{
            $us = 'pilih_penjemput';
            $name_user = 'Pilih Penjemput';
        }

    	return view('admin.penjemputan.create',compact('title', 'user_id', 'name_user'));
    }

    public function store(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-penjemputan');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$validated = $request->validate([
            'nama_penerima' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'dana_talangan' => 'required|numeric|min:2',
            'ongkir' => 'required|numeric|min:2',
            'total_tagihan' => 'required|numeric|min:2',
            'olshop' => 'required',
            'penjemput' => 'required',
        ],
        [
            'nama_penerima.required' => 'Nama Penerima Tidak Boleh Kosong!',
            'alamat.required' => 'Alamat Tidak Boleh Kosong!',
            'no_hp.required' => 'No HP Tidak Boleh Kosong!',
            'dana_talangan.required' => 'Dana Talangan Tidak Boleh Kosong!',
            'ongkir.required' => 'Ongkir Tidak Boleh Kosong!',
            'total_tagihan.required' => 'Total Tagihan Tidak Boleh Kosong!',
            'olshop.required' => 'Nama Olshop Tidak Boleh Kosong!',
            'penjemput.required' => 'Nama Penjemput Tidak Boleh Kosong!',
        ]);

        M_penjemputan::insert([
            'nama_penerima' => $request->nama_penerima,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'dana_talangan' => $request->dana_talangan,
            'ongkir' => $request->ongkir,
            'total_tagihan' => $request->total_tagihan,
            'olshop' => $request->olshop,
            'penjemput' => $request->penjemput,
            'cabang_id' => $request->cabang_id,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

    	return redirect('admin.penjemputan')->with('sukses','Data berhasil disimpan');
    }

    public function get_user(Request $request){

        if ($request->has('q')) {
            $cari = $request->q;
            $data = User::select('id', 'name')->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
        }
    }
}
