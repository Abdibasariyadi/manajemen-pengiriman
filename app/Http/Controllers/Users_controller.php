<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\M_role;
use App\Models\Role_permission;

use DB;
use DataTables;

class Users_controller extends Controller
{
    public function index(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-user');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Users';
        $role_nya = 'kosong';
    	$yajra = url('admin/users/yajra/'.$role_nya);
        $roles = M_role::where('id','!=',1)->get();

    	return view('admin.users.index',compact('title','yajra','roles'));
    }

    public function index_filter(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','list-user');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $role_nya = $request->role_id;
        $rl = M_role::find($role_nya);
        $title = 'Users '.$rl->nama;
        $yajra = url('admin/users/yajra/'.$role_nya);
        $roles = M_role::where('id','!=',1)->get();

        return view('admin.users.index',compact('title','yajra','roles'));
    }

    public function create(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-user');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Create User';
    	$roles = M_role::where('id','!=',1)->get();

    	return view('admin.users.create',compact('title','roles'));
    }

    public function store(Request $request){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','create-user');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$data['name'] = $request->name;
    	$data['email'] = $request->email;
    	$data['role_id'] = $request->role_id;
    	$data['password'] = bcrypt('123');
        $data['no_telp'] = $request->no_telp;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['alamat'] = $request->alamat;
        $data['cabang_id'] = \Auth::user()->cabang_id;
    	User::create($data);

    	return redirect('admin/users')->with('sukses','Data berhasil disimpan, password default adalah 123');
    }

    public function edit($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','edit-user');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$title = 'Edit User';
    	$roles = M_role::where('id','!=',1)->get();
    	$dt = User::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();

    	return view('admin.users.edit',compact('title','roles','dt'));
    }

    public function update(Request $request,$id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','edit-user');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	$data['name'] = $request->name;
    	$data['email'] = $request->email;
    	$data['role_id'] = $request->role_id;
    	$data['updated_at'] = date('Y-m-d H:i:s');
        $data['no_telp'] = $request->no_telp;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['alamat'] = $request->alamat;
        $data['cabang_id'] = \Auth::user()->cabang_id;
    	User::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->update($data);

    	return redirect('admin/users')->with('sukses','Data berhasil disimpan');
    }

    public function delete($id){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','delete-user');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

    	try {
    		User::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
    		\Session::flash('sukses','Data berhasil dihapus');
    	} catch (\Exception $e) {
    		\Session::flash('gagal',$e->getMessage());
    	}
    	return redirect()->back();
    }

    public function yajra(Request $request,$role_nya)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = User::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'email',
            'role_id',
            'no_telp',
            'jenis_kelamin',
            'alamat',
            'created_at',
            'cabang_id',
            'updated_at'])->where('role_id','!=',1)->where('cabang_id',\Auth::user()->cabang_id)->with(['cabang']);

        if($role_nya != 'kosong'){
            $users = $users->where('role_id',$role_nya);
        }

        $users = $users->with(['role']);

        $datatables = DataTables::of($users)->editColumn('created_at',function($e){
        	return date('d M Y H:i:s',strtotime($e->created_at));
        })->editColumn('updated_at',function($e){
        	return date('d M Y H:i:s',strtotime($e->updated_at));
        })->addColumn('action',function($e){
        	$url = url('admin/users/'.$e->id);
        	$dt = '<div style="width:60px"><a href="'.$url.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="'.$url.'" class="btn btn-danger btn-xs btn-hapus" id="delete"><i class="fa fa-trash-o"></i></button> </div>';
        	return $dt;
        });

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
	}

    public function change_password(){
        // cek role
        $role_id = \Auth::user()->role_id;
        $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
            $e->where('title','change-password');
        })->count();
        if($cek_role < 1){
            $title = 'Access Denied';
            return view('access_denied',compact('title'));
        }
        // end cek role

        $title = 'Ganti Password';

        return view('change_password.index',compact('title'));
    }

    public function change_password_update(Request $request){
        try {
            // cek role
            $role_id = \Auth::user()->role_id;
            $cek_role = Role_permission::where('role_id',$role_id)->whereHas('permission',function($e){
                $e->where('title','change-password');
            })->count();
            if($cek_role < 1){
                $title = 'Access Denied';
                return view('access_denied',compact('title'));
            }
            // end cek role

            User::where('id',\Auth::user()->id)->update([
                'password'=>bcrypt($request->password)
            ]);
            \Session::flash('sukses','Password Berhasil diupdate');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }
}
