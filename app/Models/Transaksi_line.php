<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Transaksi_line;

class Transaksi_line extends Model
{
    use HasFactory;

    public function paket_laundry(){
    	return $this->belongsTo('App\Models\Paket_laundry','paket_laundry_id');
    }

    public function header(){
    	return $this->belongsTo('App\Models\Transaksi','transaksi_id');
    }

    public function total($dari,$sampai){
    	$dt = Transaksi_line::whereDate('created_at','>=',$dari)->whereDate('created_at','<=',$sampai)->whereHas('header',function($e)use($dari,$sampai){
    		$e->where('status_pengerjaan',6);
    	})->sum('grand_total_amount');
    	return $dt;
    }
}
