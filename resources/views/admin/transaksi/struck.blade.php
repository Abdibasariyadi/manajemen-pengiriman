<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">

		<div class="row">
	       <div class="col-xs-12">
	           <div class="table-responsive">
	           		<center>
	           			<p><b>
	           				{{$gt->nama}}
	           			</b></p>
	           			<p>
	           				{{$gt->alamat}}
	           			</p>
	           		</center>
	               <table class="table table-hover tbl-transaksi">
	                   <tbody>
	                   	<tr>
	                   		<th>Atas Nama</th>
	                   		<td>:</td>
	                   		<td>{{$dt->customer->name}}</td>
	                   	</tr>

	                   	<tr>
	                   		<th>Tanggal</th>
	                   		<td>:</td>
	                   		<td>{{date('d M Y',strtotime($dt->tanggal))}}</td>
	                   	</tr>

	                   	<tr>
	                   		<th>Ref No</th>
	                   		<td>:</td>
	                   		<td>{{$dt->reference_no}}</td>
	                   	</tr>

	                   	<tr>
	                   		<td colspan="3">====================</td>
	                   	</tr>

	                   		@foreach($dt->lines as $ln)
	                   			<tr>
	                   				<th>{{$ln->paket_laundry->nama}}</th>
	                   				<td>:</td>
	                   				<td>{{$ln->berat}} Kg <b>X</b> {{number_format($ln->harga)}} = Rp. {{number_format($ln->total_harga)}}</td>
	                   			</tr>
	                   		@endforeach
	                   	
	                   	<tr>
	                   		<td colspan="3">====================</td>
	                   	</tr>

	                   	<tr>
	                   		<th>Diskon</th>
	                   		<td>:</td>
	                   		<td>{{number_format($dt->diskon)}}</td>
	                   	</tr>

	                   	<tr>
	                   		<th>Tax</th>
	                   		<td>:</td>
	                   		<td>{{number_format($dt->order_tax)}}</td>
	                   	</tr>

	                   	<tr>
	                   		<th>Grand Total</th>
	                   		<td>:</td>
	                   		<td>Rp. {{number_format($dt->grand_total_amount)}}</td>
	                   	</tr>

	                   	<tr>
	                   		<td colspan="3">====================</td>
	                   	</tr>

	                   	<tr>
	                   		<th>Status Bayar</th>
	                   		<td>:</td>
	                   		<td>{{$dt->status_bayar_r->nama}}</td>
	                   	</tr>

	                   	<tr>
	                   		<th>Status Pengerjaan</th>
	                   		<td>:</td>
	                   		<td>{{$dt->status_pengerjaan_r->nama}}</td>
	                   	</tr>
	                   </tbody>
	               </table>
	           </div>
	       </div>
	   </div>
	</div>

	<script type="text/javascript">
	  window.addEventListener("load", window.print());
	</script>

</body>
</html>