@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('paket-laundry/create')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                  <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                      <center>
                        <p style="color: red;">
                          <b><i>
                            Data paket laundry yang sudah ngelink / sudah di pakai untuk transaksi tidak dapat dihapus, Relasi (Restrict)
                          </i></b>
                        </p>
                      </center>
                    </div>
                  </div>
                   <div class="col-md-12">
                       <div class="table-responsive">
                           <table class="table myTable">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Action</th>
                                       <th>Cabang</th>
                                       <th>Nama</th>
                                       <th>Harga / Satuan</th>
                                       <th>Estimasi Pengerjaan</th>
                                       <th>Keterangan</th>
                                       <th>Is Active?</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    @foreach($data as $e=>$dt)
                                   <tr>
                                       <td>{{$e+1}}</td>
                                       <td>
                                          <div style="width:60px">
                                            <a href="{{url('paket-laundry/'.$dt->id)}}" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a> <button href="{{url('paket-laundry/'.$dt->id)}}" class="btn btn-danger btn-xs btn-hapus" id="delete"><i class="fa fa-trash-o"></i></button>
                                          </div>
                                       </td>
                                       <td>{{$dt->cabang->nama}}</td>
                                       <td>{{$dt->nama}}</td>
                                       <td>{{ number_format($dt->harga,0) }} / {{$dt->satuan->nama}}</td>
                                       <td>{{ $dt->estimasi_pengerjaan }} Hari</td>
                                       <td>{{$dt->keterangan}}</td>
                                       <td>
                                           <a href="{{url('paket-laundry/status/'.$dt->id)}}" class="btn btn-xs btn-{{$dt->active->color}}">{{$dt->active->nama}}</a>
                                       </td>
                                   </tr>
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
