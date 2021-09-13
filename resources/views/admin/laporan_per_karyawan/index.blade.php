@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <button class="btn btn-sm btn-flat btn-primary btn-filter"><i class="fa fa-filter"></i> Filter</button>
                </p>

                <div class="row form-filter" style="display: none;">
                    <div class="col-md-6">
                        <form role="form" method="get" action="{{url('laporan/per-karyawan/filter')}}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Dari</label>
                              <input type="text" class="form-control datepicker" id="exampleInputEmail1" placeholder="Dari" autocomplete="off" name="dari" value="{{$dari}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input type="text" class="form-control datepicker" id="exampleInputEmail1" placeholder="Sampai" autocomplete="off" name="sampai" value="{{$sampai}}">
                            </div>
                          </div>
                          <!-- /.box-body -->
             
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="box-body">
               <div class="table-responsive">
                   <table class="table table-hover tbl-karyawan">
                       <thead>
                           <tr>
                               <th>Karyawan</th>
                                <th>Belum Dibayar</th>
                                <th>Nilai Belum Dibayar</th>
                                <th>Sudah Dibayar</th>
                                <th>Nilai Sudah Dibayar</th>
                                <th>Menunggu Dikerjakan</th>
                                <th>Nilai Menunggu Dikerjakan</th>
                                <th>Sedang Dikerjakan</th>
                                <th>Nilai Sedang Dikerjakan</th>
                                <th>Selesai</th>
                                <th>Nilai Selesai</th>
                           </tr>
                       </thead>
                   </table>
               </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
  @include('admin.laporan_per_karyawan.scripts')
 
@endsection