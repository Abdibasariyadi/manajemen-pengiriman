<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use DataTables;

use App\Models\Coa;
use App\Models\Expense;
use App\Models\Expense_line;
use App\Models\Ledger;

class Expense_controller extends Controller
{
    public function index(){
        $title = 'List Expense';
        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');
        $yajra = url('admin/expense/yajra');

        return view('expense.index',compact('title','yajra','dari','sampai'));
    }

    public function index_filter(Request $request){
        $dari = date('Y-m-d',strtotime($request->dari));
        $sampai = date('Y-m-d',strtotime($request->sampai));
        $title = "List Expense dari $dari sampai $sampai";
        $yajra = url('admin/expense/yajra/'.$dari.'/'.$sampai);

        return view('expense.index',compact('title','yajra','dari','sampai'));
    }

    public function create(){
    	$title = 'Create Expense';
    	$ref_no = \Auth::user()->id.time();
    	$coas = Coa::where('cabang_id',\Auth::user()->cabang_id)->get();

    	return view('expense.create',compact('title','ref_no','coas'));
    }

    public function store(Request $request){
    	$request->validate([
    		'tanggal'=>'required',
    		'ref_no'=>'required|unique:expenses',
    		'coa_id'=>'required'
    	]);
    	try {
    		$header['tanggal'] = date('Y-m-d',strtotime($request->tanggal));
    		$header['ref_no'] = $request->ref_no;
    		$header['coa_id'] = $request->coa_id;
            $header['note'] = $request->note;
    		$header['cabang_id'] = \Auth::user()->cabang_id;
    		$header['created_by'] = \Auth::user()->id;
    		$header['updated_by'] = \Auth::user()->id;

    		\DB::transaction(function()use($request,$header){
                $hd = Expense::create($header);
                // dd($hd->id);
                $coa_id_line = $request->coa_id_line;
                $nominal = $request->nominal;
                $note_line = $request->note_line;
                $data_line = [];

                foreach ($nominal as $key => $value) {
                    $a['expense_id'] = $hd->id;
                    $a['coa_id'] = $coa_id_line[$key];
                    $a['nominal'] = $value;

                    if(isset($note_line[$key])){
                        $a['note'] = $note_line[$key];
                    }else{
                        $a['note'] = null;
                    }
                    
                    $a['created_at'] = date('Y-m-d H:i:s');
                    $a['updated_at'] = date('Y-m-d H:i:s');
                    array_push($data_line, $a);
                }

                Expense_line::insert($data_line);
            });

    		return redirect('admin/expense')->with('sukses','Success');
    	} catch (\Exception $e) {
    		\Session::flash('gagal',$e->getMessage().'-'.$e->getLine());
    		return redirect()->back();
    	}
    }

    public function verif(Request $request){
        $data = $request->data;
        if(isset($data[0])){
            \DB::transaction(function($e)use($data){
                Expense::whereIn('id',$data)->update(['status'=>1]);

                foreach ($data as $e => $dt) {
                    // return $dt;
                    // dd();
                    $hd = Expense::find($dt);
                    $lines = \DB::table('expense_lines')->where('expense_id',$hd->id)->get();

                    $ledger_id = \DB::table('ledgers')->insertGetId([
                        'tanggal'=>$hd->tanggal,
                        'ledger_number'=>'expense-'.\Auth::user()->cabang_id.'-'.time(),
                        'ref_no'=>$hd->ref_no,
                        'type'=>'expense',
                        'cabang_id'=>\Auth::user()->cabang_id,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>\Auth::user()->id,
                        'updated_by'=>\Auth::user()->id
                    ]);

                    $total_nominal = 0;
                    foreach ($lines as $key => $ln) {
                        $total_nominal += $ln->nominal;
                        \DB::table('ledger_lines')->insert([
                            'ledger_id'=>$ledger_id,
                            'coa_id'=>$ln->coa_id,
                            'description'=>$ln->note,
                            'credit'=>0,
                            'debit'=>$ln->nominal,
                            'cabang_id'=>\Auth::user()->cabang_id,
                            'tanggal'=>$hd->tanggal,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s')
                        ]);
                    }

                    \DB::table('ledger_lines')->insert([
                        'ledger_id'=>$ledger_id,
                        'coa_id'=>$hd->coa_id,
                        'description'=>$hd->note,
                        'credit'=>$total_nominal,
                        'debit'=>0,
                        'cabang_id'=>\Auth::user()->cabang_id,
                        'tanggal'=>$hd->tanggal,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')
                    ]);
                }
            });
        }
        
        return response()->json(['data'=>$data]);
    }

    public function edit($id){
        $title = 'Edit Expense';
        $ref_no = \Auth::user()->id.time();
        $coas = Coa::where('cabang_id',\Auth::user()->cabang_id)->get();
        $dt = Expense::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        $url_update = url('admin/expense/'.$id);

        return view('expense.edit',compact('title','ref_no','coas','dt','url_update'));
    }

