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
                    {{-- <a href="{{ url('admin/supplier/create') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> --}}
                </p>
            </div>
            <div class="box-body">

                <div class="row div-filter" style="margin-bottom: 25px;display: none;">
                    <div class="col-md-4">
                        <form role="form" method="get" action="{{ url('laporan/pengiriman/filter') }}">
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
                              <label for="exampleInputFile">Pilih Driver</label>
                              <select class="form-control cari-user" name="user_id" required="" style="width: 100%;">
                                <option value="{{$user_id}}">{{$name_user}}</option>
                              </select>
                              <input type="checkbox" name="all_user"> All Driver
                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{-- <center>
                            <p style="color: red;">
                                <b><i>Data yang sudah linked tidak dapat dihapus, sebagai alternatif, silahkan ubah status nya menjadi tidak aktif</i></b>
                            </p>
                        </center> --}}
                        <div class="table-responsive">
                            <table class="table tbl-pengiriman">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Driver</th>
                                        <th>Nama Penerima</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Olshop</th>
                                        <th>Penjemput</th>
                                        <th>Dana Talangan</th>
                                        <th>Ongkir</th>
                                        <th>Total Tagihan</th>
                                        <th>Tanggal & Jam</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
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

@include('admin.laporan_pengiriman.scripts')

@endsection
