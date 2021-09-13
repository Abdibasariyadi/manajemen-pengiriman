<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_penjemputan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_penerima', 'alamat', 'no_hp', 'dana_talangan', 'ongkir', 'total_tagihan', 'olshop', 'penjemput', 'user_id', 'cabang_id'];
    public $table = "penjemputan";

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cabang(){
    	return $this->belongsTo('App\Models\M_cabang','cabang_id')->withDefault(['nama'=>null]);
    }
}
