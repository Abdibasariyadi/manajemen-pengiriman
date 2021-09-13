<table class="">
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