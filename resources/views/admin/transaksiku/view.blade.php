@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                 <div class="col-md-12">
                   <div class="table-responsive">
                     <table class="table">
                       <tbody>
                         <tr>
                           <th>Reference No : </th>
                           <td>{{$dt->reference_no}}</td>

                           <th>Tanggal : </th>
                           <td>{{date('d M Y',strtotime($dt->tanggal))}}</td>

                           <th>Grand Total Amount : </th>
                           <td>Rp. {{ number_format($dt->grand_total_amount,0) }}</td>
                         </tr>
                         <tr>
                           <th>Customer : </th>
                           <td>{{$dt->customer->name}}</td>

                           <th>No Telp : </th>
                           <td>{{$dt->customer->no_telp}}</td>

                           <th>Alamat : </th>
                           <td>{{$dt->customer->alamat}}</td>
                         </tr>
                         <tr>
                           <th>Status Bayar : <label class="label label-{{$dt->status_bayar_r->color}}">{{$dt->status_bayar_r->nama}}</label></th>

                           <th>Status Pengerjaan : <label class="label label-{{$dt->status_pengerjaan_r->color}}">{{$dt->status_pengerjaan_r->nama}}</label></th>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                 </div>
               </div>

               <hr style=" border-top: 4px dashed blue;">

               <div class="row">
                 <div class="col-md-12">
                   <div class="table-responsive">
                     <table class="table">
                       <thead>
                         <tr>
                           <th>Paket</th>
                            <th>Berat (kg)</th>
                            <th>Harga</th>
                            <th>SubTotal</th>
                            <th>Estimasi Selesai</th>
                         </tr>
                       </thead>
                       <tbody>
                         @foreach($dt->lines as $ln)
                         <tr>
                           <td>{{$ln->paket_laundry->nama}}</td>
                           <td>{{$ln->berat}} Kg</td>
                           <td>{{ number_format($ln->harga,0) }}</td>
                           <td>{{ number_format($ln->total_harga,0) }}</td>
                           <td>{{date('d M Y',strtotime($ln->estimasi_selesai))}}</td>
                         </tr>
                         @endforeach
                       </tbody>
                     </table>
                   </div>
                 </div>
               </div>

               <hr style=" border-top: 4px dashed blue;">

               <div class="row">
                 <div class="col-md-4">
                   <div class="table-responsive">
                     <table class="table">
                       <tbody>
                         <tr>
                           <th>Diskon : </th>
                           <td>{{number_format($dt->diskon,0)}}</td>

                           <th>Pajak : </th>
                           <td>{{number_format($dt->tax,0)}}% ({{number_format($dt->order_tax,0)}})</td>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                 </div>
               </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection