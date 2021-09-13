@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('pengiriman/create')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                  <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                      {{-- <center>
                        <p style="color: red;">
                          <b><i>
                            Data yang sudah ngelink / sudah di pakai untuk transaksi tidak dapat dihapus, Relasi (Restrict)
                          </i></b>
                        </p>
                      </center> --}}
                    </div>
                  </div>
                   <div class="col-md-12">
                       <div class="table-responsive">
                           <table class="table myTable">
                               <thead>
                                   <tr>
                                       {{-- <th>#</th> --}}
                                       <th>ID Penjemputan</th>
                                       <th>Nama Penerima</th>
                                       <th>Alamat</th>
                                       <th>No HP</th>
                                       <th>Dana Talangan</th>
                                       <th>Ongkir</th>
                                       <th>Total Tagihan</th>
                                       <th>Driver</th>
                                       <th>Tanggal & Jam</th>
                                       <th>Keterangan</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    @foreach($data as $e=>$dt)
                                        @if ($dt->user_id == Auth::user()->id)
                                            <tr>
                                                {{-- <td>{{$e+1}}</td> --}}
                                                {{-- <td>
                                                <div style="width:60px">
                                                    <a href="{{url('paket-laundry/'.$dt->id)}}" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="{{url('paket-laundry/'.$dt->id)}}" class="btn btn-danger btn-xs btn-hapus" id="delete"><i class="fa fa-trash-o"></i></button>
                                                </div>
                                                </td> --}}
                                                <td>{{'KUY000'.$dt->penjemputan_id}}</td>
                                                <td>{{$dt->nama_penerima}}</td>
                                                <td>{{$dt->alamat}}</td>
                                                <td>{{$dt->no_hp }}</td>
                                                <td>{{$dt->dana_talangan}}</td>
                                                <td>{{$dt->ongkir}}</td>
                                                <td>{{$dt->total_tagihan}}</td>
                                                <td>{{Auth::user()->name}}</td>
                                                <td>{{ Carbon\Carbon::parse($dt->created_at)->format('d M Y H:i') }}</td>
                                                <td>{{$dt->keterangan}}</td>

                                            </tr>

                                        @endif

                                   @endforeach
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
