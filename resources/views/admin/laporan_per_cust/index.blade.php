@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <button class="btn btn-sm btn-flat btn-success btn-filter"><i class="fa fa-filter"></i> Filter</button>
                </p>
            </div>
            <div class="box-body">

                <div class="row div-filter" style="margin-bottom: 25px;display: none;">
                    <div class="col-md-4">
                        <form role="form" method="get" action="{{ url('laporan/per-cust/filter') }}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Dari</label>
                              <input type="text" class="form-control datepicker" id="exampleInputEmail1" placeholder="Dari" autocomplete="off" name="dari" value="{{$dari}}" required="">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Sampai</label>
                              <input type="text" class="form-control datepicker" id="exampleInputEmail1" placeholder="Sampai" autocomplete="off" name="sampai" value="{{$sampai}}" required="">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputFile">Pilih User</label>
                              <select class="form-control cari-user" name="user_id" required="" style="width: 100%;">
                                <option value="{{$user_id}}">{{$name_user}}</option>
                              </select>
                              <input type="checkbox" name="all_user"> All User
                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover tbl-usr">
                        <thead>
                            <tr>
                                <th>Nama</th>
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

    @include('admin.laporan_per_cust.scripts')

@endsection
