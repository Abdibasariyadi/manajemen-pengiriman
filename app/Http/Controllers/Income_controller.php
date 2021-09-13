<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

use App\Models\Coa;
use App\Models\Income;
use App\Models\Income_line;
use App\Models\Ledger;

class Income_controller extends Controller
{
    public function index(){
        $title = 'List Income';
        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');
        $yajra = url('admin/income/yajra');

        return view('income.index',compact('title','yajra','dari','sampai'));
    }

    public function index_filter(Request $request){
        $dari = date('Y-m-d',strtotime($request->dari));
        $sampai = date('Y-m-d',strtotime($request->sampai));
        $title = "List Income dari $dari sampai $sampai";
        $yajra = url('admin/income/yajra/'.$dari.'/'.$sampai);

        return view('income.index',compact('title','yajra','dari','sampai'));
    }

    public function create(){
    	$title = 'Create Income';
    	$ref_no = \Auth::user()->id.time();
    	$coas = Coa::where('cabang_id',\Auth::user()->cabang_id)->get();

    	return view('income.create',compact('title','ref_no','coas'));
    }

    public function store(Request $request){
    	$request->validate([
    		'tanggal'=>'required',
    		'ref_no'=>'required|unique:incomes',
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
                $hd = Income::create($header);
                // dd($hd->id);
                $coa_id_line = $request->coa_id_line;
                $nominal = $request->nominal;
                $note_line = $request->note_line;
                $data_line = [];

                foreach ($nominal as $key => $value) {
                    $a['income_id'] = $hd->id;
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

                Income_line::insert($data_line);
            });

    		return redirect('admin/income')->with('sukses','Success');
    	} catch (\Exception $e) {
    		\Session::flash('gagal',$e->getMessage().'-'.$e->getLine());
    		return redirect()->back();
    	}
    }

    public function verif(Request $request){
        $data = $request->data;
        if(isset($data[0])){
            \DB::transaction(function($e)use($data){
                Income::whereIn('id',$data)->update(['status'=>1]);

                foreach ($data as $e => $dt) {
                    // return $dt;
                    // dd();
                    $hd = Income::find($dt);
                    $lines = \DB::table('income_lines')->where('income_id',$hd->id)->get();

                    $ledger_id = \DB::table('ledgers')->insertGetId([
                        'tanggal'=>$hd->tanggal,
                        'ledger_number'=>'income-'.\Auth::user()->cabang_id.'-'.time(),
                        'ref_no'=>$hd->ref_no,
                        'type'=>'income',
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
                            'debit'=>0,
                            'credit'=>$ln->nominal,
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
                        'debit'=>$total_nominal,
                        'credit'=>0,
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
        $title = 'Edit Income';
        $ref_no = \Auth::user()->id.time();
        $coas = Coa::where('cabang_id',\Auth::user()->cabang_id)->get();
        $dt = Income::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
        $url_update = url('admin/income/'.$id);

        return view('income.edit',compact('title','ref_no','coas','dt','url_update'));
    }

    public function update(Request $request,$id){
        
        $request->validate([
            'tanggal'=>'required',
            'ref_no'=>'required|unique:incomes,ref_no,'.$id,
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
                $dtt = Income::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->firstOrFail();
                // Income::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
                $hd = Income::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->update($header);
                // dd($hd->id);
                $coa_id_line = $request->coa_id_line;
                $nominal = $request->nominal;
                $note_line = $request->note_line;
                $data_line = [];

                foreach ($nominal as $key => $value) {
                    $a['income_id'] = $id;
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
                Income_line::where('income_id',$id)->delete();
                Income_line::insert($data_line);

                Ledger::where('ref_no',$header['ref_no'])->where('type','income')->delete();

                if($dtt->status == 1){
                    // jurnal
                    $lines = \DB::table('income_lines')->where('income_id',$dtt->id)->get();

                    $ledger_id = \DB::table('ledgers')->insertGetId([
                        'tanggal'=>$dtt->tanggal,
                        'ledger_number'=>'income-'.\Auth::user()->cabang_id.'-'.time(),
                        'ref_no'=>$dtt->ref_no,
                        'type'=>'income',
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
                            'debit'=>0,
                            'credit'=>$ln->nominal,
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
                        'debit'=>$total_nominal,
                        'credit'=>0,
                        'cabang_id'=>\Auth::user()->cabang_id,
                        'tanggal'=>$dtt->tanggal,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s')
                    ]);
                    // end jurnal
                }
            });

            return redirect('admin/income')->with('sukses','Success');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage().'-'.$e->getLine());
            return redirect()->back();
        }
    }

    public function delete($id){
        try {
            $dt = Income::find($id);
            $ref_no = $dt->ref_no;
            Income::where('id',$id)->where('cabang_id',\Auth::user()->cabang_id)->delete();
            Ledger::where('ref_no',$ref_no)->where('type','income')->where('cabang_id',\Auth::user()->cabang_id)->delete();
            \Session::flash('sukses','Data berhasil dihapus');
        } catch (\Exception $e) {
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect()->back();
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Income::where('cabang_id',\Auth::user()->cabang_id)->select([
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
                return '<input type="checkbox" class="check-income" value="'.$e->id.'"><label class="label label-danger">Not Verified</label>';
            }elseif ($e->status == 1) {
                return '<label class="label label-success">Verified</label>';
            }
        })->addColumn('action',function($e){
            $url = url('admin/income/'.$e->id);
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
        $users = Income::where('cabang_id',\Auth::user()->cabang_id)->select([
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
                return '<input type="checkbox" class="check-income" value="'.$e->id.'"><label class="label label-danger">Not Verified</label>';
            }elseif ($e->status == 1) {
                return '<label class="label label-success">Verified</label>';
            }
        })->addColumn('action',function($e){
            $url = url('admin/income/'.$e->id);
            $dt = '<div style="width:60px"><a href="'.$url.'" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="'.$url.'" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></button></div>';

            return $dt;
        })->rawColumns(['status','action']);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }
}
