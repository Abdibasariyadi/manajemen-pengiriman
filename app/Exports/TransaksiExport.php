<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
	protected $grand_total;
	protected $data;

	 function __construct($grand_total,$data) {
	        $this->grand_total = $grand_total;
	        $this->data = $data;
	 }

    public function view(): View
    {
        return view('admin.transaksi.index_excel', [
            'users' => $this->data,
            'grand_total'=>$this->grand_total
        ]);
    }
}

