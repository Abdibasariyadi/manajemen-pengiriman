<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public function customer(){
    	return $this->belongsTo('App\Models\User','user_id')->withDefault(['name'=>null]);
    }

    public function status_bayar_r(){
    	return $this->belongsTo('App\Models\M_status','status_bayar')->withDefault(['nama'=>null]);
    }

    public function status_pengerjaan_r(){
    	return $this->belongsTo('App\Models\M_status','status_pengerjaan')->withDefault(['nama'=>null]);
    }

    public function lines(){
        return $this->hasMany('App\Models\Transaksi_line','transaksi_id');
    }

    public function karyawan(){
        return $this->belongsTo('App\Models\User','created_by')->withDefault(['name'=>null]);
    }
}
