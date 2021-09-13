<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Paket_laundry;
use App\Models\M_pengiriman;
use App\Models\M_penjemputan;
use App\Models\Role_permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengirimanController extends Controller
{
    public function index(){
    	// cek role

        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-pengiriman');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Data Pengiriman';
    	$data = DB::table('pengiriman')
                // ->join('contacts', 'users.id', '=', 'contacts.user_id')
                // ->join('orders', 'users.id', '=', 'orders.user_id')
                // ->select('users.*', 'contacts.phone', 'orders.price')
                ->get();
            // dd($data);

    	return view('pengiriman.index',compact('title','data'));
    }

    public function create(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-pengiriman');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role
        // $penjemputan_id = DB::table('pengiriman')->get();
        $penjemputan_id = M_penjemputan::where('cabang_id',\Auth::user()->cabang_id)->get();
    	$title = 'Create Pengiriman';
        // $data = DB::table('pengiriman')->get();

    	return view('pengiriman.create',compact('title', 'penjemputan_id'));
    }

    public function getDetails($id = 0)
    {
        $data = M_penjemputan::where('id', $id)->first();
        echo json_encode($data);
        exit;
    }

    public function get_id(Request $request){

        if ($request->has('q')) {
            $cari = $request->q;
            $data = M_penjemputan::select('id', 'name')->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
        }
    }

    public function store(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-pengiriman');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$validated = $request->validate([
            'penjemputan_id' => 'required',
            'nama_penerima' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'dana_talangan' => 'required|numeric|min:2',
            'ongkir' => 'required|numeric|min:2',
            'total_tagihan' => 'required|numeric|min:2',
            'keterangan' => 'required',
        ],
        [
            'penjemputan_id' => 'ID Barang Tidak Boleh Kosong!',
            'nama_penerima.required' => 'Nama Penerima Tidak Boleh Kosong!',
            'alamat.required' => 'Alamat Tidak Boleh Kosong!',
            'no_hp.required' => 'No HP Tidak Boleh Kosong!',
            // 'no_hp.digits:10' => 'No HP Minimal 10 Digit!',
            'pengirim.required' => 'Nama Pengirim Tidak Boleh Kosong!',
            'dana_talangan.required' => 'Dana Talangan Tidak Boleh Kosong!',
            'ongkir.required' => 'Ongkir Tidak Boleh Kosong!',
            'total_tagihan.required' => 'Total Tagihan Tidak Boleh Kosong!',
            'keterangan.required' => 'Keterangan Tidak Boleh Kosong!',
        ]);

        M_pengiriman::insert([
            'penjemputan_id' => $request->penjemputan_id,
            'nama_penerima' => $request->nama_penerima,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'dana_talangan' => $request->dana_talangan,
            'ongkir' => $request->ongkir,
            'total_tagihan' => $request->total_tagihan,
            'keterangan' => $request->keterangan,
            'cabang_id' => $request->cabang_id,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

    	return redirect('pengiriman')->with('sukses','Data berhasil disimpan');
    }

}
