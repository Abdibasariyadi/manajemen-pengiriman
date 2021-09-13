<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_supplier extends Model
{
    use HasFactory;

    public function cabang(){
    	return $this->belongsTo('App\Models\M_cabang','cabang_id')->withDefault(['nama'=>null]);
    }

    public function dibuat_oleh(){
    	return $this->belongsTo('App\Models\User','created_by')->withDefault(['name'=>null]);
    }

    public function diupdate_oleh(){
    	return $this->belongsTo('App\Models\User','updated_by')->withDefault(['name'=>null]);
    }
}
