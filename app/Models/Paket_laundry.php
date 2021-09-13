<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Transaksi_line;

class Paket_laundry extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function active(){
    	return $this->belongsTo('App\Models\M_status','is_active')->withDefault([
    		'nama'=>null,
    		'color'=>null
    	]);
    }

    public function total($dari,$sampai,$paket,$status){
    	$dt = Transaksi_line::whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->where('paket_laundry_id',$paket)->whereHas('header',function($e)use($dari,$sampai,$status){
            if($status == 3){
                $e->where('status_bayar',$status);
            }elseif ($status == 4) {
                $e->where('status_bayar',$status);
            }else{
                $e->where('status_pengerjaan',$status);
            }

    	})->sum('total_harga');
    	return $dt;
    }

    public function cabang(){
        return $this->belongsTo('App\Models\M_cabang','cabang_id');
    }

    public function satuan(){
        return $this->belongsTo('App\Models\M_satuan','satuan_id');
    }
}
