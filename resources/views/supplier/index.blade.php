@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{ url('admin/supplier/create') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                </p>
            </div>
            <div class="box-body">
               
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <p style="color: red;">
                                <b><i>Data yang sudah linked tidak dapat dihapus, sebagai alternatif, silahkan ubah status nya menjadi tidak aktif</i></b>
                            </p>
                        </center>
                        <div class="table-responsive">
                            <table class="table tbl-sup">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Status</th>
                                        <th>Nama</th>
                                        <th>Company Name</th>
                                        <th>No NPWP</th>
                                        <th>No Telp</th>
                                        <th>Email</th>
                                        <th>Kota</th>
                                        <th>Provinsi</th>
                                        <th>Kode POS</th>
                                        <th>Alamat Lengkap</th>
                                        <th>Cabang</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Diupdate Oleh</th>
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
 
<script type="text/javascript">
    $(document).ready(function(){

        $('.tbl-sup').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{$yajra}}",
            columns: [
                // or just disable search since it's not really searchable. just add searchable:false
                {data: 'action', name: 'action', searchable:false, orderable:false},
                {data: 'status', name: 'status'},
                {data: 'nama', name: 'nama'},
                {data: 'company_name', name: 'company_name'},
                {data: 'no_npwp', name: 'no_npwp'},
                {data: 'no_telp', name: 'no_telp'},
                {data: 'email', name: 'email'},
                {data: 'kota', name: 'kota'},
                {data: 'provinsi', name: 'provinsi'},
                {data: 'kode_pos', name: 'kode_pos'},
                {data: 'alamat_lengkap', name: 'alamat_lengkap'},
                {data: 'cabang.nama', name: 'cabang.nama'},
                {data: 'dibuat_oleh.name', name: 'dibuat_oleh.name'},
                {data: 'diupdate_oleh.name', name: 'diupdate_oleh.name'}
            ]
        });
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection