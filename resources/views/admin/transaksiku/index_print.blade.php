<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">

		<div class="row">
	       <div class="col-md-12">
	       	<center>
	       		<h3>{{$title}}</h3>
	       	</center>
	       </div>
	   </div>

		<div class="row">
	       <div class="col-md-12">
	           <div class="table-responsive">
	               <table class="table table-hover tbl-transaksi">
	                   <thead>
	                       <tr>
	                           <th>Tanggal</th>
	                           <th>Ref No</th>
	                           <th>Customer</th>
	                           <th>Status Bayar</th>
	                           <th>Status Pengerjaan</th>
	                           <th>Total</th>
	                           <th>Diskon</th>
	                           <th>Tax</th>
	                           <th>Grand Total</th>
	                       </tr>
	                   </thead>
	                   <tbody>
	                   	@foreach($users as $dt)
	                   	<tr>
	                   		<td>{{date('Y-m-d',strtotime($dt->tanggal))}}</td>
	                   		<td>{{$dt->reference_no}}</td>
	                   		<td>{{$dt->customer->name}}</td>
	                   		<td>{{$dt->status_bayar_r->nama}}</td>
	                   		<td>{{$dt->status_pengerjaan_r->nama}}</td>
	                   		<td>{{ number_format($dt->total,0) }}</td>
	                   		<td>{{ number_format($dt->diskon,0) }}</td>
	                   		<td>{{ number_format($dt->order_tax,0) }}</td>
	                   		<td>{{ number_format($dt->grand_total_amount,0) }}</td>
	                   	</tr>
	                   	@endforeach
	                   </tbody>
	                   <tfoot>
	                     <tr>
	                       <th></th>
	                       <th></th>
	                       <th></th>
	                       <th></th>
	                       <th></th>
	                       <th></th>
	                       <th></th>
	                       <th><b><i>Total</i></b></th>
	                       <th><b><i>{{number_format($grand_total,2)}}</i></b></th>
	                     </tr>
	                   </tfoot>
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