    public function update(Request $request,$id){
        
        $request->validate([
            'tanggal'=>'required',
            'ref_no'=>'required|unique:expenses,ref_no,'.$id,
            'coa_id'=>'required'
        ]);
        try {
            $header['tanggal'] = date('Y-m-d',strtotime($request->tanggal));
            $header['ref_no'] = $request->ref_no;
            $header['coa_id'] = $request->coa_id;
            $header['note'] = $request->note;
            $header['cabang_id'] = \Auth::user()->cabang_id;
            // $header['created_by'] = \Auth::user()->id;
            $header['updated_at'] = date('Y-m-d H:i:s');
            $header['updated_by'] = \Auth::user()->id;

            \DB::transaction(function()use($request,$header,$id){
                $dtt = Expense::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
                // Income::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
                $hd = Expense::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->update($header);
                // dd($hd->id);
                $coa_id_line = $request->coa_id_line;
                $nominal = $request->nominal;
                $note_line = $request->note_line;
                $data_line = [];

                foreach ($nominal as $key => $value) {
                    $a['expense_id'] = $id;
                    $a['coa_id'] = $coa_id_line[$key];
                    $a['nominal'] = $value;

                    if(isset($note_line[$key])){
                        $a['note'] = $note_line[$key];
                    }else{
                        $a['note'] = null;
                    }
                    
                    $a['created_at'] = date('Y-m-d H:i:s');
                    $a['updated_at'] = date('Y-m-d H:i:s');
                    array_push($data_line, $a);
                }
                Expense_line::where('expense_id',$id)->delete();
                Expense_line::insert($data_line);

                Ledger::where('ref_no',$header['ref_no'])->where('type','expense')->delete();

                if($dtt->status == 1){
                    // jurnal
                    $lines = \DB::table('expense_lines')->where('expense_id',$dtt->id)->get();

                    $ledger_id = \DB::table('ledgers')->insertGetId([
                        'tanggal'=>$dtt->tanggal,
                        'ledger_number'=>'expense-'.\Auth::user()->cabang_id.'-'.time(),
                        'ref_no'=>$dtt->ref_no,
                        'type'=>'expense',
                        'cabang_id'=>\Auth::user()->cabang_id,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>\Auth::user()->id,
                        'updated_by'=>\Auth::user()->id
                    ]);

                    $total_nominal = 0;
                    foreach ($lines as $key => $ln) {
                        $total_nominal += $ln->nominal;
                        \DB::table('ledger_lines')->insert([
                            'ledger_id'=>$ledger_id,
                            'coa_id'=>$ln->coa_id,
                            'description'=>$ln->note,
                            'credit'=>0,
                            'debit'=>$ln->nominal,
                            'cabang_id'=>\Auth::user()->cabang_id,
                            'tanggal'=>$dtt->tanggal,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s')
                        ]);
                    }

                    \DB::table('ledger_lines')->insert([
                        'ledger_id'=>$ledger_id,
                        'coa_id'=>$dtt->coa_id,
                        'description'=>$dtt->note,
                        'credit'=>$total_nominal,
                        'debit'=>0,
                        'cabang_id'=>\Auth::user()->cabang_id,
                        'tanggal'=>$dtt->tanggal,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')
                    ]);
                    // end jurnal
                }
            });

            return redirect('admin/expense')->with('sukses','Success');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage().'-'.$e->getLine());
            return redirect()->back();
        }
    }

    public function delete($id){
        try {
            $dt = Expense::find($id);
            $ref_no = $dt->ref_no;
            Expense::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
            Ledger::where('ref_no',$ref_no)->where('type','expense')->where('cabang_id',\Auth::user()->cabang_id)->delete();
            \Session::flash('sukses','Data berhasil dihapus');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Expense::where('cabang_id',\Auth::user()->cabang_id)->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'tanggal',
            'ref_no',
            'coa_id',
            'note',
            'status',
            'cabang_id',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at'])->with(['cabang','dibuat_oleh','diupdate_oleh','coa'])->latest();
        $datatables = Datatables::of($users)->editColumn('created_at',function($e){
            return date('Y-m-d H:i:s',strtotime($e->created_at));
        })->editColumn('updated_at',function($e){
            return date('Y-m-d H:i:s',strtotime($e->updated_at));
        })->editColumn('tanggal',function($e){
            return date('d M Y',strtotime($e->tanggal));
        })->editColumn('status',function($e){
            if($e->status == null){
                return '<input type="checkbox" class="check-expense" value="'.$e->id.'"><label class="label label-danger">Not Verified</label>';
            }elseif ($e->status == 1) {
                return '<label class="label label-success">Verified</label>';
            }
        })->addColumn('action',function($e){
            $url = url('admin/expense/'.$e->id);
            $dt = '<div style="width:60px"><a href="'.$url.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="'.$url.'" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></button></div>';

            return $dt;
        })->rawColumns(['status','action']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }

    public function yajra_filter(Request $request,$dari,$sampai)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Expense::where('cabang_id',\Auth::user()->cabang_id)->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'tanggal',
            'ref_no',
            'coa_id',
            'note',
            'status',
            'cabang_id',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at'])->whereDate('tanggal','>=',$dari)->whereDate('tanggal','<=',$sampai)->with(['cabang','dibuat_oleh','diupdate_oleh','coa'])->latest();
        $datatables = Datatables::of($users)->editColumn('created_at',function($e){
            return date('Y-m-d H:i:s',strtotime($e->created_at));
        })->editColumn('updated_at',function($e){
            return date('Y-m-d H:i:s',strtotime($e->updated_at));
        })->editColumn('tanggal',function($e){
            return date('d M Y',strtotime($e->tanggal));
        })->editColumn('status',function($e){
            if($e->status == null){
                return '<input type="checkbox" class="check-expense" value="'.$e->id.'"><label class="label label-danger">Not Verified</label>';
            }elseif ($e->status == 1) {
                return '<label class="label label-success">Verified</label>';
            }
        })->addColumn('action',function($e){
            $url = url('admin/expense/'.$e->id);
            $dt = '<div style="width:60px"><a href="'.$url.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="'.$url.'" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></button></div>';

            return $dt;
        })->rawColumns(['status','action']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }
}
