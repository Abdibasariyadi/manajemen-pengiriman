<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_permission extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function role(){
    	return $this->belongsTo('App\Models\M_role','role_id')->withDefault(['nama'=>null]);
    }

    public function permission(){
    	return $this->belongsTo('App\Models\M_permission','permission_id')->withDefault(['title'=>null,'keterangan'=>null]);
    }
}
