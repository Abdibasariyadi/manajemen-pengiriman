<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger_line extends Model
{
    use HasFactory;

    public function coa(){
    	return $this->belongsTo('App\Models\Coa','coa_id');
    }
}
