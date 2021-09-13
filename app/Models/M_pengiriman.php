<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_pengiriman extends Model
{
    use HasFactory;
    protected $fillable = ['nama_penerima', 'alamat', 'no_hp', 'pengirim', 'keterangan', 'user_id', 'penjemputan', 'driver', 'dana_talangan', 'ongkir', 'total_tagihan', 'cabang_id'];
    public $table = "pengiriman";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function penjemputan(){
        return $this->belongsTo(M_penjemputan::class);
    }

    public function cabang(){
    	return $this->belongsTo('App\Models\M_cabang','cabang_id')->withDefault(['nama'=>null]);
    }
}
