<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use DataTables;

use App\Models\Ledger;
use App\Models\Ledger_line;

class Jurnal_controller extends Controller
{
    public function index(){
    	$title = 'Jurnal';
    	$yajra = url('admin/jurnal/yajra');

    	return view('jurnal.index',compact('title','yajra'));
    }

    public function create(){
    	$title = 'Tambah Jurnal';

    	return view('jurnal.create',compact('title'));
    }

    public function store(Request $request){

    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Ledger::where('cabang_id',\Auth::user()->cabang_id)->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'tanggal',
            'ledger_number',
            'ref_no',
            'status',
            'cabang_id',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at'])->with(['cabang','dibuat_oleh','diupdate_oleh'])->latest();
        $datatables = Datatables::of($users)->addColumn('total_debit',function($e){
        	$total = Ledger_line::where('ledger_id',$e->id)->sum('debit');
        	return number_format($total,0);
        })->addColumn('total_credit',function($e){
        	$total = Ledger_line::where('ledger_id',$e->id)->sum('credit');
        	return number_format($total,0);
        })->editColumn('tanggal',function($e){
        	return date('d M Y',strtotime($e->tanggal));
        })->addColumn('details_url', function($e) {
            return url('admin/jurnal/yajra/detail/' . $e->id);
            // return $e->pendaftarans->users->name;
        })->editColumn('created_at',function($e){
        	return date('Y-m-d H:i:s',strtotime($e->created_at));
        });

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
	}

	public function yajra_details(Request $request,$id)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $users = Ledger_line::where('ledger_lines.ledger_id',$id)->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'ledger_lines.id',
            'ledger_lines.ledger_id',
            'ledger_lines.coa_id',
            'ledger_lines.description',
            'ledger_lines.debit',
            'ledger_lines.credit',
            'ledger_lines.cabang_id',
            'ledger_lines.tanggal',
            'ledger_lines.created_at',
            'ledger_lines.updated_at'])->orderBy('debit','desc')->with(['coa']);
        $datatables = Datatables::of($users)->editColumn('debit',function($e){
        	return number_format($e->debit,0);
        })->editColumn('credit',function($e){
        	return number_format($e->credit,0);
        });
 
        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }
 
        return $datatables->make(true);
    }
}
