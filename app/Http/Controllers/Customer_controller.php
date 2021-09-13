<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Customer_controller extends Controller
{
    public function index(){
    	$title = 'List Customer';
    	$yajra = url('admin/customer/yajra');

    	return view('admin.customer.index',compact('title','yajra'));
    }
}
